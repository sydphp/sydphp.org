<?php
$member = $meetupMember['MeetupMember'];
?>
<div class="member-summary span4">
	<?php
	$thumb = $this->Meetup->thumb($member, $member['name'], array('class' => 'member-thumb'));
	$name = $this->Html->tag('strong', ucwords(strtolower($member['name'])));
	echo $this->Html->link(
		$thumb . $name,
		array('action' => 'view', $member['id']),
		array(
			'data-controls-modal' => 'member-' . $member['id'] . '-modal',
			'data-backdrop' => 'true',
			'keyboard' => 'true',
			'escape' => false)
	);
	?>
</div>
<?php echo $this->element('MeetupMembers/modal', array('member' => $member)); ?>