<!-- View/Posts/edit.ctp -->
<p><?php echo $this->Html->tag('h1', __('Edit post')); ?></p>
<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('title');
	echo $this->Form->input('body');
	echo $this->Form->input('id', ['type' => 'hidden']);
	echo $this->Form->end('Save');
?>
