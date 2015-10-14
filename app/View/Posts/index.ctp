<!-- View/Posts/index.ctp -->

<!-- Login status -->
<?php 
	if (isset($logged_user)) {
		echo __('you_are_logged_in_as'). __('[%s] ', $logged_user['username']); 
		echo $this->Html->link(__('logout'), ['controller' => 'users', 'action' => 'logout']);
	} else {
		echo $this->Html->link(__("login"), ['controller' => 'users', 'action' => 'login']);
		echo " or ";
		echo $this->Html->link(__("register"), ['controller' => 'users', 'action' => 'add']);		
	}
?>


<p><?php echo $this->Html->link(__('add_post'), ['controller' => 'posts', 'action' => 'add']); ?></p>


<?php echo $this->Html->tag('h1', __('all_posts')); ?>
<table>
	<tr>
		<td><?php echo __("post_id"); ?></td>
		<td><?php echo __("post_title"); ?></td>
		<td><?php echo __("post_author"); ?></td>
		<td><?php echo __("post_created"); ?></td>
		<td><?php echo __("post_actions"); ?></td>
	</tr>
	
	<?php foreach($posts as $post): ?>
	<tr>
		<td><?php echo $post['posts']['id']; ?></td>
		<td><?php echo $this->Html->link($post['posts']['title'], array('controller' => 'posts', 'action' => 'view', $post['posts']['slug'])); ?></td>
		<td><?php echo $post['users']['username']; ?></td>
		<td><?php echo $post['posts']['created']; ?></td>		
		<td>
			<?php echo $this->Html->link(__("edit"), array('controller' => 'posts', 'action' => 'edit', $post['posts']['id'])); ?>	
			<?php echo " | "; ?>
			<?php echo $this->Form->postLink(__("delete"), array('controller' => 'posts', 'action' => 'delete', $post['posts']['id'], 'confirm' => 'Are you sure?')); ?></td>
	</tr>
	<?php endforeach; ?>	
</table>



<?php echo $this->Html->link(__('add_post'), ['controller' => 'posts', 'action' => 'add']); ?>

<!-- LINK TO ALL USERS -->
<p><?php echo $this->Html->link(__('see_all_users'), array('controller' => 'users', 'action'=>'index')); ?></p>

<!-- TRANSLATIONs -->
<p>
<?php 
	echo "Translate into ";
	echo $this->Html->link("English", ['controller' => 'langs', 'action' => 'change', 'en']); 
	echo "|";
	echo $this->Html->link("Vietnamese", ['controller' => 'langs', 'action' => 'change', 'vi']);
?> 
</p>


<?php unset($posts); ?>
