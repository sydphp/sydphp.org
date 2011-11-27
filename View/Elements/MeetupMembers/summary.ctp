<?php
$member = $meetupMember['MeetupMember'];
?>
<div class="member-summary span4">
	<div class="member-thumb">
		<?php echo $this->Meetup->thumb($member); ?>
	</div>

	<strong><?php echo ucwords(strtolower($member['name'])); ?></strong>

	<?php if (isset($member['bio'])): ?>
		<p><?php echo $this->Text->truncate($member['bio'], 160); ?></p>
	<?php endif; ?>

	<?php echo $this->Html->link(
		__('View profile'),
		array('action' => 'view', $member['id']),
		array(
			'data-controls-modal' => 'member-' . $member['id'] . '-modal',
			'data-backdrop' => 'true',
			'keyboard' => 'true',
		)); ?>
</div>
<?php echo $this->element('MeetupMembers/modal', array('member' => $member)); ?>