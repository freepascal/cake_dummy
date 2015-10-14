<!-- View/Blogs/index.ctp -->
<?php
	$this->layout = 'cakedummy';
	$this->assign('header', __('This is header'));
	$this->assign('content', __($blog_content));
	$this->assign('footer', __('This is footer'));
?>
