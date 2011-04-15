<?php
@require_once("../../class.sydphp.php");
$sydphp = new sydphp("css");
//tell the browser this is actually CSS
header("Content-Type: text/css");
?>
/* ============================================================================	
	global
*/
body {
	margin : 0;
	padding : 0px;
	font-family : Verdana, Tahoma, Helvetica, Arial, sans-serif;
	font-size  : small;
	color : #333;
	line-height : 125%;
}

dl {
	padding : 5px;
	margin : 0;
}

dt {
	font-size : 1.1em;
	padding : 2px 2px 3px 9px;
	margin  : 0;
}

dd {
	margin : 0;
	padding : 5px 5px 5px 15px;
}

/* ============================================================================
	hyperlinks
*/
a {
	/*color : #46607D;*/
	color : #444;
	text-decoration : underline;
}
a img, li a img {
	border : none;
}

#forum h3 a {
	color : inherit;
}

#app_header h1 {
	position : relative;
	color : #fff;
}

#app_header h1 sup {
	position : absolute;
	right : 20px;
	top : -10px;
	font-size : 10px;
	color : #fff;
}

#app_header h1 a, #blog h1 a {
	text-decoration : none;
	border : none;
	color : #fff;
}

#app_skip a {
	color : #1c211b;
}

ul#app_navigation {
	padding : 0px;
	margin : 0;
}

ul#app_navigation a, #app_footer a {
	color : #fff;
	font-size : 88%;
	margin : 0 5px 0 0;
	text-decoration : none;
}

ul#app_navigation li a {
	color : #ccc;
	border-bottom : 6px solid #222;
	margin-bottom : 3px;
	display : block;
}

ul#app_navigation li a.current {
	border-bottom : 6px solid #fff;
	font-weight : bold;
	color : #fff;
}

/* ============================================================================
	sydphp group wrapper styles
*/
#app_wrap {
	margin : 0 auto;
	padding : 0px;
}

#app_header {
	padding : 1em 0em;
}

#app_navigation_wrap {
	background-color : #000;
	color : #fff;
	font-weight : bold;
	padding : 10px 2px;
	margin : 0;
	-moz-border-radius-bottomright : 30px;
	-moz-border-radius-topright : 30px;
	-webkit-border-bottom-right-radius : 30px;
	-webkit-border-top-right-radius : 30px;
	-khtml-border-bottom-right-radius : 30px;
	-khtml-border-top-right-radius : 30px;
	border-bottom-right-radius : 30px;
	border-top-right-radius : 30px;
}

#app_sidebar {
	position : absolute;
	left : 0px;
	width : 220px;
	color : #fff;
}

#app_sidebar a {
	color  : #fff;
}

#app_sidebar p.text {
	color : #fff;
	padding : 10px;
	font-size : 90%;
}

#app_sidebar h3 {
	padding : 1em 0em 0.5em 10px;
	margin : 0;
	color : #fff;
	font-size : 1.5em;
}

#app_skip {
	position : absolute;
	left : 0px;
	top : -150px;
	padding : 0px;
}

#app_footer {
	text-align  : right;
	font-size : 90%;
	background-color : #000;
	padding : 1em;
	color : #fff;
	margin : 1em 0 0 240px;
	-moz-border-radius-bottomleft : 30px;
	-moz-border-radius-topleft : 30px;
	-webkit-border-bottom-left-radius : 30px;
	-webkit-border-top-left-radius : 30px;
	-khtml-border-bottom-left-radius : 30px;
	-khtml-border-top-left-radius : 30px;
	border-bottom-left-radius : 30px;
	border-top-left-radius : 30px;
}

#app_content {
	padding : 0em;
	border : none;
	background-color : #fff;
	margin-left : 240px;
	-moz-border-radius-bottomleft : 30px;
	-moz-border-radius-topleft : 30px;
	-webkit-border-bottom-left-radius : 30px;
	-webkit-border-top-left-radius : 30px;
	-khtml-border-bottom-left-radius : 30px;
	-khtml-border-top-left-radius : 30px;
	border-bottom-left-radius : 30px;
	border-top-left-radius : 30px;
}

