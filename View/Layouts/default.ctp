<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sydney PHP User Group - <?php echo $title_for_layout; ?></title>
	<meta name="description" content="SydPHP: Sydney's PHP User Group">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/sydphp.css" rel="stylesheet">
	<link rel="shortcut icon" href="/favicon.ico">
</head>

<body>
	<?php echo $this->element('layout/topbar'); ?>

	<div class="container">
		<div class="content">
			<div class="page-header">
				<h1><?php echo $title_for_layout; ?></h1>
			</div>
			<div class="row">
				<?php
				echo $this->Session->flash();
				echo $content_for_layout;
				?>
			</div>
		</div>

		<?php echo $this->element('layout/footer'); ?>
	</div>
	<?php echo $this->element('ribbon/beta'); ?>
	<?php echo $this->element('ribbon/github'); ?>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script>window.jQuery || document.write("<script src='/js/libs/jquery-1.7.min.js'>\x3C/script>")</script>
	<script type="text/javascript" src="/js/libs/bootstrap-modal.js"></script>
	<script type="text/javascript" src="/js/sydphp.js"></script>
	<?php echo $this->GoogleAnalytics->pageTracker(Configure::read('Google.Analytics.Key')); ?>
</body>
</html>