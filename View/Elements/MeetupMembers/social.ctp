<?php if (isset($member['other_services']) && count($member['other_services'])): ?>
	<p><strong>Get social with <?php echo $member['name']; ?></strong></p>
	<?php echo $this->Meetup->memberSocial($member); ?>
<?php endif; ?>
