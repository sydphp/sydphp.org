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
	public function next($name) {
		return $this->find('first', array('conditions' => array('group_urlname' => $name)));
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
