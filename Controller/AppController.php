<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('TwitterBootstrapFormHelper', 'View/Helper');
App::uses('MeetupEvent', 'Meetup.Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 */
class AppController extends Controller {

/**
 * Layout
 *
 * @var string
 */
	public $layout = 'container';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array(
		'Form' => array(
			'className' => 'TwitterBootstrapForm',
		),
		'Html',
		'Text',
		'Time',
		'Session' => array(
			'className' => 'TwitterBootstrapSession',
		),
	);

/**
 * undocumented variable
 *
 * @var array
 */
	public $components = array(
		'RequestHandler',
		'Session',
	);

/**
 * BeforeFilter callback
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function beforeFilter() {
		$this->_nextEvent();
	}

/**
 * Get the next SydPHP event.
 *
 * @return void
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _nextEvent() {
		$MeetupEvent = new MeetupEvent();
		$nextEvent = $MeetupEvent->next('SydPHP');
		$this->set(compact('nextEvent'));
	}
}
