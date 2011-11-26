<div class="span10">
	<?php foreach ($meetupEvents as $event): ?>
		<?php echo $this->element('MeetupEvents/summary', array('meetupEvent' => $event)); ?>
	<?php endforeach; ?>
	<h3><?php __d('meetup', 'More event information'); ?></h3>
	<p><?php echo __d('meetup', 'You can also %s for event information.', $this->Html->link(__d('meetup', 'visit our Meetup.com page'), 'http://meetup.com/' . $groupName)); ?></p>
</div>

<div class="span4 sidebar">
	<?php echo $this->element('layout/sidebar'); ?>
</div>
