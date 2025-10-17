<?php
/**
 * @package   SureCartAppCore
 * @author    SureCart <support@surecart.com>
 * @copyright  SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com
 */

namespace RankAIAppCore\AppCore;

use RankAICore\ServiceProviders\ExtendsConfigTrait;
use RankAICore\ServiceProviders\ServiceProviderInterface;

/**
 * Provide theme dependencies.
 *
 * @codeCoverageIgnore
 */
class AppCoreServiceProvider implements ServiceProviderInterface {
	use ExtendsConfigTrait;

	/**
	 * {@inheritDoc}
	 */
	public function register( $container ) {
		$this->extendConfig(
			$container,
			'app_core',
			[
				'path' => '',
				'url'  => '',
			]
		);

		$container['rank_ai_app_core.app_core.app_core'] = function( $c ) {
			return new AppCore( $c[ RANK_AI_APPLICATION_KEY ] );
		};

		$app = $container[ RANK_AI_APPLICATION_KEY ];
		$app->alias( 'core', 'rank_ai_app_core.app_core.app_core' );
	}

	/**
	 * {@inheritDoc}
	 */
	public function bootstrap( $container ) {
		// Nothing to bootstrap.
	}
}
