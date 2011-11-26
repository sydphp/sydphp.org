<div class="span10">
	<?php
	echo $this->Form->create();
		echo $this->Form->inputs(array('name', 'email', 'subject', 'message', 'legend' => false));
		echo $this->Form->input(__d('enquiries', 'Send Enquiry'), array('type' => 'submit', 'class' => 'btn primary', 'label' => false));
	$this->Form->end();
	?>
</div>
<div class="span4 sidebar">
	<?php echo $this->element('layout/sidebar'); ?>
</div>