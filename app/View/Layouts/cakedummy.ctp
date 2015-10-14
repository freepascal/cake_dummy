<DOCTYPE html>

<!-- View/Layouts/cake_dummy.ctp -->

<html>
<title><?php echo $this->fetch('title'); ?></title>
<body>
	<div id="container">
		<div id="header"><?php echo $this->fetch('header'); ?></div>		
		<did id="content">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>	
		</div>
		<div id="footer"><?php echo $this->fetch('footer'); ?></div>
	</div>
</body>	
</html>
