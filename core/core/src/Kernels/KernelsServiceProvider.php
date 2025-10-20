<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace AndreBaseCore\Kernels;

use AndreBaseCore\ServiceProviders\ExtendsConfigTrait;
use AndreBaseCore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide old input dependencies.
 *
 * @codeCoverageIgnore
 */
class KernelsServiceProvider implements ServiceProviderInterface {
	use ExtendsConfigTrait;

	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$this->extendConfig(
			$container,
			'middleware',
			[
				'flash'           => \AndreBaseCore\Flash\FlashMiddleware::class,
				'old_input'       => \AndreBaseCore\Input\OldInputMiddleware::class,
				'csrf'            => \AndreBaseCore\Csrf\CsrfMiddleware::class,
				'user.logged_in'  => \AndreBaseCore\Middleware\UserLoggedInMiddleware::class,
				'user.logged_out' => \AndreBaseCore\Middleware\UserLoggedOutMiddleware::class,
				'user.can'        => \AndreBaseCore\Middleware\UserCanMiddleware::class,
			]
		);

		$this->extendConfig(
			$container,
			'middleware_groups',
			[
				'surecart' => [
					'flash',
					'old_input',
				],
				'global'   => [],
				'web'      => [],
				'ajax'     => [],
				'admin'    => [],
			]
		);

		$this->extendConfig( $container, 'middleware_priority', [] );

		$container[ ANDREBASE_WORDPRESS_HTTP_KERNEL_KEY ] = function ( $c ) {
			$kernel = new HttpKernel(
				$c,
				$c[ ANDREBASE_APPLICATION_GENERIC_FACTORY_KEY ],
				$c[ ANDREBASE_HELPERS_HANDLER_FACTORY_KEY ],
				$c[ ANDREBASE_RESPONSE_SERVICE_KEY ],
				$c[ ANDREBASE_REQUEST_KEY ],
				$c[ ANDREBASE_ROUTING_ROUTER_KEY ],
				$c[ ANDREBASE_VIEW_SERVICE_KEY ],
				$c[ ANDREBASE_EXCEPTIONS_ERROR_HANDLER_KEY ]
			);

			$kernel->setMiddleware( $c[ ANDREBASE_CONFIG_KEY ]['middleware'] );
			$kernel->setMiddlewareGroups( $c[ ANDREBASE_CONFIG_KEY ]['middleware_groups'] );
			$kernel->setMiddlewarePriority( $c[ ANDREBASE_CONFIG_KEY ]['middleware_priority'] );

			return $kernel;
		};

		$app = $container[ ANDREBASE_APPLICATION_KEY ];

		$app->alias(
			'run',
			function () use ( $app ) {
				$kernel = $app->resolve( ANDREBASE_WORDPRESS_HTTP_KERNEL_KEY );
				return call_user_func_array( [ $kernel, 'run' ], func_get_args() );
			}
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		// Nothing to bootstrap.
	}
}
