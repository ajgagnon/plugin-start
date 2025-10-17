<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace RankAICore\Flash;

use RankAICore\ServiceProviders\ServiceProviderInterface;
use RankAICore\Session\Session;

/**
 * Provide flash dependencies.
 *
 * @codeCoverageIgnore
 */
class FlashServiceProvider implements ServiceProviderInterface {
	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		global $sc_session;
		$sc_session = [];

		$container[ RANK_AI_FLASH_KEY ] = function ( $c ) use ( $sc_session ) {
			$session = null;
			if ( isset( $c[ RANK_AI_SESSION_KEY ] ) ) {
				$session = &$c[ RANK_AI_SESSION_KEY ];
			} else {
				$session = &$sc_session;
			}
			return new Flash( $session );
		};

		$container[ FlashMiddleware::class ] = function ( $c ) {
			return new FlashMiddleware( $c[ RANK_AI_FLASH_KEY ] );
		};

		$app = $container[ RANK_AI_APPLICATION_KEY ];
		$app->alias( 'flash', RANK_AI_FLASH_KEY );
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		// Nothing to bootstrap.
	}
}
