<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace AndreBaseCore\Application;

use AndreBaseCore\Helpers\HandlerFactory;
use AndreBaseCore\Helpers\MixedType;
use AndreBaseCore\ServiceProviders\ExtendsConfigTrait;
use AndreBaseCore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide application dependencies.
 *
 * @codeCoverageIgnore
 */
class ApplicationServiceProvider implements ServiceProviderInterface {
	use ExtendsConfigTrait;

	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$this->extendConfig( $container, 'providers', [] );

		$upload_dir = wp_upload_dir();
		$cache_dir  = MixedType::addTrailingSlash( $upload_dir['basedir'] ) . 'surecart' . DIRECTORY_SEPARATOR . 'cache';
		$this->extendConfig(
			$container,
			'cache',
			[
				'path' => $cache_dir,
			]
		);

		$container[ ANDREBASE_APPLICATION_GENERIC_FACTORY_KEY ] = function ( $c ) {
			return new GenericFactory( $c );
		};

		$container[ ANDREBASE_APPLICATION_CLOSURE_FACTORY_KEY ] = function ( $c ) {
			return new ClosureFactory( $c[ ANDREBASE_APPLICATION_GENERIC_FACTORY_KEY ] );
		};

		$container[ ANDREBASE_HELPERS_HANDLER_FACTORY_KEY ] = function ( $c ) {
			return new HandlerFactory( $c[ ANDREBASE_APPLICATION_GENERIC_FACTORY_KEY ] );
		};

		$app = $container[ ANDREBASE_APPLICATION_KEY ];
		$app->alias( 'app', ANDREBASE_APPLICATION_KEY );
		$app->alias( 'closure', ANDREBASE_APPLICATION_CLOSURE_FACTORY_KEY );
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		$cache_dir = $container[ ANDREBASE_CONFIG_KEY ]['cache']['path'];
		wp_mkdir_p( $cache_dir );
	}
}
