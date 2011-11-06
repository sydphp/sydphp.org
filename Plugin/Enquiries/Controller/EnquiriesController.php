<?php
App::uses('EnquiriesAppController', 'Enquiries.Controller');

/**
 * Enquiries Controller
 *
 * @package Enquiries
 * @subpackage Enquiries.Controller
 * @author Graham Weldon (http://grahamweldon.com)
 */
class EnquiriesController extends EnquiriesAppController {

/**
 * Configurable Options
 *
 * To override these defaults, create a config file in app/Config/Enquiries.php
 *
 * @var array
 */
	private $options = array(
		'successRedirect' => array(
			'plugin' => 'enquiries',
			'controller' => 'enquiries',
			'action' => 'thankyou',
		)
	);

/**
 * Before Filter callback
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function beforeFilter() {
		Configure::load('Enquiries');
		$this->options = array_merge($this->options, Configure::read('Enquiries'));
	}

/**
 * Add an enquiry
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Enquiry->create($this->data);
			if ($this->Enquiry->save()) {
				$this->Session->setFlash(__('Your enquiry has been sent.'));
				return $this->redirect($this->options['successRedirect']);
			} else {
				$this->Session->setFlash(__('Failed to send your enquiry'));
			}
		}
	}

/**
 * Thankyou page
 *
 * Simple static page display
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function thankyou() {
	}

}
