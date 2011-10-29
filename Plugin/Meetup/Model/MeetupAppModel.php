<?php
App::uses('AppModel', 'Model');

class MeetupAppModel extends AppModel {

	public $useDbConfig = 'rest';

	protected function _requestUri() {
		Configure::load('meetup');
		$meetup = Configure::read('Meetup');
		$request = array(
			'host' => $meetup['host'],
			'query' => array(
				'key' => $meetup['key'],
			)
		);
		
		if ($meetup['sign']) {
			$request['query']['sign'] = 'true';
		}
		
		return $request;
	}
}
