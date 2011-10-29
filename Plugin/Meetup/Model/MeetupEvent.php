<?php

App::uses('MeetupAppModel', 'Meetup.Model');
App::uses('HttpSocket', 'Network/Http');

/**
 * Meetup Event
 *
 * @package Meetup
 * @package Meetup.Model
 * @author Graham Weldon
 */
class MeetupEvent extends MeetupAppModel {
	
	public $useDbConfig = 'meetup';

	public function next() {
		$meetup = Configure::read('Meetup');
		$request = array(
			'method' => 'GET',
			'uri' => array(
				'scheme' => $meetup['scheme'],
				'host' => $meetup['host'],
				'path' => '/2/events',
				'query' => array(
					'key' => $meetup['key'],
					'sign' => $meetup['sign'] ? 'true' : 'false',
					'group_urlname' => 'SydPHP',
				)
			)
		);
		
		$Http = new HttpSocket();
		$response = $Http->request($request);
		var_dump($response);
	}
	
	public function afterFind($results) {
		$results = parent::afterFind($results);
		foreach ($results as &$result) {
			$result[$this->alias]['datetime'] = $this->datetime(
				$result[$this->alias]['time'],
				$result[$this->alias]['utc_offset']
			);
		}
		return $results;
	}
	
	protected function datetime($time, $utcOffset) {
		return floor(($time - $utcOffset) / 1000);
	}

}