#forum #app_content #wrapper, #blog #content, #presentations #content {
	padding : 30px;
}

#app_next_meeting {
	position : absolute;
	top : 0px;
	right : 0px;
	background-color : #FBF5D9;
	border : 1px solid #555;
	padding : 3px 1em;
	font-size : 90%;
}
#app_next_meeting p {
	margin : 0;
	padding : 0px;
	color : #333;
}

#app_next_meeting p a {
	color : #333;
}

.presentation_focus {
	padding : 1em;
	background-color : #eee;
	border : 1px dotted #3545D7;
	margin : 0.5em;
	width : 60%;
}

.presentation_focus p {
	margin : 0;
	padding : 0px;
}

/* ============================================================================
	tables
*/
#blog table {
	border : none;
}

#forum table {
	width : 100%;
	margin : 0 auto 0.2em auto;
	border : none;
	border-collapse : collapse;
	clear : both;
}

#forum table caption {
	text-align : left;
	padding : 1px 5px 1px 10px;
	margin : 0;
	color : #333;
	font-style : italic;
	
}

#forum thead {
	background-color : #FBF5D9;
	margin : 0;
}

#forum th {
	text-align : left;
	padding : 10px 5px;
	margin : 0px;
	font-size : 105%;
	letter-spacing : 0.7px;
	border : none;
	font-weight : bold;
}

#forum thead th {
	color : #333;
}


#forum tbody th {
	background-color : #fff;
	color : #333;
}

#forum th a {
	color : inherit;
}

#forum th.col_pri {
	width : 50%;
}

#forum th.col_sec {
	width : auto;
}

#forum th.col_ter {
	width : 5%;
}

#forum tbody {
	padding : 1px;
}

#forum tbody tr, #blog tbody tr {
	margin : 0px;
	padding : 0px;
}

#forum tbody td, #blog tbody td {
	margin : 1px;
	padding : 1px;
	vertical-align : middle;
	text-align : left;
	background-color : transparent;
}

#forum tbody td {}

#forum tbody td.status, #forum tbody td.icon {
	text-align : center;
}

#forum td.forum_topics, #forum td.forum_replies {
	text-align : center;
	font-weight : bold;
	font-size : 130%;
	color : #666;
}

#forum td.forum_replies, #forum td.replies, #forum td.views {
	font-size : 130%;
	text-align : center;
}

/* =============================
	general styles
*/

#forum .generic {
	width : auto;
	margin : 0.5em 1px;
	padding : 0.2em;
	background-color : transparent;
	clear : both;
}

#forum .generic .generic {
	border : none;
	width : 100%;
	margin : 0 auto;
	padding : 0px;
}

/* ============================================================================
	paragraphs
*/
#forum p, #forum .quote_text, #blog p {
	padding : 1px;
	line-height  : 125%;
	margin : 1px 5px;
}

/* ============================================================================
	wiki and forum wrappers
*/
body#forum, body#presentations, body#blog {
	margin :  0px;
	padding : 2.1em 0em;
	background-color : #555;
}

/* ============================================================================
	presentation specific
*/
#presentations .pres {
	padding : 10px;
	background-color : #fff;
	margin : 0 1px 5px 0;
	border-bottom : 1px solid #c00;
}

#presentations .pres h4, #presentations .pres h3 {
	margin : 0;
	padding : 2px;
}
#presentations .pres p {
	margin : 0;
	padding : 1px 1px 1px 5px;
}

/* ============================================================================
	blog specific
*/
#blog #content  {
	color: #000;
}

#blog #sidebar-wrap {
	float : right;
	width : 216px;
	color : #000;
	text-align : left;
	margin : 1em 0em 1em 1em;
	padding : 0px 0px 10px 10px;
	background-color : #fff;
}

