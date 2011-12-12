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

	protected $_socialTypes = array(
		'twitter' => 'Twitter',
		'linkedin' => 'LinkedIn',
	);
	
	protected $_socialUris = array(
		'facebook' => 'http://facebook.com/people/@/%s',
	);

/**
 * Generate venue HTML output
 *
 * @param array $meetup Meetup array
 * @return string HTML String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function venue($meetup) {
		if (!isset($meetup['venue'])) {
			return 'To be announced';
		}
		$venue = $meetup['venue'];

		$text = '';
		if (!empty($venue)) {
			$address = '';

			if (isset($venue['name']) && !empty($venue['name'])) {
				$address .= $this->tag('strong', $venue['name']);
			}
			
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
 * @param array $meetup Meetup array
 * @param array $options Options
 * @return string HTML String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function map($meetup, $options = array()) {
		if (!isset($meetup['venue'])) {
			return 'To be announced';
		}
		$venue = $meetup['venue'];

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
		
		$address = $this->_getMapAddress($venue);
		$options['center'] = urlencode(sprintf('%s %s', $address, $venue['city']));
		
		// @TODO: Place a map marker on the correct location.
		
		return $this->image('http://maps.googleapis.com/maps/api/staticmap?' . http_build_query($options));
	}

/**
 * Get a string for use with Google Maps images.
 *
 * @param array $venue Venue data
 * @return string Address
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _getMapAddress($venue) {
		$address = '';
		if (isset($venue['address_1'])) {
			$address .= $venue['address_1'];
		}
		if (isset($venue['address_2'])) {
			$address .= $venue['address_2'];
		}
		
		return $address;
	}

/**
 * Generate thumb profile image tag for output
 *
 * @param array $member Member information
 * @return string Html String
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function thumb($member, $name = null, $options = array()) {
		$photo = null;
		if (array_key_exists('photo', $member)) {
			$photo = $member['photo'];
		} elseif (array_key_exists('member_photo', $member)) {
			$photo = $member['member_photo'];
		}

		if ($photo == null || !array_key_exists('thumb_link', $photo)) {
			return $this->image('member_thumb_placeholder.gif', array('alt' => $name));
		}

		return $this->image($photo['thumb_link'], array_merge($options, array('alt' => $name)));
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
		return $this->image('member_thumb_placeholder.gif', array('alt' => $member['name']));
	}

/**
 * Generate social links for a member
 *
 * @param array $member Member data
 * @return string
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function memberSocial($member) {
		if (!isset($member['other_services']) || !count($member['other_services'])) {
			return '';
		}
		
		$socials = array();
		foreach ($member['other_services'] as $type => $data) {
			$title = isset($this->_socialTypes[$type]) ? $this->_socialTypes[$type] : ucwords($type);
			$uri = $this->_getSocialUri($type, $data);
			$link = $this->link($title, $uri, array('class' => $type, 'target' => '_blank'));
			$socials[] = $this->tag('li', $link);
		}
		
		return $this->tag('ul', implode('', $socials), array('class' => 'social-links'));
	}

/**
 * Get a URI for the social type supplied.
 *
 * @param string $type Social Type
 * @param array $data User Data
 * @return string URI for social link
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _getSocialUri($type, $data) {
		$method = '_link' . ucwords($type);
		if (method_exists($this, $method)) {
			return $this->$method($data);
		}
		if (isset($this->_socialUris[$type])) {
			return sprintf($this->_socialUris[$type], $data['identifier']);
		}
		
		return $data['identifier'];
	}

/**
 * Generate link for Twitter
 *
 * @param array $data User Data
 * @return string URI
 * @author Graham Weldon (http://grahamweldon.com)
 */
	protected function _linkTwitter($data) {
		return 'http://twitter.com/' . substr($data['identifier'], 1);
	}

	public function profileLink($title, $member, $options) {
		return $this->link($title, 'http://meetup.com/members/' . $member['id'], array_merge(array('target' => '_blank'), $options));
	}

}
