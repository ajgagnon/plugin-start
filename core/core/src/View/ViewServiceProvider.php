<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace RankAICore\View;

use RankAIVendors\Pimple\Container;
use RankAICore\Helpers\MixedType;
use RankAICore\ServiceProviders\ExtendsConfigTrait;
use RankAICore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide view dependencies
 *
 * @codeCoverageIgnore
 */
class ViewServiceProvider implements ServiceProviderInterface {
	use ExtendsConfigTrait;

	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		/** @var Container $container */
		$this->extendConfig( $container, 'views', [ get_stylesheet_directory(), get_template_directory() ] );

		$this->extendConfig(
			$container,
			'view_composers',
			[
				'namespace' => 'App\\ViewComposers\\',
			]
		);

		$container[ RANKAI_VIEW_SERVICE_KEY ] = function ( $c ) {
			return new ViewService(
				$c[ RANKAI_CONFIG_KEY ]['view_composers'],
				$c[ RANKAI_VIEW_ENGINE_KEY ],
				$c[ RANKAI_HELPERS_HANDLER_FACTORY_KEY ]
			);
		};

		$container[ RANKAI_VIEW_COMPOSE_ACTION_KEY ] = function ( $c ) {
			return function ( ViewInterface $view ) use ( $c ) {
				$view_service = $c[ RANKAI_VIEW_SERVICE_KEY ];
				$view_service->compose( $view );
				return $view;
			};
		};

		$container[ RANKAI_VIEW_PHP_VIEW_ENGINE_KEY ] = function ( $c ) {
			$finder = new PhpViewFilesystemFinder( MixedType::toArray( $c[ RANKAI_CONFIG_KEY ]['views'] ) );
			return new PhpViewEngine( $c[ RANKAI_VIEW_COMPOSE_ACTION_KEY ], $finder );
		};

		$container[ RANKAI_VIEW_ENGINE_KEY ] = function ( $c ) {
			return $c[ RANKAI_VIEW_PHP_VIEW_ENGINE_KEY ];
		};

		$app = $container[ RANKAI_APPLICATION_KEY ];
		$app->alias( 'views', RANKAI_VIEW_SERVICE_KEY );

		$app->alias(
			'view',
			function () use ( $app ) {
				return call_user_func_array( [ $app->views(), 'make' ], func_get_args() );
			}
		);

		$app->alias(
			'render',
			function () use ( $app ) {
				return call_user_func_array( [ $app->views(), 'render' ], func_get_args() );
			}
		);

		$app->alias(
			'layoutContent',
			function () use ( $app ) {
				/** @var PhpViewEngine $engine */
				$engine = $app->resolve( RANKAI_VIEW_PHP_VIEW_ENGINE_KEY );

				echo $engine->getLayoutContent();
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