#blog #sidebar {
	background-color : #FBF5D9;
	border : 1px solid #ccc;
	padding : 10px;
}

#blog #searchbar {
	text-align : right;
	padding : 3px;
}

#blog #searchbar input {
	border : 1px solid #ccc;
	margin : 0;
}

#blog #searchbar form {
	margin : 0;
}

#blog #sidebar h3 {
	font-size : 110%;
	font-weight : bold;
	letter-spacing : -0.03em;
	margin : 0em;
	padding : 3px;
}

#blog #sidebar ul {
	margin : 0;
	padding : 0.5em 1.5em;
}

#blog #sidebar li {
	line-height : 1.5em;
}
#blog #sidebar li a {
	color : inherit;
}

#blog #photos {
	padding : 2em;
}

#blog .post {
	padding : 0px;
	margin : 0 0 5px 0;
	background-color : #fff;
	border-bottom : 1px solid #c00;
}

#blog .post h2 {
	background-color : #FBF5D9;
	padding : 0.7em;
}

#blog .post .post-inner {
	background-color : #fff;
	border : 1px solid #fff;
	padding : 1em;
}

#blog h4#comments, #blog h3 {
	font-weight : bold;
}

#blog h5 {
	margin : 0.1em;
	padding : 0px;
	line-height : 500%;
}

#blog h5 span {
	font-size : 500%;
	color : #333;
	margin-right : 5px;
}

#blog .commentbody p {
	padding-left : 3em;
}

#blog #app_content p {
	margin : 0;
	padding : 0em 0em 0.3em 0em;
}

#blog .post .entry {
	padding : 10px;
}

#blog .post .postmetadata {
	margin-top : 1em;
	background-color : #eee;
	padding : 1em;
	color : #666;
}

#blog #footer {
	clear : both;
}

/* ============================================================================
	forum specific
*/
#forum #content {
	padding : 0em;
}

#forum .category, #forum #pm_folder {
	margin : 10px auto;
	width : 98%;
	padding : 1px;
}

#forum .board_users, #forum .board_stats {
}

#forum .board_users {
}

#forum .board_stats {
}


#forum #main_header_member, #forum #main_header_guest, #blog #searchbar {
	color : #fff;
	background-color : #3545D7;
}

#forum .main_message p {
	padding : 5px 10px;
}
/* ============================================================================
	forms and associated controls
*/
#forum form {
	padding : 1px;
}

#forum fieldset, #blog fieldset
{
	border : 1px solid #ccc;
	border-top : 6px solid #aaa;
	padding : 5px;
	margin : 5px 1px;
}

#forum fieldset#basic_search {
	width : 48%;
	float : left;
	display : block;
}

#forum fieldset#advanced_search {
	width : 48%;
	float : right;
	display : block;
}

#forum .generic fieldset#post_icon li, #forum .generic fieldset#post_icon li, #forum .generic fieldset#post_icon label, #forum .generic fieldset#post_icon label {
	float : left;
	display : block;
	width : 32px;
	text-align : center;
	margin : 2px 1px;
}

#forum .generic fieldset#post_icon ul, #forum .generic fieldset#post_icon ul {
	margin : 0;
	padding : 0px;
	list-style-type : none;
}

#forum #post_topic fieldset#post_icon li, #forum #mode_edit_post fieldset#post_icon li {
	list-style-type : none;
}

#forum #post_topic fieldset#post_icon label, #forum #mode_edit_post fieldset#post_icon label {
	display : block;
}

#forum #post_topic #post_mbcode, #forum #mod_edit_post #post_mbcode, #forum #post_topic #post_text_format, #forum #post_topic #post_smilies, #forum #post_reply #post_mbcode, #forum #post_reply #post_text_format, #forum #post_reply #post_smilies
{
	width : 75%;
	margin : 2px auto;
}

