<?php
App::uses('MeetupAppController', 'Meetup.Controller');

/**
 * Meetup Members Controller
 *
 * @package Meetup
 * @subpackage Meetup.Controller
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupMembersController extends MeetupAppController {

/**
 * Index action
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function index() {
		$meetupMembers = $this->MeetupMember->find('all', array('conditions' => array('group_urlname' => 'SydPHP')));
		$this->set(compact('meetupMembers'));
	}

}
