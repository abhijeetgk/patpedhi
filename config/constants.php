<?php

/**
 * Global Constants file
 */
define('DEFAULT_LANG', 'mr');
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');
define('SITE_NAME', 'Patpedhi Software');
if ($_SERVER['HTTP_HOST'] == 'patpedhi') {
    define('BASE_URL', 'http://patpedhi/');
}
else {
    define('BASE_URL','http://patpedhi.in/');
}
define('ASSETS_PATH', 'http://' . $_SERVER['HTTP_HOST'] . '/assets/');

// css and js images constants
define('CSS_PATH', ASSETS_PATH . "css/");
define('JS_PATH', ASSETS_PATH . "js/");
define('IMAGES_PATH', ASSETS_PATH . "images/");