#forum #post_topic #post_mbcode input, #forum #mod_edit_post #post_box_plain input, #forum #post_reply #post_mbcode input
{
	padding : 3px 10px;
	margin : 1px 1px 0px 0px;
	width : 65px;
	border : 1px solid #aaa;
	text-transform : lowercase;
}


#forum .generic legend
{
	font-size : 120%;
	font-weight : bold;
}

#forum .generic label
{
	display : block;
	margin : 15px 1px 0px 1px;
}

#forum #search_main label.nextto input
{
	display : static;
	background-color : #000;
	padding : 4px;
}

#forum #search_main label.break {
	text-align : center;
	width  : 150px;
	margin  : 10px auto;
}

#forum textarea, #blog textarea {
	height : 160px;
	width : 98%;
	background-color : #FBF5D9;
	font-family : inherit;
	border-top : 1px solid #555;
	border-left : 1px solid #555;
	border-right : 1px solid #bbb;
	border-bottom : 1px solid #bbb;
	padding : 2px;
	font-family : sans-serif;
	font-size : 95%;
	margin : 3px auto;
	display : block;
}

#forum input.input {
	margin  : 3px auto;
	background-color : #FBF5D9;
	font-family : inherit;
	border-top : 1px solid #555;
	border-left : 1px solid #555;
	border-right : 1px solid #bbb;
	border-bottom : 1px solid #bbb;
	padding : 2px;
	display : block;
	width : 98%;
}

#forum select.select {
	width : 98%;
	margin : 0 auto;
	display : block;
	background-color : #FBF5D9;
}

#forum option {
	background-color : #FBF5D9;
}

#forum select.inline, #forum input.inline {
	display : inline;
}

#forum fieldset#post_attach .file_upload
{
	padding : 5px;
	margin : 2px 5px 2px 0px;
}

#forum .forumjump form
{
	padding : 2px;
	margin : 0;
}

/* ============================================================================
	various content blocks
*/
#forum .help_descriptive_entry {
	padding  : 5px 40px 20px 40px;
}

#forum .help_descriptive_entry p {
	padding  : 2px 10px;
}

#forum .forumjump {
	float : right;
	padding : 1px;
}

#forum .forumlegend {
	clear : both;
	margin :  2px;
}

#forum td .votebar {
	border : 1px solid #999;
	background-color : #ccc;
	color : #ccc;
	height : 1.5em;
}

#forum .pm_message {
	border : 1px solid #ccc;
	background-color : #fff;
	padding : 4px;
	font-size : 120%;
	clear : both;
}

#forum .pm_sender img {
	float : left;
	display : block;
	margin : 0 1em 1em 0;
}

#forum .pm_message .signature {
	clear : both;
	color : #000;
	font-size : 150%;
}


/* ============================================================================
	forum polls
*/
#forum #poll_results_main
{
	border : 1px solid #ccc;
}
#forum #poll_results_entry
{
	border : 1px solid #ccc;
	margin : 1px;
}

/* ============================================================================
	forum topics
*/
#forum .topic_poster_member
{
	border : 3px solid #fff;
	padding : 5px;
	margin : 1px;
}

#forum .topic_poster_member img {
	margin : 0 auto;
}

#forum .topic_poster_member table th {
	background-color : transparent
}

#topic_main_header, #topic_main_footer
{
	border : 1px solid #000;
	margin : 10px 30px 10px 190px;
	padding : 0px;
	background-color : #fff;
}

/* ============================================================================
	forum post blocks
*/
#forum .post_wrapper, #forum .post_review_entry {
	padding : 1em 0px 0px 0px;
	margin : 0;
	border-bottom : 5px solid #ccc;
}

#forum .post_wrapper .forumactions {
	padding-bottom : 1em;
}
#forum .post_wrapper .forumactions ul {
	list-style-type : none;
	margin : 0;
	padding : 0px;
}
#forum .post_wrapper .forumactions ul li {
	float : left;
	text-align : center;
	margin : 0 0.5em 0 0;
	padding : 0px;
}
#forum .post_wrapper .forumactions ul li img {
	display : block;
	margin : 0 auto;
}

