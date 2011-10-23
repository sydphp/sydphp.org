<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title_for_layout; ?></title>
	<meta name="description" content="SydPHP: Sydney's PHP User Group">

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le styles -->
	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/sydphp.css" rel="stylesheet">

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<body>
	<?php echo $this->element('layout/topbar'); ?>

	<div class="container">
		<div class="content">
			<div class="page-header">
				<h1>Latest news <small>From the team and our community</small></h1>
			</div>
			<div class="row">
				<div class="span10">
					<h2>Planning has begun for Phunconf 2011!</h2>
					<img class="blogimage" src="../phunconf-2.0-logo.png" alt="SydPHP Phunconference 2.0"/>
					<p>Last year in 2010, we ran our first Phunconf. With support from industry sponsors, and a <strong>huge</strong> community turnout, we were so inspired that we've instituted the Phunconf as an annual event. This year promises to be bigger, better, and overall more awesome than last years epic event!</p>
					<p>We're in discussion with Google and a couple of other venue providers to secure the best spot to hold Phunconf, and we're seeking support and sponsorship from the community.</p>
					<p>This year we're extending the unconference discussion times, and enabling more worthwhile and extended discussions on each suggested topic.</p>
					<p>As always, food and drinks are provided, and there will be a tonne of giveaways to take home!</p>

					<br/>
					<h2>What do you want to hear about?</h2>
					<p>We often spend a lot of time, as organisers, struggling over what topics to bring you and what speakers to source.</p>
					<p>Our internationally recognised organisers are capable of sourcing speakers from all over the place, on a wide range of topics. If you have a specific topic or speaker you would like to hear from, we want to know about it!</p>
					<p>Help your community by suggesting a topic or speaker so we can deliver cutting edge, interesting content at each and every meetup!</p>
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
					<p>Don't forget to <a href="http://meetup.com/SydPHP" title="Lets us know you are coming">Lets us know you are coming</a>!</p>
				</div>
			</div>
		</div>

		<?php echo $this->element('layout/footer'); ?>
	</div> <!-- /container -->
</body>
</html>
