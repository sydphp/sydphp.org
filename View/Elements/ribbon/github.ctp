<?php
$imageUrl = '/img/github_ribbon.png';

echo $this->Html->link(
	$this->Html->image($imageUrl),
	'http://github.com/sydphp',
	array(
		'class' => 'github-ribbon',
		'escape' => false,
	)
);