#forum .post_info{}

#forum .post_text {
	padding : 5px 10px;
	font-size : 100%;
	line-height : 120%;
}

#forum .post_user_info {
	width : 210px;
	float : right;
	padding : 0px 0px 5px 0px;
	margin-left  : 10px;
	border : 1px solid #ccc;
}

.post_edited {
	clear  : both;
}

.poster_icons {
	padding : 2px;
	width : 100%;
	margin : 0 auto;
	text-align : center;
}

.poster_icons a {
	margin : 7px 4px;
}

/* ============================================================================
	forum member profiles
*/
#forum .profile_main .profile_box {
	float : left;
	padding : 6px 3px;
	width : 22%;
	margin : 0 1%;
}

/* ============================================================================
	forum user blocks
*/
#forum .user_signature {
	font-family : serif;
	font-size : 110%;
	letter-spacing : 0.1px;
	color : #666;
	padding : 5px;
}

#forum .user_avatar {
	width : 180px;
	float : left;
}

#forum .user_avatar img {
	border : 1px solid #000;
	display : block;
}

/* ============================================================================
	forum topic quotes
*/

#forum .quotebox {
	margin-right : 200px;
}

#forum .quotebox strong {
	font-family : sans-serif;
	position : relative;
	top : 0.5em;
	left : 2em;
	padding : 0em 0.5em;
	background-color : #fff;
}

#forum .quote .quotebox {
	margin-right : 0px;
}

#forum .quote {
	border : 1px dashed #999;
	margin : 0px 10px;
	font-family : Georgia, serif;
	color : #333;
	font-size : 1.2em%;
	letter-spacing : 0.2px;
	padding : 20px;
}

#forum .quote .quote {
	color : #666;
}

/* ============================================================================
	forum topic level
*/
#forum .topic_level {
	width : 180px;
	float : right;
	text-align : center;
	padding : 10px 0px;
}

/* ============================================================================
	forum tree (breadcrumb) navigation
*/
#forum .tree {
	padding : 1em 2em;
}

/* ============================================================================
	forum legal
*/
#forum #copyright {
	font-size : 95%;
	clear : both;
	padding : 5px;
	width : 95%;
	margin : 0 auto;
}

#forum #copyright p
{
	padding : 2px;
	margin : 0;
}

/* ============================================================================
	forum paging
*/
#forum div.pagination {
	text-align : center;
	color : #666;
	padding : 0px;
	clear : both;
}

/* ============================================================================
	headings
*/

h1, h2, h3, h4, h5, h6, #forum td.forum_topics, #forum td.forum_replies, #forum td.replies, #forum td.views {
	font-family : FreeSans, Arial, Helvetica, sans-serif;
}

#forum h1 {
	margin : 0;
	padding : 0px;
}

#blog h2, #forum h2, #presentations h2 {
	font-size : 120%;
	font-weight : bold;
	letter-spacing : -0.03em;
	padding : 1px;
	margin : 0px;
}

#blog h2 span {
	font-size : 90%;
	font-weight : normal;
	margin-left : 1em;
}

#forum #app_header h1, #blog #app_header h1, #presentations #app_header h1 {
	font-weight : bold;
	font-size : 250%;
	color : #1b2155;
	margin : 0;
	padding : 0px;
	letter-spacing : -0.2px;
}

#forum #app_content h3 {
	background-color : transparent;
	color : #333;
	margin : 0;
	padding : 0.5em 0em;
}

#forum h3 span.pagelinks {
	font-size : 70%;
	font-weight : normal;
}

#forum #app_content h3, #blog #app_content h3 {
	font-size : 1.5em;
}

#forum .category h3 {
	margin : 3px 5px 3px 0px;
	padding : 1px;
	background-color : #fff;
}

