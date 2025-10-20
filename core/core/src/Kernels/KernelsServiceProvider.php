<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace RankAICore\Kernels;

use RankAICore\ServiceProviders\ExtendsConfigTrait;
use RankAICore\ServiceProviders\ServiceProviderInterface;

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
				'flash'           => \RankAICore\Flash\FlashMiddleware::class,
				'old_input'       => \RankAICore\Input\OldInputMiddleware::class,
				'csrf'            => \RankAICore\Csrf\CsrfMiddleware::class,
				'user.logged_in'  => \RankAICore\Middleware\UserLoggedInMiddleware::class,
				'user.logged_out' => \RankAICore\Middleware\UserLoggedOutMiddleware::class,
				'user.can'        => \RankAICore\Middleware\UserCanMiddleware::class,
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

		$container[ RANKAI_WORDPRESS_HTTP_KERNEL_KEY ] = function ( $c ) {
			$kernel = new HttpKernel(
				$c,
				$c[ RANKAI_APPLICATION_GENERIC_FACTORY_KEY ],
				$c[ RANKAI_HELPERS_HANDLER_FACTORY_KEY ],
				$c[ RANKAI_RESPONSE_SERVICE_KEY ],
				$c[ RANKAI_REQUEST_KEY ],
				$c[ RANKAI_ROUTING_ROUTER_KEY ],
				$c[ RANKAI_VIEW_SERVICE_KEY ],
				$c[ RANKAI_EXCEPTIONS_ERROR_HANDLER_KEY ]
			);

			$kernel->setMiddleware( $c[ RANKAI_CONFIG_KEY ]['middleware'] );
			$kernel->setMiddlewareGroups( $c[ RANKAI_CONFIG_KEY ]['middleware_groups'] );
			$kernel->setMiddlewarePriority( $c[ RANKAI_CONFIG_KEY ]['middleware_priority'] );

			return $kernel;
		};

		$app = $container[ RANKAI_APPLICATION_KEY ];

		$app->alias(
			'run',
			function () use ( $app ) {
				$kernel = $app->resolve( RANKAI_WORDPRESS_HTTP_KERNEL_KEY );
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
