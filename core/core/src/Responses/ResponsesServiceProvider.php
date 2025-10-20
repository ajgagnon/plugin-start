<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace RankAICore\Responses;

use RankAICore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide responses dependencies.
 *
 * @codeCoverageIgnore
 */
class ResponsesServiceProvider implements ServiceProviderInterface {
	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$container[ RANKAI_RESPONSE_SERVICE_KEY ] = function ( $c ) {
			return new ResponseService( $c[ RANKAI_REQUEST_KEY ], $c[ RANKAI_VIEW_SERVICE_KEY ] );
		};

		$app = $container[ RANKAI_APPLICATION_KEY ];
		$app->alias( 'responses', RANKAI_RESPONSE_SERVICE_KEY );

		$app->alias(
			'response',
			function () use ( $app ) {
				return call_user_func_array( [ $app->responses(), 'response' ], func_get_args() );
			}
		);

		$app->alias(
			'output',
			function () use ( $app ) {
				return call_user_func_array( [ $app->responses(), 'output' ], func_get_args() );
			}
		);

		$app->alias(
			'json',
			function () use ( $app ) {
				return call_user_func_array( [ $app->responses(), 'json' ], func_get_args() );
			}
		);

		$app->alias(
			'redirect',
			function () use ( $app ) {
				return call_user_func_array( [ $app->responses(), 'redirect' ], func_get_args() );
			}
		);

		$app->alias(
			'error',
			function () use ( $app ) {
				return call_user_func_array( [ $app->responses(), 'error' ], func_get_args() );
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
