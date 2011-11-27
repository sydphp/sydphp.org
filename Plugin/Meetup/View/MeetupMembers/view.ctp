<?php
$member = $member['MeetupMember'];
?>
<div>
	<div class="member-thumb span2">
		<?php echo $this->Meetup->thumb($member); ?>
	</div>

	<div class="span8">
		<h2><?php echo ucwords(strtolower($member['name'])); ?></h2>

		<?php if (isset($member['bio'])): ?>
			<p><?php echo $member['bio']; ?></p>
		<?php else: ?>
			<p><em>Member has not yet written a bio.</em></p>
		<?php endif; ?>

		<?php if (isset($member['other_services']) && count($member['other_services'])): ?>
			<p><strong>Get social with <?php echo $member['name']; ?></strong></p>
			<?php echo $this->Meetup->memberSocial($member); ?>
		<?php endif; ?>
		
		<p><?php echo $this->Meetup->profileLink('View profile on meetup.com &raquo;', $member, array('class' => 'btn primary', 'escape' => false)); ?></p>
	</div>
	
	<div class="span4">
		<?php echo $this->element('layout/sidebar'); ?>
	</div>
</div>
