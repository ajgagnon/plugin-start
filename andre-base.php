<?php
/**
 * Plugin Name: Andre Base
 * Plugin URI: https://example.com/andre-base
 * Description: Andre Base is a WordPress plugin.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL-2.0-only
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: andre-base
 * Domain Path: /languages
 *
 * @package AndreBase
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ANDREBASE_PLUGIN_FILE', __FILE__ );
define( 'ANDREBASE_PLUGIN_DIR', __DIR__ );

define( 'ANDREBASE_PLUGIN_DIR_NAME', dirname( plugin_basename( ANDREBASE_PLUGIN_FILE ) ) );
define( 'ANDREBASE_LANGUAGE_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'languages' );
define( 'ANDREBASE_DIST_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'dist' );
define( 'ANDREBASE_VENDOR_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'vendor' );
define( 'ANDREBASE_PLUGIN_BASE', plugin_basename( ANDREBASE_PLUGIN_FILE ) );

// Load composer dependencies.
if ( file_exists( ANDREBASE_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php' ) ) {
	require_once ANDREBASE_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php';
}

// Load helpers.
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'AndreBase.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'helpers.php';

// Bootstrap plugin after all dependencies and helpers are loaded.
\AndreBase\AndreBase::make()->bootstrap( require __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config.php' );

// Register hooks.
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'hooks.php';
