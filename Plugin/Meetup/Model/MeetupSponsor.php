<?php
/**
 * Meetup Sponsor
 *
 * @package Meetup
 * @package Meetup.Model
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupSponsor extends MeetupAppModel {

/**
 * Read
 *
 * @param Model $model Model object
 * @param array $queryData Query Data and options
 * @param mixed $recursive Recursion level
 * @return array Results
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function get() {
		$content = file_get_contents('http://www.meetup.com/SydPHP/sponsors/');

		preg_match_all('/\<li\s+id="[a-z0-9\-]+"\s+class="D_sponsorRow\s+clearfix\s*"\>.*\<\/li\>/U', str_replace("\n", '', $content), $matches);
		
		foreach ($matches as $string) {
			preg_match('/\<img +src="(P?<image>[^"]+)"/', $string[0], $imgMatches);
			var_dump($imgMatches);
		}
		
//		var_dump($matches);
		
//		var_dump($xml);
	}
}
