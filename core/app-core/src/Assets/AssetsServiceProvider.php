<?php
/**
 * @package   SureCartAppCore
 * @author    SureCart <support@surecart.com>
 * @copyright  SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com
 */

namespace RankAIAppCore\Assets;

use RankAICore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide assets dependencies.
 *
 * @codeCoverageIgnore
 */
class AssetsServiceProvider implements ServiceProviderInterface {
	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$container['surecart_app_core.assets.manifest'] = function( $c ) {
			return new Manifest( $c[ RANK_AI_CONFIG_KEY ]['app_core']['path'] );
		};

		$container['surecart_app_core.assets.assets'] = function( $container ) {
			return new Assets(
				$container[ RANK_AI_CONFIG_KEY ]['app_core']['path'],
				$container[ RANK_AI_CONFIG_KEY ]['app_core']['url'],
				$container['surecart_app_core.config.config'],
				$container['surecart_app_core.assets.manifest']
			);
		};
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		// Nothing to bootstrap.
	}
}
