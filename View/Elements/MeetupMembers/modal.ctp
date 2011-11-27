<div id="member-<?php echo $member['id']; ?>-modal" class="modal hide fade">
	<div class="modal-header">
		<a href="#" class="close">×</a>
		<h3><?php echo ucwords(strtolower($member['name'])); ?></h3>
	</div>
	<div class="modal-body row">
		<div class="span2">
			<?php echo $this->Meetup->thumb($member); ?>
		</div>
		<div class="span6">
			<?php
			echo $this->element('MeetupMembers/bio', array('member' => $member));
			echo $this->element('MeetupMembers/social', array('member' => $member));
			?>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn primary" data-controls-modal="member-<?php echo $member['id']; ?>-modal">Close</a>
		<?php echo $this->Meetup->profileLink('View profile on meetup.com &raquo;', $member, array('class' => 'btn secondary', 'escape' => false)); ?>
	</div>
</div>
