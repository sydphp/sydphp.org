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
<a href="#" class="btn primary">RSVP for the meetup</a>

<br/></br/>

<h3>They're Attending!</h3>
<div>
	<?php foreach ($meetupRSVPs as $rsvp): ?>
		<?php echo "R "; ?>
	<?php endforeach; ?>
</div>