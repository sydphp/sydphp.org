<?php
App::uses('MeetupAppModel', 'Meetup.Model');
App::uses('HttpSocket', 'Network/Http');

/**
 * Meetup Event
 *
 * @package Meetup
 * @package Meetup.Model
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupEvent extends MeetupAppModel {

/**
 * Primary Key
 *
 * @var string
 */
	public $primaryKey = 'event_id';

/**
 * Has Many associations
 *
 * @var array
 */
	public $hasMany = array(
		'Meetup.MeetupRSVP',
	);

/**
 * Get the next occurring event
 *
 * @return mixed
 * @author Graham Weldon (http://grahamweldon.com)
 */
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

/**
 * After Find Callback
 *
 * @param array $results Results
 * @return array Results
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function afterFind($results) {
		$results = parent::afterFind($results);
		// var_dump($results);
		foreach ($results as &$result) {
			if (isset($result[$this->alias])) {
				$result[$this->alias]['datetime'] = $this->datetime(
					$result[$this->alias]['time'],
					$result[$this->alias]['utc_offset']
				);
				debug($result[$this->alias]['utc_offset']);
				debug($result[$this->alias]['datetime']);
			}
		}
		return $results;
	}

/**
 * Format datetime from meetup.com data
 *
 * @param string $time Time
 * @param string $utcOffset UTC Offset
 * @return int Adjusted time
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function datetime($time, $utcOffset) {
		return floor($time / 1000);// - floor($utcOffset / 1000); // - This is a wtf...
	}

}
