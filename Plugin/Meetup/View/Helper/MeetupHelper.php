<?php
App::uses('HtmlHelper', 'View/Helper');

class MeetupHelper extends HtmlHelper {
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
}
