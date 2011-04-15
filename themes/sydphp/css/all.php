<?php
//NotCSS handler (CSS3 doover)
require($_SERVER['DOCUMENT_ROOT'] . '/mysite/code/NCSS/NCSS.php');
$ncss = new ncss(TRUE, '/mysite/code/NCSS');
?>

/* ============================================================================	
	global
*/
body {
	margin : 0;
	font-size  : 62.5%;
	color : #333;
	padding : 0em;
	background-color : #888;
	<?php $ncss->Reset()->Gradient(array('from' => '#888', 'to'=>'#333',  'default' => '#888'));?>
}

table {
	border : none;
	border-collapse : collapse;
	background-color : #fff;
}

table thead {
	color : #fff;
	background-color : #333;
}

table th,
table td {
	padding : 0.4em;
}

table td {
	color : #333;
	background-color : #eee;
}

textarea {
	display : block;
	width : 100%;
	height : 14.9em;
	margin : 0 auto;
}

body, input, select, textarea {
	font-family : "DejaVu Sans Condensed", Helvetica, Tahoma, Verdana, Arial, sans-serif;
}

input, select, textarea {
	font-size : 100%;
}

p {
	margin : 0;
	padding : 0em 0em 0.3em 0em;
	line-height : 135%;
}

pre {
	font-size : 1.3em;
	color : #000;
	background-color : #F9F3CA;
	padding : 0.3em;
	overflow : auto;
	font-family : "DejaVu Mono", "Courier New", monospace;
}

dl {
	padding : 5px;
	margin : 0;
}

ul {
	padding : 0 0 8px 2em;
	margin : 0;
}

dt {
	font-size : 1.1em;
	padding : 2px 2px 3px 9px;
	margin  : 0;
	font-weight : bold;
}

dd {
	margin : 0;
	padding : 5px 5px 5px 15px;
}

.ad {
	display : block;
	margin : 0.88em auto;
}

#sidebar-wrap .ad-narrow {
	border : 1px solid #444;
	background-color : #eee;
}

ins {
}

iframe {
	border : none;
}


/* ============================================================================
	hyperlinks
*/
a {
	/*color : #46607D;*/
	color : #444;
	outline : none;
	text-decoration : underline;
}
a img, li a img {
	border : none;
}
a:focus {
	outline : none;
}
.app_posts_related a.btn,
a.btn {
	border : none;
}
a.feature {
	background-color : #333;
	padding : 2px 8px;
}

#app_header h1 {
	position : relative;
	color : #fff;
}

#app_header h1 sup {
	position : absolute;
	right : 20px;
	top : -10px;
	font-size : 0.75em;
	color : #fff;
}

#app_header h1 a, h1 a {
	text-decoration : none;
	border : none;
	color : #fff;
}

#app_skip a {
	color : #1c211b;
}

/* ============================================================================
	sydphp group wrapper styles
*/
#app_wrap {
	padding : 0px;
	font-size : 1.2em;
	padding-top : 2em;
}

#app_header {
	padding : 1em 0.3em;
}

#app_sidebar {
	background-color : #000;
	<?php
		$ncss->Reset()
		->Radius(array('tr' => '11px', 'br'=>'11px'))
		->BoxShadow(array(
				'shadows' => array(
						array(
							'x' => '3px', 'y' => '3px',
							'blur' => '2px','spread' => '0px',
							'color' => 'rgba(68,68,68,0.7)'
						)
					)
				)
		);
	?>
	float : left;
	width : 33%;
	margin : 0;
	color : #fff;
	padding : 10px 0px;
	border : 1px solid #000;
}

#app_sidebar .ad-narrow {
	width : 200px;
	border : 1px solid #777;
	background-color : #000;
}

#app_sidebar_inner {
	padding : 0 0 0 1em;
}

#app_sidebar ul {
	list-style-type : none;
	padding : 0.6em;
	margin : 0.2em 0em;
}

#app_sidebar a, #app_sidebar li {
	color  : #fff;
}

#app_sidebar a img {
	border : none;
	vertical-align : middle;
}

#app_sidebar p.text, #app_sidebar form {
	color : #fff;
	padding : 0.3em;
	font-size : 1em;
}

#app_sidebar form fieldset {
	padding :0em;
	border : none;
}


#app_sidebar form label {
	display : inline;
}

#app_sidebar form.subscribe input.email {
	width : 8em;
}

#app_sidebar h3, #app_sidebar h4 {
	padding : 1em 0em 0em 0em;
	margin : 0;
	color : #fff;
	font-size : 1.5em;
}

#app_sidebar h4 {
	padding : 0em;
	font-size : 1.3em;
}

#app_skip {
	position : absolute;
	left : 0px;
	top : -150px;
	padding : 0px;
}

#app_footer {
	text-align  : right;
	font-size : 1em;
	background-color : #000;
	padding : 1.8em 1em;
	color : #fff;
}

#app_footer a {
	color : #fff;
}

