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
	
}
