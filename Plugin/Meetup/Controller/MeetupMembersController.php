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
		$meetupMembers = $this->MeetupMember->find('all', array(
			'conditions' => array(
				'group_urlname' => 'SydPHP',
				'order' => 'visited',
				'desc' => 'true'),
		));
		$title_for_layout = 'Members';
		$this->set(compact('meetupMembers', 'title_for_layout'));
	}

	public function view($id = null) {
		if (!$id || !($member = $this->getSingleMemberById($id))) {
			throw new NotFoundException('Could not find the member with id ' . $id);
		}
		print_r($member);
		$title_for_layout = 'Member: ' . $member['MeetupMember']['name'];
		$this->set(compact('member', 'title_for_layout'));
	}
	
	private function getSingleMemberById($id)
	{
		$member=$this->MeetupMember->find('first', array(
			'conditions' => array(
				'group_urlname' => 'SydPHP',
				'member_id' => $id,
				'page' => 1),
		));
		return ($member)?$member:null;
	}


}
