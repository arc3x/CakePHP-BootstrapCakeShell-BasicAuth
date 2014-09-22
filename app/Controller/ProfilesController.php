<?php
App::uses('AppController', 'Controller');
/**
 * Profiles Controller
 *
 * @property Profile $Profile
 * @property PaginatorComponent $Paginator
 */
class ProfilesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Profile->recursive = 0;
		$this->set('profiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Profile->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
		$this->set('profile', $this->Profile->find('first', $options));
	}



/**
 * add method
 *
 * @return void
 */
    public function add() {
		if ($this->request->is('post')) {
			$this->Profile->create();
            if(isset($this->request->data['Profile']['upload'])) {
                foreach($this->request->data['Profile']['upload'] as $key => $upload) {
                    $file=$upload;
                    $path=APP.'webroot/img/Profiles/'.$file['name'];

                    while(file_exists($path)) {
                        $r=rand(1,10000);
                        $file['name']=$r.$file['name'];
                        $path=APP.'webroot/img/Profiles/'.$file['name'];
                    }
                    if ($file['error'] == 0) {
                        if (move_uploaded_file($file['tmp_name'], $path)) {
                            $this->request->data['Profile'][$key]='Profiles/'.$file['name'];;
                                if (array_key_exists('thumbnail_'.$key, $this->request->data['Profile'])) {
                                    $thumb_path=APP.'webroot/img/Profiles/thumbnail_'.$file['name'];
                                    $this->createThumb($path,$thumb_path,200);
                                    $this->request->data['Profile']['thumbnail_'.$key]='Profiles/thumbnail_'.$file['name'];
                                }
                        } else {
                            $this->Session->setFlash(__('Something went wrong. Please try again.'));
                            $this->redirect(array('action' => 'index'));
                        }
                    }
                }
            }
            if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Profile->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->Profile->id = $id;
            if(isset($this->request->data['Profile']['upload'])) {
                foreach($this->request->data['Profile']['upload'] as $key => $upload) {
                    if(!empty($this->request->data['Profile']['upload'][$key]['name'])) {
                        $file=$upload;
                        $path=str_replace(DS, '/', IMAGES.'Profiles/'.$file['name']);
                        $read=$this->Profile->read($key);
                        $old_pic=str_replace(DS, '/', IMAGES.$read['Profile'][$key]);

                        if(file_exists($old_pic)) {
                            unlink($old_pic);
                            $item = $this->Profile->find('first', array(
                                'conditions' => array('Profile.id' => $id)
                            ));
                            if(array_key_exists('thumbnail_'.$key,$item['Profile'])) {
                                $read_thumb=$this->Profile->field('thumbnail_'.$key);
                                $old_thumb=str_replace(DS, '/', IMAGES.$read_thumb);
                                if(!empty($old_thumb)) {
                                    if(file_exists($old_thumb)) {
                                        unlink($old_thumb);
                                    }
                                }
                            }
                        }

                        while(file_exists($path)) {
                            $r=rand(1,10000);
                            $file['name']=$r.$file['name'];
                            $path=APP.'webroot/img/Profiles/'.$file['name'];
                        }
                        if ($file['error'] == 0) {
                            if (move_uploaded_file($file['tmp_name'], $path)) {
                                $this->request->data['Profile'][$key]='Profiles/'.$file['name'];;
                                    if (array_key_exists('thumbnail_'.$key, $this->request->data['Profile'])) {
                                        $thumb_path=IMAGES.'Profiles/thumbnail_'.$file['name'];
                                        $this->createThumb($path,$thumb_path,200);
                                        $this->request->data['Profile']['thumbnail_'.$key]='Profiles/thumbnail_'.$file['name'];
                                    }
                            } else {
                                $this->Session->setFlash(__('Something went wrong. Please try again.'));
                                $this->redirect($this->referer());
                            }
                        }
                    }
                }
            }
			if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
			$this->request->data = $this->Profile->find('first', $options);
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$this->request->onlyAllow('post', 'delete');
        $item = $this->Profile->find('first', array(
            'conditions' => array('Profile.id' => $id)
        ));
        //$base=str_replace(DS, '/', substr(ROOT,0,strrpos(ROOT, DS)));
        foreach($item['Profile'] as $key => $value) {
            if(!empty($value)) {
                if (strpos($key, 'picture') === 0 || strpos($key, 'thumbnail') === 0) {
                    $old_pic=str_replace(DS, '/', IMAGES.$value);
                    if(file_exists($old_pic)) {
                        unlink($old_pic);
                    }
                }
            }
        }
		if ($this->Profile->delete()) {
			$this->Session->setFlash(__('The profile has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The profile could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}






/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Profile->recursive = 0;
		$this->set('profiles', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Profile->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
		$this->set('profile', $this->Profile->find('first', $options));
	}



/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add() {
		if ($this->request->is('post')) {
			$this->Profile->create();
            if(isset($this->request->data['Profile']['upload'])) {
                foreach($this->request->data['Profile']['upload'] as $key => $upload) {
                    $file=$upload;
                    $path=APP.'webroot/img/Profiles/'.$file['name'];

                    while(file_exists($path)) {
                        $r=rand(1,10000);
                        $file['name']=$r.$file['name'];
                        $path=APP.'webroot/img/Profiles/'.$file['name'];
                    }
                    if ($file['error'] == 0) {
                        if (move_uploaded_file($file['tmp_name'], $path)) {
                            $this->request->data['Profile'][$key]='Profiles/'.$file['name'];;
                                if (array_key_exists('thumbnail_'.$key, $this->request->data['Profile'])) {
                                    $thumb_path=APP.'webroot/img/Profiles/thumbnail_'.$file['name'];
                                    $this->createThumb($path,$thumb_path,200);
                                    $this->request->data['Profile']['thumbnail_'.$key]='Profiles/thumbnail_'.$file['name'];
                                }
                        } else {
                            $this->Session->setFlash(__('Something went wrong. Please try again.'));
                            $this->redirect(array('action' => 'index'));
                        }
                    }
                }
            }
            if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Profile->exists($id)) {
			throw new NotFoundException(__('Invalid profile'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->Profile->id = $id;
            if(isset($this->request->data['Profile']['upload'])) {
                foreach($this->request->data['Profile']['upload'] as $key => $upload) {
                    if(!empty($this->request->data['Profile']['upload'][$key]['name'])) {
                        $file=$upload;
                        $path=str_replace(DS, '/', IMAGES.'Profiles/'.$file['name']);
                        $read=$this->Profile->read($key);
                        $old_pic=str_replace(DS, '/', IMAGES.$read['Profile'][$key]);

                        if(file_exists($old_pic)) {
                            unlink($old_pic);
                            $item = $this->Profile->find('first', array(
                                'conditions' => array('Profile.id' => $id)
                            ));
                            if(array_key_exists('thumbnail_'.$key,$item['Profile'])) {
                                $read_thumb=$this->Profile->field('thumbnail_'.$key);
                                $old_thumb=str_replace(DS, '/', IMAGES.$read_thumb);
                                if(!empty($old_thumb)) {
                                    if(file_exists($old_thumb)) {
                                        unlink($old_thumb);
                                    }
                                }
                            }
                        }

                        while(file_exists($path)) {
                            $r=rand(1,10000);
                            $file['name']=$r.$file['name'];
                            $path=APP.'webroot/img/Profiles/'.$file['name'];
                        }
                        if ($file['error'] == 0) {
                            if (move_uploaded_file($file['tmp_name'], $path)) {
                                $this->request->data['Profile'][$key]='Profiles/'.$file['name'];;
                                    if (array_key_exists('thumbnail_'.$key, $this->request->data['Profile'])) {
                                        $thumb_path=IMAGES.'Profiles/thumbnail_'.$file['name'];
                                        $this->createThumb($path,$thumb_path,200);
                                        $this->request->data['Profile']['thumbnail_'.$key]='Profiles/thumbnail_'.$file['name'];
                                    }
                            } else {
                                $this->Session->setFlash(__('Something went wrong. Please try again.'));
                                $this->redirect($this->referer());
                            }
                        }
                    }
                }
            }
			if ($this->Profile->save($this->request->data)) {
				$this->Session->setFlash(__('The profile has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The profile could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
			$this->request->data = $this->Profile->find('first', $options);
		}
		$users = $this->Profile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Profile->id = $id;
		if (!$this->Profile->exists()) {
			throw new NotFoundException(__('Invalid profile'));
		}
		$this->request->onlyAllow('post', 'delete');
        $item = $this->Profile->find('first', array(
            'conditions' => array('Profile.id' => $id)
        ));
        //$base=str_replace(DS, '/', substr(ROOT,0,strrpos(ROOT, DS)));
        foreach($item['Profile'] as $key => $value) {
            if(!empty($value)) {
                if (strpos($key, 'picture') === 0 || strpos($key, 'thumbnail') === 0) {
                    $old_pic=str_replace(DS, '/', IMAGES.$value);
                    if(file_exists($old_pic)) {
                        unlink($old_pic);
                    }
                }
            }
        }
		if ($this->Profile->delete()) {
			$this->Session->setFlash(__('The profile has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The profile could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
