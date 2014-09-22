<?php
App::uses('AppController', 'Controller');
/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 */
class SettingsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'index', 'edit', 'delete');
    }

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
		$this->Setting->recursive = 0;
		$this->set('settings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
		$this->set('setting', $this->Setting->find('first', $options));
	}



/**
 * add method
 *
 * @return void
 */
    public function add() {
		if ($this->request->is('post')) {
			$this->Setting->create();
            if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->Setting->id = $id;
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Setting->delete()) {
			$this->Session->setFlash(__('The setting has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The setting could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}







/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
		$this->set('setting', $this->Setting->find('first', $options));
	}



/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add() {
		if ($this->request->is('post')) {
			$this->Setting->create();
            if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->Setting->id = $id;
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Setting->delete()) {
			$this->Session->setFlash(__('The setting has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The setting could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
