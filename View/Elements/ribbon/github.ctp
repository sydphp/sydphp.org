<?php
$imageUrl = 'http://a248.e.akamai.net/assets.github.com/img/7afbc8b248c68eb468279e8c17986ad46549fb71/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67';

echo $this->Html->link(
	$this->Html->image(
		$imageUrl,
		array()),
	'http://github.com/sydphp',
	array(
		'class' => 'github-ribbon',
		'escape' => false,
	)
);
