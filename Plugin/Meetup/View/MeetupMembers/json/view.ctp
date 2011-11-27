<?php
$allowedKeys = array(
	'bio',
	'id',
	'joined',
	'name',
	'other_services',
	'photo',
	'visited',
);
echo json_encode(
	array_intersect_key(
		$member['MeetupMember'],
		array_flip($allowedKeys)
	)
);