<?php foreach ($meetupMembers as $key => $member): ?>
	<?php echo $this->element(
		'MeetupMembers/summary',
		array('meetupMember' => $member)
	); ?>
<?php endforeach; ?>
