<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@rank_ai.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://rank_ai.com/
 */

/**
 * Absolute path to application's directory.
 */
if ( ! defined( 'RANK_AI_DIR' ) ) {
	define( 'RANK_AI_DIR', __DIR__ );
}

/**
 * Service container keys.
 */
if ( ! defined( 'RANK_AI_CONFIG_KEY' ) ) {
	define( 'RANK_AI_CONFIG_KEY', 'rank_ai.config' );
}

if ( ! defined( 'RANK_AI_APPLICATION_KEY' ) ) {
	define( 'RANK_AI_APPLICATION_KEY', 'rank_ai.application.application' );
}

if ( ! defined( 'RANK_AI_APPLICATION_GENERIC_FACTORY_KEY' ) ) {
	define( 'RANK_AI_APPLICATION_GENERIC_FACTORY_KEY', 'rank_ai.application.generic_factory' );
}

if ( ! defined( 'RANK_AI_APPLICATION_CLOSURE_FACTORY_KEY' ) ) {
	define( 'RANK_AI_APPLICATION_CLOSURE_FACTORY_KEY', 'rank_ai.application.closure_factory' );
}

if ( ! defined( 'RANK_AI_HELPERS_HANDLER_FACTORY_KEY' ) ) {
	define( 'RANK_AI_HELPERS_HANDLER_FACTORY_KEY', 'rank_ai.handlers.helper_factory' );
}

if ( ! defined( 'RANK_AI_WORDPRESS_HTTP_KERNEL_KEY' ) ) {
	define( 'RANK_AI_WORDPRESS_HTTP_KERNEL_KEY', 'rank_ai.kernels.wordpress_http_kernel' );
}

if ( ! defined( 'RANK_AI_SESSION_KEY' ) ) {
	define( 'RANK_AI_SESSION_KEY', 'rank_ai.session' );
}

if ( ! defined( 'RANK_AI_REQUEST_KEY' ) ) {
	define( 'RANK_AI_REQUEST_KEY', 'rank_ai.request' );
}

if ( ! defined( 'RANK_AI_RESPONSE_KEY' ) ) {
	define( 'RANK_AI_RESPONSE_KEY', 'rank_ai.response' );
}

if ( ! defined( 'RANK_AI_EXCEPTIONS_ERROR_HANDLER_KEY' ) ) {
	define( 'RANK_AI_EXCEPTIONS_ERROR_HANDLER_KEY', 'rank_ai.exceptions.error_handler' );
}

if ( ! defined( 'RANK_AI_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY' ) ) {
	define( 'RANK_AI_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY', 'rank_ai.exceptions.configuration_error_handler' );
}

if ( ! defined( 'RANK_AI_RESPONSE_SERVICE_KEY' ) ) {
	define( 'RANK_AI_RESPONSE_SERVICE_KEY', 'rank_ai.responses.response_service' );
}

if ( ! defined( 'RANK_AI_ROUTING_ROUTER_KEY' ) ) {
	define( 'RANK_AI_ROUTING_ROUTER_KEY', 'rank_ai.routing.router' );
}

if ( ! defined( 'RANK_AI_ROUTING_ROUTE_BLUEPRINT_KEY' ) ) {
	define( 'RANK_AI_ROUTING_ROUTE_BLUEPRINT_KEY', 'rank_ai.routing.route_registrar' );
}

if ( ! defined( 'RANK_AI_ROUTING_CONDITIONS_CONDITION_FACTORY_KEY' ) ) {
	define( 'RANK_AI_ROUTING_CONDITIONS_CONDITION_FACTORY_KEY', 'rank_ai.routing.conditions.condition_factory' );
}

if ( ! defined( 'RANK_AI_ROUTING_CONDITION_TYPES_KEY' ) ) {
	define( 'RANK_AI_ROUTING_CONDITION_TYPES_KEY', 'rank_ai.routing.conditions.condition_types' );
}

if ( ! defined( 'RANK_AI_VIEW_SERVICE_KEY' ) ) {
	define( 'RANK_AI_VIEW_SERVICE_KEY', 'rank_ai.view.view_service' );
}

if ( ! defined( 'RANK_AI_VIEW_COMPOSE_ACTION_KEY' ) ) {
	define( 'RANK_AI_VIEW_COMPOSE_ACTION_KEY', 'rank_ai.view.view_compose_action' );
}

if ( ! defined( 'RANK_AI_VIEW_ENGINE_KEY' ) ) {
	define( 'RANK_AI_VIEW_ENGINE_KEY', 'rank_ai.view.view_engine' );
}

if ( ! defined( 'RANK_AI_VIEW_PHP_VIEW_ENGINE_KEY' ) ) {
	define( 'RANK_AI_VIEW_PHP_VIEW_ENGINE_KEY', 'rank_ai.view.php_view_engine' );
}

if ( ! defined( 'RANK_AI_SERVICE_PROVIDERS_KEY' ) ) {
	define( 'RANK_AI_SERVICE_PROVIDERS_KEY', 'rank_ai.service_providers' );
}

if ( ! defined( 'RANK_AI_FLASH_KEY' ) ) {
	define( 'RANK_AI_FLASH_KEY', 'rank_ai.flash.flash' );
}

if ( ! defined( 'RANK_AI_OLD_INPUT_KEY' ) ) {
	define( 'RANK_AI_OLD_INPUT_KEY', 'rank_ai.old_input.old_input' );
}

if ( ! defined( 'RANK_AI_CSRF_KEY' ) ) {
	define( 'RANK_AI_CSRF_KEY', 'rank_ai.csrf.csrf' );
}
