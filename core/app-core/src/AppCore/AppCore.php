<?php
/**
 * @package   SureCartAppCore
 * @author    SureCart <support@surecart.com>
 * @copyright  SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com
 */

namespace RankAIAppCore\AppCore;

use RankAICore\Application\Application;

/**
 * Main communication channel with the theme.
 */
class AppCore {
	/**
	 * Application instance.
	 *
	 * @var Application
	 */
	protected $app = null;

	/**
	 * Constructor.
	 *
	 * @param Application $app
	 */
	public function __construct( $app ) {
		$this->app = $app;
	}

	/**
	 * Shortcut to \RankAIAppCore\Assets\Assets.
	 *
	 * @return \RankAIAppCore\Assets\Assets
	 */
	public function assets() {
		return $this->app->resolve( 'surecart_app_core.assets.assets' );
	}

	/**
	 * Shortcut to \RankAIAppCore\Avatar\Avatar.
	 *
	 * @return \RankAIAppCore\Avatar\Avatar
	 */
	public function avatar() {
		return $this->app->resolve( 'surecart_app_core.avatar.avatar' );
	}

	/**
	 * Shortcut to \RankAIAppCore\Config\Config.
	 *
	 * @return \RankAIAppCore\Config\Config
	 */
	public function config() {
		return $this->app->resolve( 'surecart_app_core.config.config' );
	}

	/**
	 * Shortcut to \RankAIAppCore\Image\Image.
	 *
	 * @return \RankAIAppCore\Image\Image
	 */
	public function image() {
		return $this->app->resolve( 'surecart_app_core.image.image' );
	}

	/**
	 * Shortcut to \RankAIAppCore\Sidebar\Sidebar.
	 *
	 * @return \RankAIAppCore\Sidebar\Sidebar
	 */
	public function sidebar() {
		return $this->app->resolve( 'surecart_app_core.sidebar.sidebar' );
	}
}
