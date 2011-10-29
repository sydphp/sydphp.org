<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title_for_layout; ?></title>
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
				<div class="span10">
					<?php echo $content_for_layout; ?>
				</div>

				<div class="span4">
					<h3>Next SydPHP Meetup</h3>
					<p>Our next meetup is scheduled for <strong>Oct. 20th, 2011 at 7pm</strong> at the Sydney Mechanics School of Arts.</p>
					<p>Topics up for discussion:</p>
					<ul>
						<li>MySQL Performance</li>
						<li>CakePHP 2.0 released!</li>
					</ul>
					<p>We'll also be taking down some topic notes from people, and making these available on the website to encourage new speakers, and new members to come along.</p>
					<a href="#" class="btn primary">RSVP for the event</a>
				</div>
			</div>
		</div>

		<?php echo $this->element('layout/footer'); ?>
	</div> <!-- /container -->
</body>
</html>
