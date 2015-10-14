<!-- View/Users/index.ctp -->

<!-- login status -->
<?php 
	if (isset($logged_user)) {
		echo __('you_are_logged_in_as'). __('[%s] ', $logged_user['username']); 
		echo $this->Html->link("Logout", ['controller' => 'users', 'action' => 'logout']);
	} else {
		echo __($this->Html->link("login", ['controller' => 'users', 'action' => 'login']));
		/*
		echo " or ";
		echo __($this->Html->link("logout", ['controller' => 'users', 'action' => 'add']));		
		*/
	}
?>

<?php echo $this->Html->tag('h1', 'User list'); ?>

<?php echo $this->Html->link(__('add_user'), array('controller' => 'users', 'action' => 'add')); ?>

<table>
	<tr>
		<td>Username</td>
		<td>Role</td>
		<td>Actions</td>
	</tr>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['username']; ?></td>
		<td><?php echo $user['User']['role']; ?></td>
		<td><?php 
			echo $this->Html->link(__('edit'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); 
			echo "|";
			echo $this->Form->postLink(
				__('delete'), array('controller' => 'users', 'action' => 'delete', $user['User']['id'])
			); 
		?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php echo $this->Html->link(__('add_user'), array('controller' => 'users', 'action' => 'add')); ?>
