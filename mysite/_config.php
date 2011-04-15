<?php
ini_set('display_errors', FALSE);

global $project;
$project = 'mysite';

//place this external so it can be incorporated into version control
require(dirname(__FILE__). "/db.php");

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('sydphp');

// Set the site locale
i18n::set_locale('en_AU');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();

// general configs
//site config
DataObject::add_extension('SiteConfig', 'Codem_SiteConfig');

//START BC COMMENT EXTENSIONS
Object::add_extension('PageComment', 'Codem_PageComment');
Director::addRules(50, array('admin/comments//$Action/$ID' => 'Codem_CommentAdminExtension'));
CMSMenu::remove_menu_item('CommentAdmin');//remove comment admin from menu item
//moderate them
PageComment::enableModeration();
//END BC COMMENT EXTENSIONS

//options for editor
HtmlEditorConfig::get('cms')->setOption('content_css', 'cms/css/editor.css, themes/sydphp/css/editor.css');
HtmlEditorConfig::get('cms')->setOption('theme_advanced_blockformats', 'p,h3,h4,h5,h6');

//Calendar stuff
Calendar::set_param('timezone', 'Australia/Sydney');
CalendarDateTime::set_param('offset','+10:00');

/**
 * various defines, deprecated and should be moved to SiteConfig
 * these will be phased out as required
 */
define('CODEM_ENABLE_SYSLOG', FALSE);
define('CODEM_EVENT_REGISTRATION_TO', 'james@localhost');
define('CODEM_EVENT_REGISTRATION_FROM', 'james@localhost');
define('CODEM_FORM_MAIL_TO', 'james@localhost');
define('CODEM_FORM_MAIL_FROM', 'james@localhost');
?>