#app_msg,
.app_posts_related {
	float : right;
	width : 62%;
	font-size : 1.3em;
}

#app_msg {
	color : #fff;
	margin : 0 1em 0 0;
	background-color : #777;
	text-shadow : 0 2px 1px rgba(0, 0, 0, 0.698), 0 0 2px #000;
	border : 1px solid #999;
	<?php $ncss->Reset()->Radius(array('all' => '11px'));?>
}

#app_msg .feed {
	float : right;
	margin : 9px;
	text-decoration : none;
	border : none;
}

#app_msg p,
#app_msg h4 {
	padding : 8px;
	color : #fff;
}

#app_msg a {
	color : #fff;
	text-decoration : none;
	border-bottom : 1px solid #fff;
}

#app_msg li a,
#app_msg li img {
	vertical-align : middle;
}

#app_content {
	padding : 0;
	margin : 4em 0 0 0;
}

#app_content #contain {
	margin : 0 0 4em 0;
}

#app_content .entrytext {
	line-height : 1.65em;
	padding-bottom : 1.1em;
}


.app_posts_related form,
#app_content .event {
	padding : 0.9em;
	background-color : #525276;
	<?php
	$ncss->Reset()->Radius(array('all' => '4px'));
	?>
}

#app_content .event {
	margin-bottom : 1.2em;
}

.app_posts_related form,
.app_posts_related fieldset {
	display : block;
}

.app_posts_related fieldset {
	width : 100%;
	padding : 0em;
	margin : 0 auto 1em 0;
}

textarea,
input.action,
input.text {
	font-size : 1em;
	padding : 3px;
	border : 1px solid #333;
	<?php
	$ncss->Reset()->Radius(array('all' => '5px'))
		->Gradient(array('from' => '#ddd', 'to'=>'#fff',  'default' => '#ddd'));
	?>
}

input.action {
	padding :  6px 12px;
	border : none;
	<?php
	$ncss->Reset()->Gradient(array('to' => '#ccc', 'from'=>'#fff',  'default' => '#ddd'));
	?>
}

div.Actions {
	text-align : center;
}

.app_other,
.app_post {
	background-color : #999;
	padding : 1em;
}

.app_post {
	background-color : #fff;
	border-bottom : 1px solid #666;
}

.app_other h2,
.app_other h3 {
	text-shadow : 1px 1px #bbb;
}

.app_other .item {
	float : left;
	width : 20%;
	padding : 8px;
}

#sidebar h3 {
	font-size : 1.1em;
	font-weight : bold;
	letter-spacing : -0.03em;
	margin : 0em;
	padding : 3px;
}

#sidebar li {
	line-height : 1.55em;
}

#sidebar li a {
	color : inherit;
}

#photos a {
	display : block;
	float : left;
	margin : 0 1em 1em 0;
}

#photos img {
	display : block;
}

.post {
	padding : 0 0 1.4em 0em;
	margin : 0;
	font-size : 1.1em;
}

.post .notice {
	color : #666;
	padding : 0.8em 0em 0.2em 0em;
	margin-left : 1em;
	border-bottom : 1px dotted #ccc;
	width : 56%;
}

.post .notice a {
}

.post .notice p {
	margin : 0;
	padding :0px;
}

.post .post_inner {
	padding : 0em;
}

.post .entry {
	line-height : 160%;
	font-size : 1.3em;
}

.post .postmetadata {
	margin-top : 1em;
	background-color : #eee;
	padding : 1em;
	color : #666;
	border : 1px solid #666;
}

#footer {
	clear : both;
}

/* ============================================================================
	headings
*/

h1, h2, h3, h4, h5, h6 {
	font-family : "DejaVu Sans Condensed", Helvetica, Tahoma, Arial, Verdana, sans-serif;
	letter-spacing : -0.02em;
	font-weight : bold;
}

.navigation {
	padding : 2em;
}
.navigation,
.navigation a {
	color : #fff;
}

.navigation .nav-next {
	float : right;
}
.navigation .nav-previous {
	float : left;
}

h2 {
	padding : 0em;
	font-size : 1.6em;
	font-weight : bold;
	letter-spacing : -0.07em;
	color : #333;
	margin : 0em;
	text-shadow : 1px 1px #fff;
	text-transform : uppercase;
}

.app_posts h2 {
	padding : 8px 10px;
	text-shadow : 1px 1px #fff;
	background-color : #aaa;
	margin : 0;
	border-bottom : 1px solid #aaa;
	
	<?php $ncss->Reset()
		->Radius(array('tl' => '11px', 'tr' => '11px'))
		->Gradient(array('from' => '#fff', 'to'=>'#ddd',  'default' => '#ddd'));
	?>
}

.app_posts p {
	color : #000;
	font-size : 1.2em;
	line-height : 140%;
}

.app_posts_related .breadcrumbs,
.app_posts .breadcrumbs {
	font-size : 90%;
	color : #888;
	padding : 0.7em 0 0.7em 0;
}

