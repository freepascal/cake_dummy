<!-- View/Posts/add.ctp -->
<p><?php echo __('add_post') ?></p>
<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('title');
	echo $this->Form->input('body', ['rows' => '3']);
	echo $this->Form->end('Add');
?>
