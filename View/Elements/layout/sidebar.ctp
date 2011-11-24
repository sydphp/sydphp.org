<h3>Next SydPHP Meetup</h3>
<p>Our next meetup is scheduled for <strong><?php echo $this->Time->format('l, j M Y', $nextEvent['MeetupEvent']['datetime']); ?></strong>
	at <?php echo $nextEvent['MeetupEvent']['venue']['name']; ?>.</p>
<?php echo $this->Text->truncate($nextEvent['MeetupEvent']['description'], 450, array('html' => true)); ?>
<?php echo $this->Html->link(
	'Event details',
	array(
		'plugin' => 'meetup',
		'controller' => 'meetup_events',
		'action' => 'view',
		$nextEvent['MeetupEvent']['id']),
	array('class' => 'btn primary')
); ?>
