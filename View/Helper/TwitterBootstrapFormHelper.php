<?php
App::uses('FormHelper', 'View/Helper');

/**
 * Twitter Bootstrap Form Helper
 *
 * @package SydPHP
 * @subpackage SydPHP.View.Helper
 * @author Graham Weldon (http://grahamweldon.com)
 */
class TwitterBootstrapFormHelper extends FormHelper {

/**
 * Default options for Twitter Bootstrap inputs
 *
 * @var array
 */
	private $inputOptions = array(
		'label' => null,
		'error' => array(
			'wrap' => 'span',
			'class' => 'help-block',
		),
		'class' => 'xlarge',
		'div' => false,
	);

/**
 * Override default input with Twitter Bootstrap options
 *
 * @param string $fieldName Field name
 * @param array $options Option array
 * @return string
 * @author Graham Weldon (http://grahamweldon.com)
 */
	public function input($fieldName, $options = array()) {
		$options = array_merge($this->inputOptions, $options);
		$error = null;
		if ($options['error'] !== false) {
			$error = $this->error($fieldName, null, $options['error']);
		}
		$options['error'] = false;
		
		$result = parent::input($fieldName, array_merge($options, array('label' => false)));
		$result .= $error;
		
		$result = $this->Html->tag('div', $result, array('class' => 'input'));
		
		if ($options['label'] !== false) {
			$result = $this->label($fieldName) . $result;
		}
		
		$class = 'clearfix';
		if (!empty($error)) {
			$class .= ' error';
		}
		return $this->Html->tag('div', $result, array('class' => $class));
	}
	
}
