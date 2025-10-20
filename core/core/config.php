<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@ANDREBASE.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://ANDREBASE.com/
 */

/**
 * Absolute path to application's directory.
 */
if ( ! defined( 'ANDREBASE_DIR' ) ) {
	define( 'ANDREBASE_DIR', __DIR__ );
}

/**
 * Service container keys.
 */
if ( ! defined( 'ANDREBASE_CONFIG_KEY' ) ) {
	define( 'ANDREBASE_CONFIG_KEY', 'ANDREBASE.config' );
}

if ( ! defined( 'ANDREBASE_APPLICATION_KEY' ) ) {
	define( 'ANDREBASE_APPLICATION_KEY', 'ANDREBASE.application.application' );
}

if ( ! defined( 'ANDREBASE_APPLICATION_GENERIC_FACTORY_KEY' ) ) {
	define( 'ANDREBASE_APPLICATION_GENERIC_FACTORY_KEY', 'ANDREBASE.application.generic_factory' );
}

if ( ! defined( 'ANDREBASE_APPLICATION_CLOSURE_FACTORY_KEY' ) ) {
	define( 'ANDREBASE_APPLICATION_CLOSURE_FACTORY_KEY', 'ANDREBASE.application.closure_factory' );
}

if ( ! defined( 'ANDREBASE_HELPERS_HANDLER_FACTORY_KEY' ) ) {
	define( 'ANDREBASE_HELPERS_HANDLER_FACTORY_KEY', 'ANDREBASE.handlers.helper_factory' );
}

if ( ! defined( 'ANDREBASE_WORDPRESS_HTTP_KERNEL_KEY' ) ) {
	define( 'ANDREBASE_WORDPRESS_HTTP_KERNEL_KEY', 'ANDREBASE.kernels.wordpress_http_kernel' );
}

if ( ! defined( 'ANDREBASE_SESSION_KEY' ) ) {
	define( 'ANDREBASE_SESSION_KEY', 'ANDREBASE.session' );
}

if ( ! defined( 'ANDREBASE_REQUEST_KEY' ) ) {
	define( 'ANDREBASE_REQUEST_KEY', 'ANDREBASE.request' );
}

if ( ! defined( 'ANDREBASE_RESPONSE_KEY' ) ) {
	define( 'ANDREBASE_RESPONSE_KEY', 'ANDREBASE.response' );
}

if ( ! defined( 'ANDREBASE_EXCEPTIONS_ERROR_HANDLER_KEY' ) ) {
	define( 'ANDREBASE_EXCEPTIONS_ERROR_HANDLER_KEY', 'ANDREBASE.exceptions.error_handler' );
}

if ( ! defined( 'ANDREBASE_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY' ) ) {
	define( 'ANDREBASE_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY', 'ANDREBASE.exceptions.configuration_error_handler' );
}

if ( ! defined( 'ANDREBASE_RESPONSE_SERVICE_KEY' ) ) {
	define( 'ANDREBASE_RESPONSE_SERVICE_KEY', 'ANDREBASE.responses.response_service' );
}

if ( ! defined( 'ANDREBASE_ROUTING_ROUTER_KEY' ) ) {
	define( 'ANDREBASE_ROUTING_ROUTER_KEY', 'ANDREBASE.routing.router' );
}

if ( ! defined( 'ANDREBASE_ROUTING_ROUTE_BLUEPRINT_KEY' ) ) {
	define( 'ANDREBASE_ROUTING_ROUTE_BLUEPRINT_KEY', 'ANDREBASE.routing.route_registrar' );
}

if ( ! defined( 'ANDREBASE_ROUTING_CONDITIONS_CONDITION_FACTORY_KEY' ) ) {
	define( 'ANDREBASE_ROUTING_CONDITIONS_CONDITION_FACTORY_KEY', 'ANDREBASE.routing.conditions.condition_factory' );
}

if ( ! defined( 'ANDREBASE_ROUTING_CONDITION_TYPES_KEY' ) ) {
	define( 'ANDREBASE_ROUTING_CONDITION_TYPES_KEY', 'ANDREBASE.routing.conditions.condition_types' );
}

if ( ! defined( 'ANDREBASE_VIEW_SERVICE_KEY' ) ) {
	define( 'ANDREBASE_VIEW_SERVICE_KEY', 'ANDREBASE.view.view_service' );
}

if ( ! defined( 'ANDREBASE_VIEW_COMPOSE_ACTION_KEY' ) ) {
	define( 'ANDREBASE_VIEW_COMPOSE_ACTION_KEY', 'ANDREBASE.view.view_compose_action' );
}

if ( ! defined( 'ANDREBASE_VIEW_ENGINE_KEY' ) ) {
	define( 'ANDREBASE_VIEW_ENGINE_KEY', 'ANDREBASE.view.view_engine' );
}

if ( ! defined( 'ANDREBASE_VIEW_PHP_VIEW_ENGINE_KEY' ) ) {
	define( 'ANDREBASE_VIEW_PHP_VIEW_ENGINE_KEY', 'ANDREBASE.view.php_view_engine' );
}

if ( ! defined( 'ANDREBASE_SERVICE_PROVIDERS_KEY' ) ) {
	define( 'ANDREBASE_SERVICE_PROVIDERS_KEY', 'ANDREBASE.service_providers' );
}

if ( ! defined( 'ANDREBASE_FLASH_KEY' ) ) {
	define( 'ANDREBASE_FLASH_KEY', 'ANDREBASE.flash.flash' );
}

if ( ! defined( 'ANDREBASE_OLD_INPUT_KEY' ) ) {
	define( 'ANDREBASE_OLD_INPUT_KEY', 'ANDREBASE.old_input.old_input' );
}

if ( ! defined( 'ANDREBASE_CSRF_KEY' ) ) {
	define( 'ANDREBASE_CSRF_KEY', 'ANDREBASE.csrf.csrf' );
}
