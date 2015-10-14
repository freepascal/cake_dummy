<?php

App::uses('AppModel', 'Model');
App::uses('SluggableBehavior', 'Utils.Behavior');
App::uses('SluggableBehavior', 'Utils/Behavior');

class Post extends AppModel {
	var $validate = array(
		'title' => array(
			'rule' => 'notBlank'
		),
		'body' => array(
			'rule' => 'notBlank'
		)
	);
	
	function isOwnedBy($post_id, $user_id) {
		return (bool)$this->field(
			'id',
			array(
				'id' => $post_id,
				'user_id' => $user_id
			)
		);// !== false;
	}
	
	// hoc config cho quen tay
	public $actsAs = array(
		'Utils.Sluggable' => array(
			'label' => 'title',
			'slug' => 'slug',
			'scope' => array(),
			'separator' => '-',
			'length' => 255,
			'unique' => true,
			'update' => true,
			'trigger' => false,
			'method' => 'multibyteSlug',			
		)
	);
}

?>
