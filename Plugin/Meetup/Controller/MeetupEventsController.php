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
 * Index action
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function index() {
		$groupName = 'SydPHP';
		$meetupEvents = $this->MeetupEvent->find('all', array('conditions' => array('group_urlname' => $groupName)));
		foreach ($meetupEvents as &$meetupEvent) {
			$meetupEvent['MeetupRSVP'] = $this->MeetupEvent->MeetupRSVP->find('all', array('conditions' => array('event_id' => $meetupEvent['MeetupEvent']['id'])));
		}
		$this->set('title_for_layout', 'Events');
		$this->set(compact('meetupEvents', 'groupName'));
	}

/**
 * View action
 *
 * @param string $id Event ID
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function view($id = null) {
		if (!$id || !($meetupEvent = $this->MeetupEvent->read(null, $id))) {
			throw new NotFoundException(__('Could not find the requested Event'));
		}
		$meetupRSVPs = $this->MeetupEvent->MeetupRSVP->find('all', array('conditions' => array('event_id' => $id)));
		App::uses('MeetupMember', 'Meetup.Model');
		$this->MeetupMember = new MeetupMember();
		$members = $this->MeetupMember->find('all', array(
			'conditions' => array(
				'group_urlname' => 'SydPHP',
				'order' => 'visited',
				'desc' => 'true'),
		));
		foreach ($members as $member) {
			$meetupMembers[$member['MeetupMember']['id']] = $member;
		}
		foreach ($meetupRSVPs as &$rsvp) {
			$rsvp = $meetupMembers[$rsvp['MeetupRSVP']['member']['member_id']];
		}
		$title_for_layout = 'Event: ' . $meetupEvent['MeetupEvent']['name'];

		$this->set(compact('meetupEvent', 'meetupRSVPs', 'title_for_layout'));
	}
	
}
