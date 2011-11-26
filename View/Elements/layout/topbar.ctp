<div class="topbar">
	<div class="fill">
		<div class="container">
			<a class="brand" href="/">Syd<span class="php">PHP</span></a>
			<ul class="nav">
				<li><?php echo $this->Html->link(__('Home'), '/'); ?></li>
				<li><?php echo $this->Html->link(__('About'), array(
					'plugin' => null,
					'controller' => 'pages',
					'action' => 'display',
					'about',
				)); ?></li>
				<li><?php echo $this->Html->link(__('Events'), array(
					'plugin' => 'meetup',
					'controller' => 'meetup_events',
					'action' => 'index',
				)); ?></li>
				<li><?php echo $this->Html->link(__('Members'), array(
					'plugin' => 'meetup',
					'controller' => 'meetup_members',
					'action' => 'index',
				)); ?></li>
				<li><?php echo $this->Html->link(__('Sponsors'), array(
					'plugin' => null,
					'controller' => 'pages',
					'action' => 'display',
					'sponsors',
				)); ?></li>
				<li><?php echo $this->Html->link(__('Contact'), array(
					'plugin' => 'enquiries',
					'controller' => 'enquiries',
					'action' => 'add',
				)); ?></li>
			</ul>
			<!-- <form action="" class="pull-right">
				<input class="input-small" type="text" placeholder="Username">
				<input class="input-small" type="password" placeholder="Password">
				<button class="btn" type="submit">Sign in</button>
			</form> -->
		</div>
	</div>
</div>
