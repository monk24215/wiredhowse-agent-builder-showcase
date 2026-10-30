<?php
///////////////////////////////////////////

///////////////////////////////////////////
// bootstrap.php
//===================================================
////////////////////////////////////
if (!defined('AUTH_SECRET')) {define('AUTH_SECRET', '7f3a9d2e1b8c4f6a0e5d7c3b9a2f1e8d4c6b0a7f3e9d2c1b8a5f4e7d3c6b9a2');}
if (!defined('AUTH_SERVER')) {define('AUTH_SERVER', 'https://auth.wiredhowse.app');}
if (!defined('JWT_TTL')) {define('JWT_TTL', 900);}
if (!defined('ABSPATH')) { define('ABSPATH', __DIR__ . '/'); }
if (!defined('WH_LIB')) { define('WH_LIB',  ABSPATH . 'lib/'); }
if (!defined('WH_UTIL')) { define('WH_UTIL',  ABSPATH . 'util/'); }
if (!defined('ENV_FILE')) { define('ENV_FILE', ABSPATH . '.env'); }
//===================================================
require_once ABSPATH . '_auth/check.php';
require_once WH_LIB . 'bootstrap-lib.php';
//===================================================
Autoloader::setPath(ABSPATH . 'lib/');
spl_autoload_register(['Autoloader', 'loader']);
//===================================================
// require_once ABSPATH . 'config/wh-config.php';
// //===================================================
// Env::load(ENV_FILE);
// //==================================================
require_once WH_LIB . '_lib.php';

function cfg(): array { static $c;
    if (!$c) {
        $c = require ABSPATH . 'config.php';
    }
    return $c;
}


require_once WH_UTIL . 'isallowed.php';

// //===================================================
// // 
// // FileLoader::incs('util', 'AbsPathInc.php');
// // FileLoader::incs('util', 'AccessInc.php');
// Env::load();
// //===================================================
//require_once WH_UTIL . 'wh_securcheck.php';
// //===================================================


