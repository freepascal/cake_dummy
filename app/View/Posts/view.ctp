<!-- View/Posts/view.ctp -->
<?php echo $this->Html->tag('h1', __('View post details')); ?>

<?php 
	if (isset($posts)) {
		echo "<p>";
		echo $this->Html->tag('p', $posts[0]['posts']['title']);		
		echo $this->Html->tag('small',
			sprintf(
				"%s %s %s %s", 
				__('created_in'), 
				$posts[0]['posts']['created'], 
				__('by'),
				$posts[0]['users']['username']
			)	
		);
		echo $this->Html->tag('p', $posts[0]['posts']['body']);
		echo "</p>";
	}
?>
