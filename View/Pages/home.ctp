<?php
$this->set('title_for_layout', 'Sydney PHP User Group');
?>
<div class="span10">
	<h2><?php echo __('Recent Updates'); ?></h2>

	<div class="home-post short-post">
		<?php echo $this->element('home/tweet', array('tweet' => array(
			'name' => 'predominant',
			'text' => 'This is a tweet that is awesome. Its complete awesomeness is astounding This is a tweet that is awesome. Its complete awesomeness is astoun',
			'when' => '2011-11-04 12:43:03',
		))); ?>
	</div>
	
	<div class="home-post short-post">
		<?php echo $this->element('home/tweet', array('tweet' => array(
			'name' => 'predominant',
			'text' => 'This is a tweet that is awesome. Its complete awesomeness is astounding This is a tweet that is awesome. Its complete awesomeness is astoun',
			'when' => '2011-11-04 12:43:03',
		))); ?>
	</div>
	
	<div class="home-post short-post">
		This short post is a short post. Yeah.
	</div>
	
	<div class="home-post medium-post">
		Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer.
	</div>
	
	<div class="home-post short-post">
		This short post is a short post. Yeah.
	</div>
	
	<div class="home-post medium-post">
		Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer. Medium post content will be longer.
	</div>

	<div class="home-post short-post">
		This short post is a short post. Yeah.
	</div>
	
	<div class="home-post short-post">
		This short post is a short post. Yeah.
	</div>
	
</div>

<div class="span4 sidebar">
	<?php echo $this->element('layout/sidebar'); ?>
</div>
