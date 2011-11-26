<?php
App::uses('MeetupAppModel', 'Meetup.Model');

/**
 * MeetupMember Model
 *
 * @package Meetup
 * @subpackage Meetup.Model
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupMember extends MeetupAppModel {

/**
 * Use Table
 *
 * @var string
 */
	public $useTable = 'meetup_members';

/**
 * Primary Key
 *
 * @var string
 */
	public $primaryKey = 'member_id';

}
