<?php if (isset($member['bio'])): ?>
	<p><?php echo $member['bio']; ?></p>
<?php else: ?>
	<p><em>Member has not yet written a bio.</em></p>
<?php endif; ?>
