<?php
App::uses('EnquiriesAppModel', 'Enquiries.Model');
App::uses('CakeEmail', 'Network/Email');

/**
 * Enquiry Model
 *
 * @package Enquiries
 * @subpackage Enquiries.Model
 * @author Graham Weldon (http://grahamweldon.com)
 */
class Enquiry extends EnquiriesAppModel {

/**
 * Table to use
 *
 * @var mixed
 */
	public $useTable = false;

/**
 * Model schema
 *
 * @var array
 */
	protected $_schema = array(
		'name' => array('type' => 'string', 'length' => 110, 'null' => false),
		'email' => array('type' => 'string', 'length' => 255, 'null' => false),
		'subject' => array('type' => 'string', 'length' => 110, 'null' => false),
		'message' => array('type' => 'text', 'null' => false),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array('rule' => 'notEmpty'),
		'email' => array('rule' => 'email', 'message' => 'A valid email address is required'),
		'subject' => array('rule' => 'notEmpty'),
		'message' => array('rule' => 'notEmpty'),
	);

/**
 * Save
 *
 * Overridden to stub out saving.
 *
 * @param mixed $data Data
 * @param boolean $validate Validate the data
 * @param array $fieldList Field List
 * @return boolean Success
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function save($data = null, $validate = true, $fieldList = array()) {
		return $this->_sendEmail($data ?: $this->data);
	}

/**
 * Send Email
 *
 * @param array $data Data
 * @return boolean Success
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _sendEmail($data) {
		Configure::load('Enquiries');
		$email = new CakeEmail();
		return $email
			->from(array($data[$this->alias]['email'] => $data[$this->alias]['name']))
			->to(Configure::read('Enquiries.toEmail'))
			->subject('Website Enquiry: ' . $data[$this->alias]['subject'])
			->send($this->_constructMessage($data));
	}

/**
 * Construct the message text
 *
 * @param array $data Input data
 * @return string Message
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _constructMessage($data) {
		$data = $data[$this->alias];
		
		$ip = env('REMOTE_ADDR');
		
		return <<<ENDOFMESSAGE

From: {$data['name']} <{$data['email']}>
Subject: {$data['subject']}
IP Address: {$ip}
Message:

{$data['message']}

ENDOFMESSAGE;
	}
}
