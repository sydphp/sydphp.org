<?php
/**
 * @note this is a Centrik library © 2010 James Ellis
 * @note CSS font family handler
 * @see http://www.fontspring.com/blog/the-new-bulletproof-font-face-syntax
 * @note the original example is <pre>
		@font-face {
		font-family: 'MyFontFamily';
		src: url('myfont-webfont.eot?') format('eot'), 
			url('myfont-webfont.woff') format('woff'), 
			url('myfont-webfont.ttf')  format('truetype'),
			url('myfont-webfont.svg#svgFontName') format('svg');
		}
	</pre>
 * @note FontSquirrel Example: <pre>
 		@font-face {
			font-family: 'KaratulaBold';
			src: url('KARAB___-webfont.eot');
			src: url('KARAB___-webfont.eot?iefix') format('eot'),
				url('KARAB___-webfont.woff') format('woff'),
				url('KARAB___-webfont.ttf') format('truetype'),
				url('KARAB___-webfont.svg#webfontfBx9vXVW') format('svg');
			font-weight: normal;
			font-style: normal;
		}

 */
class NCSS_FontFace extends NCSSHandler {
	public function __construct() {}
	
	public function Render() {
	
		if(empty($this->options['font-family']) ||  empty($this->options['font'])) {
			print "/* no font-fmaily and/or font path provided */\n";
		}
		
		if(empty($this->options['svgFontName'])) {
			$this->options['svgFontName'] = "webfont" . substr(sha1($this->options['font']), 0, 12);
		}
	
		print "@font-face {\n"
			. "\tfont-family: '" . $this->options['font-family'] . "';\n"
			. "\tsrc: url('{$this->options['font']}.eot?') format('eot'),\n"
			//. "\turl('{$this->options['font']}.woff') format('woff'),\n"
			. "\turl('{$this->options['font']}.ttf')  format('truetype'),\n"
			. "\turl('{$this->options['font']}.otf')  format('otf'),\n"
			. "\turl('{$this->options['font']}.svg#{$this->options['svgFontName']}') format('svg');\n"
			. "}\n\n";
	}
}
