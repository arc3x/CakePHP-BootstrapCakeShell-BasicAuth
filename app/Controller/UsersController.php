<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');




    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('logout', 'login', 'register', 'verify', 'forgotPassword', 'sendRecovery', 'changePassword');
    }

    public function register($token_g = null) {
        if ($this->request->is('post')) {
            //check for password mismatch
            if($this->request->data['User']['password'] != $this->request->data['User']['password_repeat']) {
                $this->Session->setFlash(__('Passwords mismatch. Please try again.'), 'default', array('class' => 'alert alert-danger'));
                return;
            }
            //check for preexisting email
            $user = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'])));
            if(!empty($user)) {
                $this->Session->setFlash(__('This email address already exists in our system.'), 'default', array('class' => 'alert alert-danger'));
                if(isset($this->request->data['User']['token'])) {
                    return $this->redirect(array('controller' => 'users', 'action' => 'register', $this->request->data['User']['token']));
                } else {
                    return $this->redirect(array('controller' => 'users', 'action' => 'register'));
                }
            }

            //prepare other fields
            $this->request->data['User']['active']=0;  //needs email confirmation
            //$this->request->data['User']['role_id']=1; //basic user //depreciated
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $profile['Profile']['user_id']=$this->User->getLastInsertID();
                $this->loadModel('Profile');
                $this->Profile->save($profile);
                $this->loadModel('Setting');
                $this->loadModel('Token');
                $owner_name=$this->Setting->find('first', array('conditions' => array('Setting.id' => 1)));
                    $owner_name=$owner_name['Setting']['value'];
                $owner_email_out=$this->Setting->find('first', array('conditions' => array('Setting.id' => 2)));
                    $owner_email_out=$owner_email_out['Setting']['value'];

                $token_g=md5(uniqid(rand(), true));
                while($this->Token->hasAny(array('Token.token' => $token_g))) {
                    $token_g=md5(uniqid(rand(), true));
                }
                $id=$this->User->getLastInsertID();

                $token['Token']['userid']=$id;
                $token['Token']['token']=$token_g;
                $token['Token']['type']='account';
                $token['Token']['role']='1';
                if(isset($this->request->data['User']['token'])) {
                    $token_old = $this->Token->find('first', array('conditions' => array('Token.token' => $this->request->data['User']['token'])));
                    if(empty($token_old)) {
                        $this->Session->setFlash(__('Invalid token. Request another invitation.'), 'default', array('class' => 'alert alert-danger'));
                        return $this->redirect(array('controller' => 'users', 'action' => 'register', $this->request->data['User']['token']));
                    } else {
                        $token['Token']['role']=$token_old['Token']['role'];
                        $this->Token->id=$token_old['Token']['id'];
                        $this->Token->delete();
                    }
                }
                $this->Token->save($token);
                $Email = new CakeEmail();
                $Email->from(array($owner_email_out => $owner_name));
                $Email->to($this->request->data['User']['email']);
                $Email->subject('About');
                $Email->send(
                    'Welcome to '.$owner_name.'!'."\n\n".
                    'To activate your account please visit:'."\n".
                    Router::url(array('controller' => 'users', 'action' => 'verify', $token_g), true)."\n\n\n".
                    'If you did not sign up for an account with us you can disregard this message.'
                );
                $this->Session->setFlash(__('Please confirm your account via the link in the email we just sent.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $this->set('token', $token_g);
    }

    public function verify($token_g) {
        $this->loadModel('Token');
        $token=$this->Token->find('first', array('conditions' => array('Token.token' => $token_g)));
        if(empty($token)) {
            $this->Session->setFlash(__('Invalid Token.'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'users', 'action' => 'register'));
        }
        $this->User->id = $token['Token']['userid'];
        $this->User->saveField('active', 1);
        $this->User->saveField('role_id', $token['Token']['role']);
        $this->Token->id = $token['Token']['id'];
        $this->Token->delete();
        $this->Session->setFlash(__('Your account has been activated. You can login below.'), 'default', array('class' => 'alert alert-success'));
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'])));
            if(!empty($user)) {
                if($user['User']['active']==0) {
                    $this->Session->setFlash(__('Your account has not been activated. Check your email for instructions.'), 'default', array('class' => 'alert alert-danger'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
            }
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again. If you can\'t login reset your password <a href="'.Router::url(array('controller' => 'users', 'action', 'login')).'">here</a>'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }

    public function invite($role = null) {
        if ($this->request->is('post')) {
            if ($role!='admin' && $role!='webmaster') {
                $this->Session->setFlash(__('Invite Error'), 'default', array('class' => 'alert alert-danger'));
                return $this->redirect(array('controller' => 'users', 'action' => 'register'));
            }
            if ($role=='webmaster') {
                if($this->Auth->user('role_id')!=3) {
                    $this->Session->setFlash(__('Invite Error (your not a webmaster)'), 'default', array('class' => 'alert alert-danger'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'register'));
                }
            }

            $this->loadModel('Setting');
            $this->loadModel('Token');
            $owner_name=$this->Setting->find('first', array('conditions' => array('Setting.id' => 1)));
            $owner_name=$owner_name['Setting']['value'];
            $owner_email_out=$this->Setting->find('first', array('conditions' => array('Setting.id' => 2)));
            $owner_email_out=$owner_email_out['Setting']['value'];

            $token_g=md5(uniqid(rand(), true));
            while($this->Token->hasAny(array('Token.token' => $token_g))) {
                $token_g=md5(uniqid(rand(), true));
            }
            if($role=='admin')
                $token['Token']['role']=2;
            if($role=='webmaster')
                $token['Token']['role']=3;
            $token['Token']['token']=$token_g;
            $token['Token']['type']='account_creation';
            $this->Token->save($token);

            $Email = new CakeEmail();
            $Email->from(array($owner_email_out => $owner_name));
            $Email->to($this->request->data['User']['email']);
            $Email->subject($owner_name.' Account Invitation');
            $Email->send(
                'Account Invitation ('.$role.') from '.$owner_name.'!'."\n\n".
                'To create your account please visit:'."\n".
                Router::url(array('controller' => 'users', 'action' => 'register', $token_g), true)."\n\n"
            );
            $this->Session->setFlash(__('An invitation has been sent to '.$this->request->data['User']['email']), 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('controller' => 'users', 'action' => 'invite', $role));
        }





    }

    public function sendRecovery() {
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'])));
            if(!empty($user)) {
                $this->loadModel('Setting');
                $this->loadModel('Token');
                $owner_name=$this->Setting->find('first', array('conditions' => array('Setting.id' => 1)));
                $owner_name=$owner_name['Setting']['value'];
                $owner_email_out=$this->Setting->find('first', array('conditions' => array('Setting.id' => 2)));
                $owner_email_out=$owner_email_out['Setting']['value'];

                $token_g=md5(uniqid(rand(), true));
                while($this->Token->hasAny(array('Token.token' => $token_g))) {
                    $token_g=md5(uniqid(rand(), true));
                }
                $token['Token']['userid']=$user['User']['id'];
                $token['Token']['token']=$token_g;
                $token['Token']['type']='account_recovery';
                $this->Token->save($token);

                $Email = new CakeEmail();
                $Email->from(array($owner_email_out => $owner_name));
                $Email->to($this->request->data['User']['email']);
                $Email->subject($owner_name.' Account Recovery');
                $Email->send(
                    'Account Recovery from '.$owner_name.'!'."\n\n".
                    'To reset your password please visit:'."\n".
                    Router::url(array('controller' => 'users', 'action' => 'changePassword', $token_g), true)."\n\n\n".
                    'If you did not sign up for an account with us you can disregard this message.'
                );
                $this->Session->setFlash(__('You can reset your password via the link in the email we just sent to '.$user['User']['email'].'.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                $this->Session->setFlash(__('You can reset your password via the link in the email we just sent to '.$user['User']['email'].'.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
    }

    public function changePassword($token_in = null) {
        $this->loadModel('Token');
        if($token_in==null || !$this->Token->hasAny(array('Token.token' => $token_in))) {
            $this->Session->setFlash(__('You have provided an invalid token. Confirm your url or request a new reset.'), 'default', array('class' => 'alert alert-danger'));
            return $this->redirect(array('controller' => 'users', 'action' => 'forgotPassword'));
        }
        $token = $this->Token->find('first', array('conditions' => array('token' => $token_in)));
        $user = $this->User->find('first', array('controller' => array('user_id' => $token['Token']['userid'])));

        if ($this->request->is('post')) {
            if($this->request->data['User']['password']!=$this->request->data['User']['password_repeat']) {
                $this->Session->setFlash(__('The passwords provided did not match. Please try again.'), 'default', array('class' => 'alert alert-danger'));
                return $this->redirect(array('controller' => 'users', 'action' => 'changePassword', $token_in));
            }
            $user['User']['password']=$this->request->data['User']['password'];
            if($this->User->save($user)) {
                $this->Token->id=$token['Token']['id'];
                $this->Token->delete();
                $this->Session->setFlash(__('Your password has been reset! You can login below'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                $this->Session->setFlash(__('Something went wrong. Please try again.'), 'default', array('class' => 'alert alert-danger'));
                return $this->redirect(array('controller' => 'users', 'action' => 'changePassword', $token_in));
            }

        }


        $this->set('user_email', $user['User']['email']);
    }

    public function forgotPassword() {

    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function profile() {
        if ($this->request->is(array('post', 'put'))) {
            $this->loadModel('Profile');
            //debug($this->request->data);
            $this->Profile->save($this->request->data);
        }
        $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
        $this->set('user', $user);
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}



/**
 * add method
 *
 * @return void
 */
    public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
            if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}







}
