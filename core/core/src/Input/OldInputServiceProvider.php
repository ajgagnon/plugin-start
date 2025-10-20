<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace RankAICore\Input;

use RankAICore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide old input dependencies.
 *
 * @codeCoverageIgnore
 */
class OldInputServiceProvider implements ServiceProviderInterface {
	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$container[ RANKAI_OLD_INPUT_KEY ] = function ( $c ) {
			return new OldInput( $c[ RANKAI_FLASH_KEY ] );
		};

		$container[ OldInputMiddleware::class ] = function ( $c ) {
			return new OldInputMiddleware( $c[ RANKAI_OLD_INPUT_KEY ] );
		};

		$app = $container[ RANKAI_APPLICATION_KEY ];
		$app->alias( 'oldInput', RANKAI_OLD_INPUT_KEY );
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		// Nothing to bootstrap.
	}
}
