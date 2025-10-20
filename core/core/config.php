<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@RANKAI.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://RANKAI.com/
 */

/**
 * Absolute path to application's directory.
 */
if ( ! defined( 'RANKAI_DIR' ) ) {
	define( 'RANKAI_DIR', __DIR__ );
}

/**
 * Service container keys.
 */
if ( ! defined( 'RANKAI_CONFIG_KEY' ) ) {
	define( 'RANKAI_CONFIG_KEY', 'RANKAI.config' );
}

if ( ! defined( 'RANKAI_APPLICATION_KEY' ) ) {
	define( 'RANKAI_APPLICATION_KEY', 'RANKAI.application.application' );
}

if ( ! defined( 'RANKAI_APPLICATION_GENERIC_FACTORY_KEY' ) ) {
	define( 'RANKAI_APPLICATION_GENERIC_FACTORY_KEY', 'RANKAI.application.generic_factory' );
}

if ( ! defined( 'RANKAI_APPLICATION_CLOSURE_FACTORY_KEY' ) ) {
	define( 'RANKAI_APPLICATION_CLOSURE_FACTORY_KEY', 'RANKAI.application.closure_factory' );
}

if ( ! defined( 'RANKAI_HELPERS_HANDLER_FACTORY_KEY' ) ) {
	define( 'RANKAI_HELPERS_HANDLER_FACTORY_KEY', 'RANKAI.handlers.helper_factory' );
}

if ( ! defined( 'RANKAI_WORDPRESS_HTTP_KERNEL_KEY' ) ) {
	define( 'RANKAI_WORDPRESS_HTTP_KERNEL_KEY', 'RANKAI.kernels.wordpress_http_kernel' );
}

if ( ! defined( 'RANKAI_SESSION_KEY' ) ) {
	define( 'RANKAI_SESSION_KEY', 'RANKAI.session' );
}

if ( ! defined( 'RANKAI_REQUEST_KEY' ) ) {
	define( 'RANKAI_REQUEST_KEY', 'RANKAI.request' );
}

if ( ! defined( 'RANKAI_RESPONSE_KEY' ) ) {
	define( 'RANKAI_RESPONSE_KEY', 'RANKAI.response' );
}

if ( ! defined( 'RANKAI_EXCEPTIONS_ERROR_HANDLER_KEY' ) ) {
	define( 'RANKAI_EXCEPTIONS_ERROR_HANDLER_KEY', 'RANKAI.exceptions.error_handler' );
}

if ( ! defined( 'RANKAI_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY' ) ) {
	define( 'RANKAI_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY', 'RANKAI.exceptions.configuration_error_handler' );
}

if ( ! defined( 'RANKAI_RESPONSE_SERVICE_KEY' ) ) {
	define( 'RANKAI_RESPONSE_SERVICE_KEY', 'RANKAI.responses.response_service' );
}

if ( ! defined( 'RANKAI_ROUTING_ROUTER_KEY' ) ) {
	define( 'RANKAI_ROUTING_ROUTER_KEY', 'RANKAI.routing.router' );
}

if ( ! defined( 'RANKAI_ROUTING_ROUTE_BLUEPRINT_KEY' ) ) {
	define( 'RANKAI_ROUTING_ROUTE_BLUEPRINT_KEY', 'RANKAI.routing.route_registrar' );
}

if ( ! defined( 'RANKAI_ROUTING_CONDITIONS_CONDITION_FACTORY_KEY' ) ) {
	define( 'RANKAI_ROUTING_CONDITIONS_CONDITION_FACTORY_KEY', 'RANKAI.routing.conditions.condition_factory' );
}

if ( ! defined( 'RANKAI_ROUTING_CONDITION_TYPES_KEY' ) ) {
	define( 'RANKAI_ROUTING_CONDITION_TYPES_KEY', 'RANKAI.routing.conditions.condition_types' );
}

if ( ! defined( 'RANKAI_VIEW_SERVICE_KEY' ) ) {
	define( 'RANKAI_VIEW_SERVICE_KEY', 'RANKAI.view.view_service' );
}

if ( ! defined( 'RANKAI_VIEW_COMPOSE_ACTION_KEY' ) ) {
	define( 'RANKAI_VIEW_COMPOSE_ACTION_KEY', 'RANKAI.view.view_compose_action' );
}

if ( ! defined( 'RANKAI_VIEW_ENGINE_KEY' ) ) {
	define( 'RANKAI_VIEW_ENGINE_KEY', 'RANKAI.view.view_engine' );
}

if ( ! defined( 'RANKAI_VIEW_PHP_VIEW_ENGINE_KEY' ) ) {
	define( 'RANKAI_VIEW_PHP_VIEW_ENGINE_KEY', 'RANKAI.view.php_view_engine' );
}

if ( ! defined( 'RANKAI_SERVICE_PROVIDERS_KEY' ) ) {
	define( 'RANKAI_SERVICE_PROVIDERS_KEY', 'RANKAI.service_providers' );
}

if ( ! defined( 'RANKAI_FLASH_KEY' ) ) {
	define( 'RANKAI_FLASH_KEY', 'RANKAI.flash.flash' );
}

if ( ! defined( 'RANKAI_OLD_INPUT_KEY' ) ) {
	define( 'RANKAI_OLD_INPUT_KEY', 'RANKAI.old_input.old_input' );
}

if ( ! defined( 'RANKAI_CSRF_KEY' ) ) {
	define( 'RANKAI_CSRF_KEY', 'RANKAI.csrf.csrf' );
}
