<?php
App::uses('HtmlHelper', 'View/Helper');

/**
 * Meetup Helper
 *
 * @package Meetup
 * @subpackage Meetup.View.Helper
 * @author Graham Weldon (http://grahamweldon.com)
 */
class MeetupHelper extends HtmlHelper {

/**
 * Generate venue HTML output
 *
 * @param array $venue Venue details
 * @return string HTML String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function venue($venue) {
		$text = '';
		if (!empty($venue)) {
			$address = '';
			if (isset($venue['address_1'])) {
				$address .= $this->tag('div', $venue['address_1'], array('class' => 'extended-address'));
			}
			if (isset($venue['address_2'])) {
				$address .= $this->tag('div', $venue['address_2'], array('class' => 'street-address'));
			}
			// if (isset($venue['address_3'])) {
			// 	$address .= $this->tag('div', $venue['address_3']);
			// }
			if (isset($venue['city'])) {
				$address .= $this->tag('div', $venue['city'], array('class' => 'locality'));
			}
			// if (isset($venue['state'])) {
			// 	$address .= $this->tag('div', $venue['state']. array('class' => 'region'));
			// }
			// TODO: Convert country code supplied 'au' to country name 'Australia'.
			// if (isset($venue['country'])) {
			// 	$address .= $this->tag('div', $venue['country']. array('class' => 'country-name'));
			// }
			$text .= $this->tag('div', $address, array('class' => 'adr'));
		}
		return $text;
	}

/**
 * Generate map for Venue
 *
 * @param array $venue Venue detauls
 * @param array $options Options
 * @return string HTML String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function map($venue, $options = array()) {
		$options = array_merge($options, array(
			'width' => 560,
			'height' => 256,
			'zoom' => 17,
			'maptype' => 'roadmap',
			'sensor' => 'false',
		));
		
		$options['size'] = sprintf('%sx%s', $options['width'], $options['height']);
		unset($options['width']);
		unset($options['height']);
		
		$options['center'] = urlencode(sprintf('%s %s', $venue['address_2'], $venue['city']));
		
		return $this->image('http://maps.googleapis.com/maps/api/staticmap?' . http_build_query($options));
	}

/**
 * Generate thumb profile image tag for output
 *
 * @param array $member Member information
 * @return string Html String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function thumb($member) {
		if (array_key_exists('photo', $member) && array_key_exists('thumb_link', $member['photo'])) {
			return $this->image($member['photo']['thumb_link'], array('alt' => $member['name']));
		}
		return $this->image('member_thumb_placeholder.jpeg', array('alt' => $member['name']));
	}

/**
 * Generate photo profile image tag for output
 *
 * @param array $member Member information
 * @return string Html String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function photo($member) {
		if (array_key_exists('photo', $member) && array_key_exists('thumb_link', $member['photo'])) {
			return $this->image($member['photo']['photo_link'], array('alt' => $member['name']));
		}
		return $this->image('member_thumb_placeholder.jpeg', array('alt' => $member['name']));
	}

}