.app_posts_related .breadcrumbs {
	color : #fff;
}

h2 span {
	font-size : 75%;
	font-weight : normal;
	color : #999;
	letter-spacing : -0.02em;
}

h2 a {
	color : #333;
	text-decoration : none;
}

#app_header h1 {
	font-weight : bold;
	font-size : 2.5em;
	color : #1b2155;
	margin : 0;
	padding : 0px;
	letter-spacing : -0.2px;
}

h4, h5 {
	padding : 0.6em 0;
	margin : 0;
	font-size : 1.1em;
	color : #222;
}

h5 {
	font-size : 1.3em;
}

/* ============================================================================
	list content
*/
#app_skip ul {
	margin : 0;
	padding : 0px;
}

#app_skip li {
	list-style-type : none;
	margin : 0;
	padding : 2px;
	text-align : left;
	color : #fff;
}

#app_skip li {
	text-align : right;
}

#app_skip li.end {
	float : none;
}

ul.foot li {
	list-style-type : none;
	float : left;
	padding  : 5px 10px 5px 1px;
}

/* ============================================================================
	dedicated clearerers
*/
hr.break, div.break  {
	clear : both;
}

hr.break, div.break {
	visibility : hidden;
	height : 0em;
	line-height : 0;
	margin : 0;
	padding : 0px;
	font-size : 0;
}

.app_posts,
.app_posts_related {
	<?php
		$ncss->Reset()
		->Radius(array('all' => '12px'))
		->BoxShadow(array(
				'shadows' => array(
						array(
							'x' => '4px', 'y' => '4px',
							'blur' => '4px','spread' => '0px',
							'color' => 'rgba(48,48,48,0.7)'
						)
					)
				)
		);
	?>
	margin : 0 0 1.2em 0;
	padding : 0px 0px 2.4em 0px;
	background-color : #D8D8DC;
}

.app_posts {
	width : 32%;
	margin-left : 1%;
	float : left;
	background-color : #D8D8DC;
	border : 1px solid #ddd;
}

.app_posts_related {
	margin : 0 1em 1.2em 0;
	background-color : #62628C;
	color : #fff;
}

.app_posts_related a {
	color : #fff;
	border-bottom : 1px solid #fff;
	text-decoration : none;
}

.app_posts_related h2 {
	color : #fff;
	text-shadow : 0 2px 1px rgba(0, 0, 0, 0.698), 0 0 2px #000;
}

.app_posts_left {
	width : 32%;
	float : left;
}

.inner {
	padding : 1.2em;
}

.dates,
.description {
	margin : 1.2em 0 0 0;
}

.dates {
	text-transform : uppercase;
	font-size : 0.9em;
	background-color : #fff;
	color : #333;
	padding : 0.8em;
}

#app_posts_sydphp {
	background-color : #D8D8DC;
	border : 1px solid #ddd;
}

#app_posts_syndicated {
	background-color : #fbfbfb;
	border : 1px solid #eee;
}

#app_posts_jobs {
	background-color : #FBF5D9;
	border : 1px solid #D7D2BB;
}


.share-links,
.pin-right {
	float : right;
	display : block;
	width : 30%;
}

.share-links ul {
	list-style-type : none;
	padding : 0;
	margin : 0;
}

.share-links li {
	display : block;
	float : left;
	margin : 0em 0em 1em 1em;
	padding : 0;
}

.category-other {
	border-top : 1px solid #fff;
	margin : 1em 0 0 0;
	padding : 1em 0;
}


/* events */
.event-registration {
	float :right;
	margin : 0 0 2em 2em;
	background-color : #fff;
	color : #333;
	padding : 1.3em;
	<?php
		$ncss->Reset()
		->Radius(array('all' => '11px'));
	?>
}

.event-registration a {
	color : #333;
}

.event-datetime p {
	font-size : 1.4em;
	font-weight : strong;
	padding : 0.8em 0em;
}

.event-sidebar-item {
	margin : 0 0 1.3em 0;
}

.event-details .event-registration a {
	color : #333;
}

#EventRegisterForm_RegisterForm {
	padding : 1em 0em;
	display : block;
}

#EventRegisterForm_RegisterForm div.field {
	margin : 0em;
	color : #fff;
	padding : 0.8em;
}

#EventRegisterForm_RegisterForm .field label {
	display : block;
	width : 35%;
	font-weight : bold;
	float : left;
	text-align : right;
}


#EventRegisterForm_RegisterForm .field .middleColumn {
	display : block;
	float : right;
	width : 55%;
}

#EventRegisterForm_RegisterForm #Tickets {
	background : none;
	padding : 0;
	margin : 0 0 1.5em 0;
}

#EventRegisterForm_RegisterForm #Tickets .middleColumn {
	width : auto;
	float :  none;
}

#Form_ProfileForm input.text {
	width : 50%;
}

#Form_ProfileForm #Password {
	padding : 1em 0em;
}