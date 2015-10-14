<?php

App::uses('AppController', 'Controller');

class LangsController extends AppController {
	function change($lang) {
		if (!empty($lang)) {
			if ($lang == 'vi') {
				$this->Session->write('Config.language', 'vi');				
			} else if ($lang == 'en') {
				$this->Session->write('Config.language', 'en');
			} else {
				// default
				$this->Session->write('Config.language', 'en');
			}
			
			return $this->redirect(
				['action' => 'index', 'controller' => 'posts']				
			);
		}
	}
	
	function beforeFilter() {
		$this->Auth->allow('change');
		parent::beforeFilter();
	}
}
	
?>
