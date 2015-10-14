<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();		
		// allow user to register && logout
		$this->Auth->allow(['add', 'logout']);
	}
	
	function index() {
		$this->recursive = 0;
		$this->paginate();
		$this->set('users', $this->User->find('all'));
		$this->_assign();
	}
	
	function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('invalid_user'));
		}
		$this->set('user', $this->User->findById($id));
	}
	
	function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('add_user_success'));
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
			$this->Flash->error(__('add_user_error'));
		}
	}
	
	function edit($id = null) {
		$this->User->id = $id;
		
		if (!$this->User->exists()) {
			throw new NotFoundException(__('invalid_user'));
		}
		
		if ($this->request->is(['post', 'put'])) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('edit_user_success'));
				
				// fetch again
				$this->Auth->login();
				
				return $this->redirect(['controller' => 'users', 'action' => 'index']);
			}
			$this->Flash->error(__('edit_user_fail'));			
		} else {
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);			
		}
	}
	
	function delete($id) {		
		if (!$id) {
			throw new NotFoundException(__('invalid_post'));
		}
		
		if ($this->request->is('get')) {
			
			throw new MethodNotAllowedException();			
		} else if ($this->request->is('post')) {
		
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('invalid_user'));
			}
		
			if ($this->User->delete()) {
				$this->Flash->success(__('delete_success'));
				
				if ((int)$id === (int)$this->Auth->user('id')) {
					// tu xoa nick minh
					return $this->redirect($this->Auth->logout());
				}
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		
			$this->Flash->error(__('delete_fail'));
			return $this->redirect(array('controller' => 'users', 'action' => 'index'));
		}		
	}
	
	function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Flash->success(__('login_success'));
				return $this->redirect($this->Auth->redirectUrl());
			}
			
			$this->Flash->error(__('invalid_user_passwd_combination'));
		}
	}
	
	function logout() {
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
	}
	
	protected function _assign() {
		$this->set('logged_user', $this->Auth->user());
	}	
	
	function isAuthorized($user) {
		
		// Admin can access every action
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		} else if (isset($user['role']) && $user['role'] === 'author') {
			if (in_array($this->action, ['edit', 'delete'])) {
				$user_id = (int) $this->request->params['pass'][0];
				
				return $user_id === ((int) $this->Auth->user('id'));
			}
		}	
		return false;			
	}
}

?>
