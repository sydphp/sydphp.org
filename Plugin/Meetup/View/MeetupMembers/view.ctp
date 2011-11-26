<?php $member = $member['MeetupMember'];?>
<div id="window-popup" class="modal hide fade">
	<div class="modal-header">
		<a href="#" class="close">&times;</a>
		<h3><?php echo $member['name']; ?></h3>
	</div>
	<div class="modal-body">
		<?php echo $this->Meetup->photo($member); ?>
		<?php if (isset($member['bio'])): ?>
			<p><?php echo $member['bio']; ?></p>
		<?php endif; ?>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn primary close">Close</a>
	</div>
</div>