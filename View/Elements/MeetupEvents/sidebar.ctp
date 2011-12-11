<h3>Join the Meetup!</h3>
<p>While an RSVP is not absolutely necessary, it gives us an idea of how many people will be attending, and lets others know you'll be there.</p>
<table>
	<tbody>
		<tr>
			<td><strong>Yes!</strong></td>
			<td><?php echo $meetupEvent['MeetupEvent']['yes_rsvp_count']; ?></td>
		</tr>
		<tr>
			<td><strong>Maybe</strong></td>
			<td><?php echo $meetupEvent['MeetupEvent']['maybe_rsvp_count']; ?></td>
		</tr>
	</tbody>
</table>
<a href="<?php echo $meetupEvent['MeetupEvent']['event_url']; ?>" target="_blank" class="btn primary">RSVP for the meetup</a>

<br/></br/>

<h3>They're Attending!</h3>
<div class="attendees">
	<?php foreach ($meetupRSVPs as $rsvp): ?>
		<?php
		echo $this->Html->link(
			$this->Html->image($rsvp['MeetupMember']['photo']['thumb_link'], array('width' => 40, 'height' => 40, 'alt' => $rsvp['MeetupMember']['name'])),
			array(
				'plugin' => 'meetup',
				'controller' => 'meetup_members',
				'action' => 'view',
				$rsvp['MeetupMember']['id']),
			array(
				'data-controls-modal' => 'member-' . $rsvp['MeetupMember']['id'] . '-modal',
				'data-backdrop' => 'true',
				'keyboard' => 'true',
				'escape' => false)
		);
		echo $this->element('MeetupMembers/modal', array('member' => $rsvp['MeetupMember']));
		?>
	<?php endforeach; ?>
</div>