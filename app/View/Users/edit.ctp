<!-- View/Users/edit.ctp -->
<?php echo $this->Html->tag('h1', __('edit_user')); ?>
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('username', array('label' => 'Username'));
	echo $this->Form->input('password', array('label' => 'New Password'));
	echo $this->Form->input('role', array('options' => array('admin' => 'Admin', 'author' => 'Author')));
	echo $this->Form->end('Save');
?>
