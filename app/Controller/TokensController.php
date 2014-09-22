<?php
App::uses('AppController', 'Controller');
/**
 * Tokens Controller
 *
 * @property Token $Token
 * @property PaginatorComponent $Paginator
 */
class TokensController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Token->recursive = 0;
		$this->set('tokens', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Token->exists($id)) {
			throw new NotFoundException(__('Invalid token'));
		}
		$options = array('conditions' => array('Token.' . $this->Token->primaryKey => $id));
		$this->set('token', $this->Token->find('first', $options));
	}



/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add() {
		if ($this->request->is('post')) {
			$this->Token->create();
            if ($this->Token->save($this->request->data)) {
				$this->Session->setFlash(__('The token has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The token could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Token->exists($id)) {
			throw new NotFoundException(__('Invalid token'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->Token->id = $id;
			if ($this->Token->save($this->request->data)) {
				$this->Session->setFlash(__('The token has been saved.'), 'default', array('class' => 'alert alert-success'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect($this->referer());
                } else {
				    return $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The token could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Token.' . $this->Token->primaryKey => $id));
			$this->request->data = $this->Token->find('first', $options);
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
		$this->Token->id = $id;
		if (!$this->Token->exists()) {
			throw new NotFoundException(__('Invalid token'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Token->delete()) {
			$this->Session->setFlash(__('The token has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The token could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
