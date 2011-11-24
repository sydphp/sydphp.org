<div class="event-summary">
	<div class="calendar event_date">
		<span class="month"><?php echo $this->Time->format('M', $meetupEvent['MeetupEvent']['datetime']); ?></span>
		<span class="day"><?php echo $this->Time->format('j', $meetupEvent['MeetupEvent']['datetime']); ?></span>
	</div>
	<h2><?php echo $this->Html->link($meetupEvent['MeetupEvent']['name'], array('action' => 'view', $meetupEvent['MeetupEvent']['id'])); ?></h2>
	<div class="well">
		<div class="attendees">
			<?php for ($i = 0; $i < min(13, count($meetupEvent['MeetupRSVP'])); $i++): ?>
				<?php
				$rsvp = $meetupEvent['MeetupRSVP'][$i]['MeetupRSVP'];
				echo $this->Meetup->thumb($rsvp, $rsvp['member']['name'], array('width' => 30, 'height' => 30));
				?>
			<?php endfor; ?>
		</div>
		<p><strong><?php echo __d('meetup', '%s developers attending', $meetupEvent['MeetupEvent']['yes_rsvp_count']); ?></strong></p>
		<?php echo $this->Text->truncate($meetupEvent['MeetupEvent']['description'], 450, array('html' => true)); ?>
		<div><?php echo $this->Html->link(
			__('Read more about this event') . ' &raquo;',
			array('action' => 'view', $meetupEvent['MeetupEvent']['id']), array('escape' => false)); ?></div>
	</div>
</div>
