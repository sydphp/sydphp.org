<?php foreach ($meetupMembers as $key => $member): ?>
	<?php echo $this->element(
		'MeetupMembers/summary',
		array('meetupMember' => $member),
		array('cache' => array(
			'key' => 'member_' . $member['MeetupMember']['id']
		))
	); ?>
<?php endforeach; ?>
