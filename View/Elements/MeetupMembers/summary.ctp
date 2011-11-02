<?php $member = $meetupMember['MeetupMember']; ?>
<div class="member-summary span4">
	<?php if (Configure::read('debug')): ?>
		<div class="debug">
			<?php debug($member); ?>
		</div>
	<?php endif; ?>

	<div class="member-thumb">
		<?php echo $this->Meetup->thumb($member); ?>
	</div>

	<strong><?php echo ucwords(strtolower($member['name'])); ?></strong>

	<?php if (isset($member['bio'])): ?>
		<p><?php echo $this->Text->truncate($member['bio'], 160); ?></p>
	<?php endif; ?>

	<?php echo $this->Html->link(__('View profile'), array('action' => 'view', $member['id'])); ?>

	<?php if (isset($member['other_services'])): ?>
		<?php if (isset($member['twitter'])): ?>
			<?php // @todo Link to twitter?>
		<?php endif; ?>
	<?php endif; ?>
</div>