<?php
App::uses('DataSource', 'Model/Datasource');
App::uses('HttpSocket', 'Network/Http');

/**
 * Meetup DataSource
 *
 * @package Meetup
 * @subpackage Meetup.Controller
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupSource extends DataSource {

/**
 * Description
 *
 * @var string
 */
	public $description = 'Meetup Datasource';

/**
 * Http Connection
 *
 * @var HttpSocket
 */
	public $Http = null;

/**
 * Default Configuration
 *
 * @var array
 */
	protected $_defaultConfig = array(
		'sign' => true,
	);

/**
 * Base URI
 *
 * @var string
 */
	protected $_baseUri = 'api.meetup.com';

/**
 * URI Mapping
 *
 * @var array
 */
	protected $_uriMap = array(
		'events' => '/2/events',
		'members' => '/2/members',
		'rsvps' => '/2/rsvps',
	);

/**
 * Constructor
 *
 * @param array $config Configuration
 * @param HttpSocket $http Connection object
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function __construct($config, $http = null) {
		$config = array_merge($config, $this->_defaultConfig);
		parent::__construct($config);
		if (!$http) {
			$http = new HttpSocket(array(
				'timeout' => 5,
				'request' => array(
					'uri' => array(
						'scheme' => 'https',
						'host' => $this->_baseUri,
						'port' => 443,
					)
				)
			));
		}
		$this->Http = $http;
	}

/**
 * List Sources (Tables)
 *
 * @param mixed $data 
 * @return array Tables
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function listSources($data = null) {
		return array(
			'meetup_checkins',
			'meetup_cities',
			'meetup_events',
			'meetup_feeds',
			'meetup_groups',
			'meetup_members',
			'meetup_photos',
			'meetup_rsvps',
			'meetup_topics',
			'meetup_venues',
		);
	}

/**
 * Read
 *
 * @param Model $model Model object
 * @param array $queryData Query Data and options
 * @param mixed $recursive Recursion level
 * @return array Results
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function read(Model $model, $queryData = array(), $recursive = null) {
		$table = preg_replace('/^meetup_/', '', $model->useTable);

		$options = $this->_buildOptions($queryData['conditions'], $model);

		$uri = $this->_buildUri($table, $options);
		$response = $this->Http->get($uri[0], $uri[1]);
		if ($response->code != 200) {
			$model->onError();
			return false;
		}

		$result = json_decode(utf8_encode($response->body), true);
		if (!isset($result['results'])) {
			$model->onError();
			return false;
		}
		
		// $_associations = $model->associations();
		// if ($model->recursive == -1) {
		// 	$_associations = array();
		// } elseif ($model->recursive == 0) {
		// 	unset($_associations[2], $_associations[3]);
		// }

		$results = $result['results'];
		foreach ($results as $key => $result) {
			$results[$key] = array($model->alias => $result);

		// 	foreach ($_associations as $type) {
		// 		foreach ($model->{$type} as $assoc => $assocData) {
		// 			$linkModel = $model->{$assoc};
		// 			debug($assocData);
		// 			$linkModel->getDataSource();
		// 			$assocResult = $linkModel->find('all', $queryData);
		// 			debug($assocResult);
		// 		}
		// 	}
		}

		return $results;
	}

/**
 * Build Options
 *
 * @param array $options 
 * @param Model $model 
 * @return array Options
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _buildOptions($options, $model) {
		foreach ($options as $key => $value) {
			unset($options[$key]);
			$key = preg_replace('/^' . $model->alias . '\./', '', $key);
			$options[$key] = $value;
		}
		return $options;
	}

/**
 * Build URI
 *
 * @param string $table Table name
 * @param array $options Options
 * @return array URI for HttpSocket
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _buildUri($table, $options) {
		$path = $this->_uriMap[$table];
		if (empty($path)) {
			throw new CakeException(__d('meetup', 'Unable to map model to URI path in Meetup API'));
		}
		
		$uri = array(
			$this->_uriMap[$table],
			array(
				'key' => $this->config['key'],
				'sign' => $this->config['sign'] ? 'true' : 'false',
			)
		);
		
		foreach ($options as $key => $value) {
			$uri[1][$key] = $value;
		}
		
		return $uri;
	}
	
}
