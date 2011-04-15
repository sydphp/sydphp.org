<?php

//copy this file to db.php and Bob's your uncle

global $databaseConfig;
switch($_SERVER['SERVER_NAME']) {
	case 'a.development.domain':
		ini_set('display_errors', TRUE);
		$databaseConfig = array(
			"type" => 'Codem_MySQLDatabase',
			"server" => 'localhost',
			"username" => '',
			"password" => '',
			"database" => '',
			"path" => '',
		);
		Director::set_environment_type('dev');
		break;
	case 'www.a.live.domain':
	case 'a.live.domain':
	default:
		//staging on the internets
		$databaseConfig = array(
			"type" => 'Codem_MySQLDatabase',
			"server" => 'localhost',
			"username" => '',
			"password" => '',
			"database" => '',
			"path" => '',
		);
		Director::set_environment_type("live");
		break;
}
MySQLDatabase::set_connection_charset('utf8');
?>