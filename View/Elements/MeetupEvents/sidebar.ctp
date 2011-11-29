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
		<div class="attending-user">
			<?php
			echo $this->Html->image($rsvp['MeetupRSVP']['member_photo']['thumb_link'], array('width' => 40, 'height' => 40));
			echo $rsvp['MeetupRSVP']['member']['name'];
			?>
		</div>
	<?php endforeach; ?>
</div>