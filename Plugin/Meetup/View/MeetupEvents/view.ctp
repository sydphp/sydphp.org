<div class="span10">
	<?php echo $this->Html->link('&laquo; Back to events', array('action' => 'index'), array('escape' => false)); ?>
	<h2><?php echo $meetupEvent['MeetupEvent']['name']; ?></h2>

	<table>
		<tbody>
			<tr>
				<td><strong>Date</strong></td>
				<td><?php echo $this->Time->format('l, j M Y', $meetupEvent['MeetupEvent']['datetime']); ?></td>
			</tr>
			<tr>
				<td><strong>Time</strong></td>
				<td><?php echo $this->Time->format('g:ia', $meetupEvent['MeetupEvent']['datetime']); ?></td>
			</tr>
			<tr>
				<td><strong>Venue</strong></td>
				<td><?php echo $this->Meetup->venue($meetupEvent['MeetupEvent']); ?></td>
			</tr>
		</tbody>
	</table>

	<?php echo $meetupEvent['MeetupEvent']['description']; ?>

	<h2>Venue</h2>
	<?php echo $this->Meetup->map($meetupEvent['MeetupEvent']); ?>
	
	<h2>More Information</h2>
	<p>You can find all information about the event, venue, people attending and more at the Meetup.com page.</p>
	<p><a href="<?php echo $meetupEvent['MeetupEvent']['event_url']; ?>" target="_blank" class="btn secondary">View the meetup.com page for this event</a></p>
</div>

<div class="span4 sidebar">
	<?php echo $this->element('MeetupEvents/sidebar', compact('meetupEvent')); ?>
</div>
