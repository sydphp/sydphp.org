<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mysite/code/CodemSilverstripeExtensions/NCSS/NCSS.php');
$ncss = new ncss(TRUE, '/mysite/code/CodemSilverstripeExtensions/NCSS');

/**
 * E.g: Fonts Family
$ncss->Reset()
	->FontFace(array('font-family' => 'FreeSans', 'font' => '/themes/codem/fonts/FreeSans/FreeSans'))
	->FontFace(array('font-family' => 'FreeSansBold', 'font' => '/themes/codem/fonts/FreeSansBold/FreeSansBold'))
	->FontFace(array('font-family' => 'DejaVuSansCondensed', 'font' => '/themes/codem/fonts/DejaVuSansCondensed/DejaVuSansCondensed'))
	->FontFace(array('font-family' => 'DejaVuSansCondensed-Bold', 'font' => '/themes/codem/fonts/DejaVuSansCondensed-Bold/DejaVuSansCondensed-Bold'))
	;
*/
?>
body {
	font-size : 62.5%;
	color : #333;
	padding : 0px 0px 10px 0px;
	margin : 0;
}

#wrapper {
	font-size : 1.2em;
}

body, input, textarea, select {
	font-family : "DejaVuSansCondensed", Arial, "Liberation Sans", "Bitstream Vera Sans", Helvetica, Verdana, sans-serif;
}

pre {
	border : 1px solid #ccc;
	background-color : #FFFEEB;
	font-family : "DejaVu Sans Mono", "Bitstream Vera Sans Mono", FreeMono, "Courier New", Courier, monospace;
	overflow : auto;
	margin : 0 auto;
	padding : 0.94em;
	font-size : 1.1em;
}
pre br {
	display : none;
}

blockquote {
	font-family : "DejaVu Serif", "Bitstream Vera Serif", Georgia, serif;
	padding : 0.8em;
	border : 1px dotted #aaa;
	background-color : #f5f5f5;
}

h1, h2, h3, h4, h5, h6, dt {
	font-family : FreeSansBold, Tahoma, Arial, sans-serif;
	margin : 0;
	padding : 0;
	letter-spacing : -0.01em;
	color : #4A483C;
	text-rendering : optimizelegibility;
}

h1 {
	font-size : 3.8em;
	font-weight : bold;
	padding : 0px;
	margin : 0;
	color : #000;
	text-transform : lowercase;
	line-height : 70%;
	text-align : right;
}

h1 a {
	text-decoration : none;
	border-bottom : none;
}

h4 span.co,
h1 span.co {
	color : #000;
}

h4 span.dem,
h1 span.dem {
	color : #605D4D;
}

h1 b {
	font-weight : bold;
	color : #000;
}

h2 {
	font-size : 2.4em;
	font-weight : bold;
	letter-spacing : -0.08em;
}

h2 a, h3 a, h5 a, h4 a, h1 a {
	text-decoration : none;
	color : inherit;
}

h3 {
	font-size : 2.1em;
	letter-spacing : -0.04em;
	font-weight : bold;
	margin : 0.9em 0 0.3em 0em;
	padding : 0em;
	color : #777;
}

h4 {
	font-size : 1.9em;
	font-weight : bold;
	color : #333;
}

#footer h4 {
	color : #000;
}