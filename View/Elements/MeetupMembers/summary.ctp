<?php
$member = $meetupMember['MeetupMember'];
?>
<div class="member-summary">
	<?php echo $this->Meetup->thumb($member); ?>
	<h2><?php echo $member['name']; ?></h2>
	<p><?php echo $member['bio']; ?></p>
</div>