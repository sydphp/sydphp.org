<?php foreach ($meetupMembers as $member): ?>
	<?php echo $this->element('MeetupMembers/summary', array('meetupMember' => $member)); ?>
<?php endforeach; ?>
