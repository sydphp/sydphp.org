<?php
App::uses('AppModel', 'Model');

/**
 * Meetup AppModel
 *
 * @package Meetup
 * @subpackage Meetup.Model
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupAppModel extends AppModel {

/**
 * Use DB Config
 *
 * @var string
 */
	public $useDbConfig = 'meetup';

/**
 * Recursion level
 *
 * @var string
 */
	public $recursive = -1;

/**
 * Cache find() calls
 *
 * @var boolean
 */
	public $cacheFinds = true;

/**
 * Implement caching for find()
 *
 * @param string $type Find type
 * @param array $query Query data
 * @return array Data
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function find($type = 'first', $query = array()) {
		if (!$this->cacheFinds || Configure::read('debug') !== 0) {
			return parent::find($type, $query);
		}

		$key = $this->alias . '_find_' . md5($type . json_encode($query['conditions']));

		if (!($data = Cache::read($key, 'meetup'))) {
			$data = parent::find($type, $query);
			Cache::write($key, $data, 'meetup');
		}

		return $data;
	}

}
