<?php
/*
Plugin Name: Find Your Nearest
Plugin URI: https://cbenjafield.com/plugins/wordpress/find-your-nearest
Description: A WordPress plugin that allows a visitor to find their nearest branch, store etc.
Text Domain: find-your-nearest
Version: 1.0.0
Author: Charlie Benjafield
Author URI: http://cbenjafield.com
License: MIT

Copyright (c) 2019 Charlie Benjafield
*/
define('FYN_plugin_path', plugin_dir_path(__FILE__));
define('FYN_plugin_url', plugin_dir_url(__FILE__));
define('FYN_src_path', FYN_plugin_path . '/src');
define('FYN_components_path', FYN_plugin_path . '/components');

require_once FYN_src_path . '/functions.php';
require_once FYN_src_path . '/FindYourNearest.php';
require_once FYN_src_path . '/Admin.php';

$fyn = new Benjafield\FindYourNearest\FindYourNearest;