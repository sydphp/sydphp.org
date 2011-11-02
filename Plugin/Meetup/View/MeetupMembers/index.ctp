<?php
var_dump($meetupMembers);
$columns = array_chunk($meetupMembers, ceil(count($meetupMembers) / 2), true);
?>
<div class="span7">
	<?php foreach ($columns[0] as $key => $member): ?>
		<?php echo $this->element('MeetupMembers/summary', array('meetupMember' => $member)); ?>
	<?php endforeach; ?>
</div>

<div class="span7">
	<?php foreach ($columns[1] as $key => $member): ?>
		<?php echo $this->element('MeetupMembers/summary', array('meetupMember' => $member)); ?>
	<?php endforeach; ?>
</div>
