<?php
class Codem_Logging {
	
	protected static $opened = FALSE;
	
	public static function Open() {
		openlog("silverstripe", LOG_NDELAY, LOG_LOCAL5);
		self::$opened = TRUE;
	}
	
	public function Add($line, $level = LOG_DEBUG) {
		if(defined('CODEM_ENABLE_SYSLOG') && CODEM_ENABLE_SYSLOG) {
			if(!self::$opened) {
				self::Open();
			}
			syslog($level, $line);
		}
	}
}
?>