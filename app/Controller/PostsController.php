<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController {
			
	function index() {
		$this->set(
			'posts', 
			$this->Post->query(
				"SELECT posts.id, title, body, posts.created, posts.modified, username, posts.user_id, posts.slug "
				."FROM posts INNER JOIN users ON posts.user_id = users.id"
			)	
		);		
		$this->_assign();
	}
	
	function add() {
		if ($this->request->is('post')) {
			
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('add_post_successfully'));
				return $this->redirect(['controller' => 'posts', 'action' => 'index']);
			}
			$this->Flash->error(__('add_post_fail'));
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$post = $this->Post->findById($id);
		
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowed();
		} else if ($this->request->is('post')) {
			
			$this->Post->id = $id;
			
			if ($this->Post->delete()) {							
				$this->Flash->success(__('Success on deleting the post with id %d', h($id)));
				return $this->redirect(['controller' => 'posts', 'action' => 'index']);				
			}
			
			$this->Flash->error(__('Error to delete the post with id %d', h($id)));
		}
	}
	
	function view($slug = null) {
		if (!$slug) {
			throw new NotFoundException(__('invalid_post'));
		}
		
		$posts = $this->Post->query(
			sprintf(
				"SELECT posts.id, title, body, posts.created, posts.modified, users.username FROM posts "
				."INNER JOIN users ON posts.user_id = users.id "
				."WHERE slug = '%s'"
				,h($slug)				
			)
		);
		if (!$posts) {
			throw new NotFoundException(__('invalid_post'));
		}
		
		$this->set('posts', $posts);
	} 	
	
	function edit($id) {
		if (!$id) {
			throw new NotFoundException(__('invalid_post'));
		}
				
		$post = $this->Post->findById($id);			
		
		if (!$post) {
			throw new NotFoundException(__('invalid_post'));
		}
		
		if ($this->request->is('post') or $this->request->is('put')) {		
			
			$this->Post->id = $id;
			
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('save_post_success'));	
				return $this->redirect(['controller' => 'posts', 'action' => 'index']);
			} else {
				$this->Flash->error(__('save_post_fail'));
			}			
		}
		if (!$this->request->data) {
			$this->request->data = $post;
		}		
	}
	
	function isAuthorized($user) {				
		if ($this->action === 'add') {
			return true;
		}
		
		if (in_array($this->action, ['edit', 'delete'])) {
			$post_id = (int) $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($post_id, $user['id'])) {
				return true;
			}
		}
		
		return parent::isAuthorized($user);
	}
	
	protected function _assign() {
		$this->set('logged_user', $this->Auth->user());
	}	
}

?>
