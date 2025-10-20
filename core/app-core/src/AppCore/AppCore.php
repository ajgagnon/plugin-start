<?php
/**
 * @package   SureCartAppCore
 * @author    SureCart <support@surecart.com>
 * @copyright  SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com
 */

namespace AndreBaseAppCore\AppCore;

use AndreBaseCore\Application\Application;

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
	 * Shortcut to \AndreBaseAppCore\Assets\Assets.
	 *
	 * @return \AndreBaseAppCore\Assets\Assets
	 */
	public function assets() {
		return $this->app->resolve( 'surecart_app_core.assets.assets' );
	}

	/**
	 * Shortcut to \AndreBaseAppCore\Avatar\Avatar.
	 *
	 * @return \AndreBaseAppCore\Avatar\Avatar
	 */
	public function avatar() {
		return $this->app->resolve( 'surecart_app_core.avatar.avatar' );
	}

	/**
	 * Shortcut to \AndreBaseAppCore\Config\Config.
	 *
	 * @return \AndreBaseAppCore\Config\Config
	 */
	public function config() {
		return $this->app->resolve( 'surecart_app_core.config.config' );
	}

	/**
	 * Shortcut to \AndreBaseAppCore\Image\Image.
	 *
	 * @return \AndreBaseAppCore\Image\Image
	 */
	public function image() {
		return $this->app->resolve( 'surecart_app_core.image.image' );
	}

	/**
	 * Shortcut to \AndreBaseAppCore\Sidebar\Sidebar.
	 *
	 * @return \AndreBaseAppCore\Sidebar\Sidebar
	 */
	public function sidebar() {
		return $this->app->resolve( 'surecart_app_core.sidebar.sidebar' );
	}
}
