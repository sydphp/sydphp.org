<?php
/**
 * @note CSS BoxShadow handler
 */
class NCSS_BoxShadow extends NCSSHandler {
	protected $needs_pie = TRUE;
	
	public function __construct() {
		$this->options = array(
			'shadows' => array(
				//can have up to four
				array(
					'inset' => '',
					'color' => 'rgba(204,204,204,204,0.3)',//#ccc at 30% opacity
					'x' => '2px',
					'y' => '4px',
					'blur' => '4px',
					'spread' => '2px',
				),
			),
		);
	}
	
	public function Render() {
		$css = "";
		
		$types = array();
		foreach($this->options['shadows'] as $k=>$shadow) {
		
			if(empty($shadow)) {
				$declaration = "none";
			} else {
				if(array_key_exists('all', $shadow)) {
					$shadow['x'] = $shadow['y'] = $shadow['all'];
				}
				if(!isset($shadow['inset'])) {
					$shadow['inset'] = '';
				}
				$declaration = "{$shadow['inset']} {$shadow['x']} {$shadow['y']} {$shadow['blur']} {$shadow['spread']} {$shadow['color']}";
			};
			$types["-khtml-box-shadow"][] = $declaration;
			$types["-webkit-box-shadow "][] = $declaration;
			$types["-moz-box-shadow"][] = $declaration;
			//CSS3 rule goes last
			$types["box-shadow"][] = $declaration;
		}
		reset($types);
		foreach($types as $rule=>$values) {
			switch($rule) {
				case 'box-shadow':
				case '-moz-box-shadow':
				case '-khtml-box-shadow':
				case '-webkit-shadow':
				default:
					$css .= "\t" . $rule . " : " . implode(",", $values) . ";\n";
					break;
			}
		}
		print $css;
	}
}