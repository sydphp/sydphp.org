<?php
App::uses('DataSource', 'Model/Datasource');
App::uses('HttpSocket', 'Network/Http');

class MeetupSource extends DataSource {

	public $description = 'Meetup Datasource';
	
	public $Http = null;
	
	protected $_defaultConfig = array(
		'sign' => true,
	);
	
	protected $_baseUri = 'api.meetup.com';
	
	protected $_uriMap = array(
		'events' => '/2/events',
	);
	
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
	
	public function read(Model $model, $queryData = array(), $recursive = null) {
		$table = preg_replace('/^meetup_/', '', $model->useTable);

		$options = $queryData['conditions'];

		$uri = $this->_buildUri($table, $options);
		$response = $this->Http->get($uri[0], $uri[1]);
		if ($response->code != 200) {
			$model->onError();
			return false;
		}

		$result = json_decode($response->body, true);
		if (!isset($result['results'])) {
			$model->onError();
			return false;
		}
		
		$results = $result['results'];

		// Structure as CakePHP model data with Alias in the array response
		foreach ($results as $key => $result) {
			$results[$key] = array($model->alias => $result);
		}

		return $results;
	}
	
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
