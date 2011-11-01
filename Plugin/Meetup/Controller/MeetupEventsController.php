<?php
App::uses('MeetupAppController', 'Meetup.Controller');

class MeetupEventsController extends MeetupAppController {
	
	public function beforeFilter() {
		$this->set('title_for_layout', 'Events');
	}
	
	public function index() {
		$meetupEvents = $this->MeetupEvent->find('all', array('conditions' => array('group_urlname' => 'SydPHP')));
		$this->set(compact('meetupEvents'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Could not find the requested Event'));
		}
		$meetupEvent = $this->MeetupEvent->read(null, $id);
		$meetupRSVPs = $this->MeetupEvent->MeetupRSVP->find('all', array('conditions' => array('event_id' => $id)));

		$this->set(compact('meetupEvent', 'meetupRSVPs'));
	}
	
}
