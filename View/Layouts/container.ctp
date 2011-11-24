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

	<link rel="shortcut icon" href="favicon.ico">
	<!--
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	-->
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
	
	<script type="text/javascript" src="/js/jquery/jquery.17.min.js"></script>
	<script type="text/javascript" src="/js/jquery/bootstrap-modal.js"></script>
	<script type="text/javascript" src="/js/jquery/Application.js"></script>
</body>
</html>