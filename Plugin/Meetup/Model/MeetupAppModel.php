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

}
