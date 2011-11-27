<?php
$member = $member['MeetupMember'];
?>
<div>
	<div class="member-thumb span2">
		<?php echo $this->Meetup->thumb($member); ?>
	</div>

	<div class="span8">
		<h2><?php echo ucwords(strtolower($member['name'])); ?></h2>
		<?php
		echo $this->element('MeetupMembers/bio', array('member' => $member));
		echo $this->element('MeetupMembers/social', array('member' => $member));
		?>
		
		<p><?php echo $this->Meetup->profileLink('View profile on meetup.com &raquo;', $member, array('class' => 'btn primary', 'escape' => false)); ?></p>
	</div>
	
	<div class="span4">
		<?php echo $this->element('layout/sidebar'); ?>
	</div>
</div>
