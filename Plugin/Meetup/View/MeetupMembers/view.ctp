<?php $member = $member['MeetupMember']; ?>
<div class="span10">
	<?php if (Configure::read('debug')): ?>
		<div class="debug">
			<?php debug($member); ?>
		</div>
	<?php endif; ?>
	<?php echo $this->Meetup->photo($member); ?>
	<?php if (isset($member['bio'])): ?>
		<p><?php echo $member['bio']; ?>
	<?php endif; ?>
</div>
<div class="sidebar span4">
	<?php echo $this->element('layout/sidebar'); ?>
</div>