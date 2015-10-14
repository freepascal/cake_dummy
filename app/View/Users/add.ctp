<!-- View/Users/add.ctp -->
<?php echo $this->Html->tag('h1', __('add_user')); ?>

<div class="users form">
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('username');
	echo $this->Form->input('password', array('type' => 'password'));
	echo $this->Form->input('role', array('options' => ['admin' => 'Admin', 'author' => 'Author']));
	echo $this->Form->end(__('add_user'));
?>
</div>
