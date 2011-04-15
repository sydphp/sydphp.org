<?php
/**
 * @note provides a simple mini framework for Speech Bubble CSS shortcuts
 * @note calling example print $css->Load({options})->Render();
 * @note this is based on work at http://nicolasgallagher.com/demo/pure-css-speech-bubbles/bubbles.html
 */
class NCSS_SpeechBubble extends NCSSHandler {
	public function __construct() {
		$this->options = array(
			'type' => 'tri-bottom-right',
			'background-color' => '#ccc',//'border' colour
			
			//provide a border
			'border' => FALSE,//default no border
			
			//triangle defaults
			'defaults' => array(
				'tri-bottom-right' => array(
					'position' => 'relative',
					'left' => '50px',
					'bottom' => '-40px',
					'border-width' => '20px 0 20px 20px',
					'border-style' => 'solid',
					'border-color' => '#ccc transparent transparent',
				),
				'tri-side-left' => array(
					'position' => 'relative',
					'margin-left' => '50px',
					'left' => '-50px',
					'top' => '40px',
					'border-width' => '10px 50px 10px 0px',
					'border-style' => 'solid',
					'border-color' => 'transparent #ccc',//actually the background color of the arrow
					//arrow border -- 1px by default
					'arrow-border-left' => '-51px',
					'arrow-border-top' => '39px',
					'arrow-border-width' => '11px 51px 11px 0px',
					'arrow-border-style' => 'solid',
					'arrow-border-color' => 'transparent #000',
				),
				'tri-side-right' => array(
					'position' => 'relative',
					'margin-right' => '50px',
					'right' => '-85px',
					'top' => '40px',
					'bottom' => 'auto',
					'border-width' => '10px 50px 10px 40px',
					'border-style' => 'solid',
					'border-color' => 'transparent transparent transparent #ccc',
				),
			)
		);
	}
	
	protected function GetValue($rule) {
		if(isset($this->options[$rule])) {
			//passed a rule in
			return $this->options[$rule];
		} else if(isset($this->options['defaults'][$this->options['type']][$rule])) {
			return  $this->options['defaults'][$this->options['type']][$rule];
		} else {
			return 'none';//NADA / generic style
		}
	}
	
	public function Render() {
		$content = "\\00a0";//a literal \
		switch($this->options['type']) {
			case 'tri-bottom-right':
				$css =
<<<CSS
	{$this->options['selector']} {
		position:{$this->GetValue('position')};
	}

	{$this->options['selector']}:after {
		content:"{$content}";
		display:block;
		position:absolute;
		bottom:{$this->GetValue('bottom')};
		left:{$this->GetValue('left')};
		width:0;
		height:0;
		border-width:{$this->GetValue('border-width')};
		border-style:{$this->GetValue('border-style')};
		border-color: {$this->GetValue('border-color')};
	}
CSS;
				break;
			case 'tri-side-left':
				$css =
<<<CSS
	{$this->options['selector']} {
		position:{$this->GetValue('position')};
		margin-left : {$this->GetValue('margin-left')};
	}

	{$this->options['selector']}:after {
		content:"{$content}";
		display:block;
		position:absolute;
		width:0;
		height:0;
		top: {$this->GetValue('top')}; /* controls vertical position */
		left:{$this->GetValue('left')}; /* value = - border-left-width - border-right-width */
		bottom:auto;
		border-width:{$this->GetValue('border-width')};
		border-style:{$this->GetValue('border-style')};
		border-color:{$this->GetValue('border-color')};
	}
CSS;

				if($this->options['border']) {
					//border specified
					$css .=
<<<CSS
					{$this->options['selector']}:before {
						content:"{$content}";
						display:block;
						position:absolute;
						width:0;
						height:0;
						top: {$this->GetValue('arrow-border-top')};
						left:{$this->GetValue('arrow-border-left')};
						bottom:auto;
						border-width:{$this->GetValue('arrow-border-width')};
						border-style:{$this->GetValue('arrow-border-style')};
						border-color:{$this->GetValue('arrow-border-color')};
					}
CSS;
				}//end border handling
				
				break;
			case 'tri-side-right':
				$css =
<<<CSS
	{$this->options['selector']} {
		position:{$this->GetValue('position')};
		margin-right : {$this->GetValue('margin-right')};
	}

	{$this->options['selector']}:after {
		content:"{$content}";
		display:block;
		position:absolute;
		width:0;
		height:0;
		top:{$this->GetValue('top')};
		right:{$this->GetValue('right')};
		bottom:auto;
		border-width:{$this->GetValue('border-width')};
		border-style:{$this->GetValue('border-style')};
		border-color:{$this->GetValue('border-color')};
	}
CSS;
				break;
			default:
				$css = "";
				break;
		}
		print $css;
	}
}
