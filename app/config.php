<?php
/**
 * Configuration. Based on WPEmerge config:
 *
 * @link https://docs.wpemerge.com/#/framework/configuration
 *
 * @package AndreBase
 */

return array(
	/**
	 * Array of service providers you wish to enable.
	 */
	'providers'              => array(
		// app core.
		\AndreBaseAppCore\AppCore\AppCoreServiceProvider::class,
		\AndreBaseAppCore\Config\ConfigServiceProvider::class,
		\AndreBaseAppCore\Assets\AssetsServiceProvider::class,

		// admin/front.
		\AndreBase\Admin\AdminServiceProvider::class,
		\AndreBase\Front\FrontServiceProvider::class,

		// database.
		\AndreBase\Database\MigrationsServiceProvider::class,

		// events.
		\AndreBase\Events\EventsServiceProvider::class,

		// rest.
		\AndreBase\Rest\RestEventsServiceProvider::class,
	),

	/**
	* Permission Controllers
	*/
	'permission_controllers' => array(),

	/**
	 * Array of route group definitions and default attributes.
	 * All of these are optional so if we are not using
	 * a certain group of routes we can skip it.
	 * If we are not using routing at all we can skip
	 * the entire 'routes' option.
	 */
	'routes'                 => array(
		'web'   => array(
			'definitions' => __DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php',
			'attributes'  => array(
				'namespace' => 'AndreBase\\Controllers\\Web\\',
			),
		),
		'admin' => array(
			'definitions' => __DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'admin.php',
			'attributes'  => array(
				'namespace' => 'AndreBase\\Controllers\\Admin\\',
			),
		),
		'ajax'  => array(
			'definitions' => __DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'ajax.php',
			'attributes'  => array(
				'namespace' => 'SureCart\\Controllers\\Ajax\\',
			),
		),
	),

	/**
	 * Register middleware class aliases.
	 * Use fully qualified middleware class names.
	 *
	 * Internal aliases that you should avoid overriding:
	 * - 'flash'
	 * - 'old_input'
	 * - 'csrf'
	 * - 'user.logged_in'
	 * - 'user.logged_out'
	 * - 'user.can'
	 */
	'middleware'             => array(
		'admin.page' => \AndreBase\Middleware\AdminPageMiddleware::class,
	),

	/**
	 * Register middleware groups.
	 * Use fully qualified middleware class names or registered aliases.
	 * There are a couple built-in groups that you may override:
	 * - 'web'      - Automatically applied to web routes.
	 * - 'admin'    - Automatically applied to admin routes.
	 * - 'ajax'     - Automatically applied to ajax routes.
	 * - 'global'   - Automatically applied to all of the above.
	 * - 'surecart' - Internal group applied the same way 'global' is.
	 *
	 * Warning: The 'surecart' group contains some internal SureCart core
	 * middleware which you should avoid overriding.
	 */
	'middleware_groups'      => array(
		'global' => array(),
		'web'    => array(),
		'ajax'   => array(),
		'admin'  => array(),
	),

	/**
	 * Optionally specify middleware execution order.
	 * Use fully qualified middleware class names.
	 */
	'middleware_priority'    => array(),

	/**
	 * Custom directories to search for views.
	 * Use absolute paths or leave blank to disable.
	 * Applies only to the default PhpViewEngine.
	 */
	'views'                  => array( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'views' ),

	/**
	 * App Core configuration.
	 */
	'app_core'               => array(
		'path' => dirname( __DIR__ ),
		'url'  => plugin_dir_url( ANDREBASE_PLUGIN_FILE ),
	),
);
