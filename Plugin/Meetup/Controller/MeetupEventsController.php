<?php
App::uses('MeetupAppController', 'Meetup.Controller');

/**
 * MeetupEvents Controller
 *
 * @package Meetup
 * @subpackage Meetup.Controller
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupEventsController extends MeetupAppController {

/**
 * Before Filter
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function beforeFilter() {
		$this->set('title_for_layout', 'Events');
	}

/**
 * Index action
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function index() {
		$meetupEvents = $this->MeetupEvent->find('all', array('conditions' => array('group_urlname' => 'SydPHP')));
		$this->set(compact('meetupEvents'));
	}

/**
 * View action
 *
 * @param string $id Event ID
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Could not find the requested Event'));
		}
		$meetupEvent = $this->MeetupEvent->read(null, $id);
		$meetupRSVPs = $this->MeetupEvent->MeetupRSVP->find('all', array('conditions' => array('event_id' => $id)));

		$this->set(compact('meetupEvent', 'meetupRSVPs'));
	}
	
}
