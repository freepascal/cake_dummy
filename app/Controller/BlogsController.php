<?php

App::uses('AppController', 'Controller');

class BlogsController extends AppController {
	
	//var $components = array('Auth');
	
	function beforeFilter() {
		$this->Auth->allow('index');
		parent::beforeFilter();
	}
	
	function index() {
		$this->layout = 'cakedummy';
		$this->set('blog_content', <<<DOC_HERE
	Life is short, use Java, PHP, Python && C/C++!	
DOC_HERE
);		
	}
}

?>
