<div class="span10">
	<table class="zebra-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Date</th>
				<th>RSVPs</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($meetupEvents as $event): ?>
				<tr>
					<td><?php echo $event['MeetupEvent']['name']; ?></td>
					<td><?php echo $this->Time->format('j M Y @ g:ia', $event['MeetupEvent']['datetime']); ?></td>
					<td><?php echo $event['MeetupEvent']['yes_rsvp_count']; ?></td>
					<td>
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $event['MeetupEvent']['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="span4 sidebar">
	<?php echo $this->element('layout/sidebar'); ?>
</div>
