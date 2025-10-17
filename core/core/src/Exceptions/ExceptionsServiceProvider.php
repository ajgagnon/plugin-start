<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace RankAICore\Exceptions;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use RankAICore\Exceptions\Whoops\DebugDataProvider;
use RankAICore\ServiceProviders\ExtendsConfigTrait;
use RankAICore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide exceptions dependencies.
 *
 * @codeCoverageIgnore
 */
class ExceptionsServiceProvider implements ServiceProviderInterface {
	use ExtendsConfigTrait;

	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$this->extendConfig(
			$container,
			'debug',
			[
				'enable'        => true,
				'pretty_errors' => true,
			]
		);

		$container[ DebugDataProvider::class ] = function ( $container ) {
			return new DebugDataProvider( $container );
		};

		$container[ PrettyPageHandler::class ] = function ( $container ) {
			$handler = new PrettyPageHandler();
			$handler->addResourcePath( implode( DIRECTORY_SEPARATOR, [ RANK_AI_DIR, 'src', 'Exceptions', 'Whoops' ] ) );

			$handler->addDataTableCallback(
				'WP Emerge: Route',
				function ( $inspector ) use ( $container ) {
					return $container[ DebugDataProvider::class ]->route( $inspector );
				}
			);

			return $handler;
		};

		$container[ Run::class ] = function ( $container ) {
			if ( ! class_exists( Run::class ) ) {
				return null;
			}

			$run = new Run();
			$run->allowQuit( false );

			$handler = $container[ PrettyPageHandler::class ];

			if ( $handler ) {
				$run->pushHandler( $handler );
			}

			return $run;
		};

		$container[ RANK_AI_EXCEPTIONS_ERROR_HANDLER_KEY ] = function ( $container ) {
			$debug  = $container[ RANK_AI_CONFIG_KEY ]['debug'];
			$whoops = $debug['pretty_errors'] ? $container[ Run::class ] : null;
			return new ErrorHandler( $container[ RANK_AI_RESPONSE_SERVICE_KEY ], $whoops, $debug['enable'] );
		};

		$container[ RANK_AI_EXCEPTIONS_CONFIGURATION_ERROR_HANDLER_KEY ] = function ( $container ) {
			$debug  = $container[ RANK_AI_CONFIG_KEY ]['debug'];
			$whoops = $debug['pretty_errors'] ? $container[ Run::class ] : null;
			return new ErrorHandler( $container[ RANK_AI_RESPONSE_SERVICE_KEY ], $whoops, $debug['enable'] );
		};
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		// Nothing to bootstrap.
	}
}
