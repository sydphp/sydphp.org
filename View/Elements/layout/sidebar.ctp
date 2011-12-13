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

<br/>
<br/>
<br/>

<h4>Proudly hosted by</h4>
<p><a href="http://www.mammothvps.com.au/vps/plans?ref=efb3c177e80549afbbc69f36011fee24" target="_blank"><img src="http://photos1.meetupstatic.com/photos/sponsor/c/1/5/4/iab120x90_469492.jpeg" alt="Mammoth media"/></a></p>