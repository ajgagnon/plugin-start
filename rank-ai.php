<?php
/**
 * Plugin Name: Rank AI
 * Plugin URI: https://rank-ai.com/
 * Description: Rank AI is a plugin that helps you rank your content in search engines.
 * Version: 1.0.0
 * Author: Rank AI
 * Author URI: https://rank-ai.com
 * License: GPL-2.0-only
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rank-ai
 * Domain Path: /languages
 *
 * @package RankAI
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RANK_AI_PLUGIN_FILE', __FILE__ );
define( 'RANK_AI_PLUGIN_DIR', __DIR__ );

define( 'RANK_AI_PLUGIN_DIR_NAME', dirname( plugin_basename( RANK_AI_PLUGIN_FILE ) ) );
define( 'RANK_AI_LANGUAGE_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'languages' );
define( 'RANK_AI_DIST_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'dist' );
define( 'RANK_AI_VENDOR_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'vendor' );
define( 'RANK_AI_PLUGIN_BASE', plugin_basename( RANK_AI_PLUGIN_FILE ) );

// Load composer dependencies.
if ( file_exists( RANK_AI_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php' ) ) {
	require_once RANK_AI_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php';
}

// Load helpers.
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'RankAI.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'helpers.php';

// Bootstrap plugin after all dependencies and helpers are loaded.
\RankAI\RankAI::make()->bootstrap( require __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config.php' );

// Register hooks.
require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'hooks.php';