#forum #copyright h3 {
	font-weight : normal;
	text-transform : uppercase;
	color : #555;
	margin : 0;
	padding : 2px 0px;
}

#forum h4 {
	font-size : 105%;
	margin : 1px;
	padding : 1px;
	clear : both;
}

#forum .quote h5 {
	color : #1c211b;
	background-color : #ccc;
	padding : 4px 10px;
	margin : 0;
	font-family : Georgia, sans-serif;
	font-weight : bold;
	font-size : 100%;
}

/* ============================================================================
	list content
*/
#app_skip ul {
	margin : 0;
	padding : 0px;
}

ul#app_navigation {
	padding : 2px;
}

#app_skip li, ul#app_navigation li {
	list-style-type : none;
	margin : 0;
	padding : 2px;
	text-align : left;
	color : #fff;
}

 ul#app_navigation li a {
 	color : #fff;
 }

#app_skip li {
	text-align : right;
}

#app_skip li.end {
	float : none;
}

#forum #main_header_member ul, #forum #main_header_guest ul {
	border : none;
	margin : 0px;
	padding : 0px;
	font-size : 90%; 
}

#forum #main_header_member ul li, #forum #main_header_guest ul li {
	list-style-type : none;
	padding : 2px 10px;
	margin : 0;
	color : #fff;
	float : left;
}

#forum #main_header_member ul li a, #forum #main_header_guest ul li a {
	color : #fff;
}

#forum #main_header_member ul li.stop, #forum #main_header_guest ul li.stop {
	background : transparent;
	text-transform : uppercase;
	float : none;
	font-weight : bold;
	text-align : right;
}

#forum #topic_main_header ul, #forum #topic_main_footer ul {
	padding : 0px;
	margin : 0px
}

#forum #topic_main_header li, #forum #topic_main_footer li {
	float : left;
	list-style-type : none;
	margin : 5px 0px 5px 10px;
}

#forum ul.forumactions {
	padding : 0em 0.5em;
	margin : 0;
}

#forum ul.forumactions li {
	float : left;
	list-style-type : none;
	padding : 5px 5px 5px 0px;
	display : block;
	text-align : center;
}

#forum ul.forumactions li img {
	display : block;
	margin : 0 auto;
}

ul.foot li {
	list-style-type : none;
	float : left;
	padding  : 5px 10px 5px 1px;
}

#forum ul.members_main { 
	list-style-type : none;
	padding : 2px;
	display : block;
	margin : 0 auto;
}

#forum ul.members_main li {
	float : left;
	padding : 2px 5px;
}

#forum .post_text .code {
	font-family : "Lucida Sans", Courier, monospace;
	font-size : 130%;
	line-height : 120%;
	padding : 3px 1px;
	overflow : auto;
}

#forum .profile_main dl {
	padding : 3px;
}

#forum .profile_main dt {
	margin : 0px 3px;
	padding : 2px 5px;
	font-weight : bold;
	font-size : 90%;
}

#forum .profile_main dt img {
	margin-right : 5px;
}

#forum .profile_main dd {
	padding : 2px;
	margin : 0px 5px 15px 25px;
}

/* ============================================================================
	list content
*/
#forum .forumicons {
	float : left;
	padding : 5px;
	text-align : center;
	margin : 1px 1px 1px 0px;
	width : 64px;
	height : 96px;
}
#forum .forumicons img{
	display : block;
	padding : 3px;
	margin : 0 auto;
	
}

/* ============================================================================
	dedicated clearerers
*/
#forum .break, hr.break  {
	clear : both;
}

hr.break {
	visibility : hidden;
	height : 0em;
	line-height : 0;
	margin : 0;
	padding : 0px;
	font-size : 0;
}

/* ============================================================================
	flickr badge
*/

#flickrbadge {
	vertical-align :middle;
	height : 150px;
}

#flickrbadge img {
	vertical-align :middle;
	display : inline;
	margin-right : 1em;
}