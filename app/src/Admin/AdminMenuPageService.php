<?php

namespace AndreBase\Admin;

/**
 * Handles creation and enqueueing of admin menu pages and assets.
 */
class AdminMenuPageService {
	/**
	 * Bootstrap the admin menu page service.
	 */
	public function bootstrap() {
		add_action( 'admin_menu', array( $this, 'register_admin_pages' ) );
	}

	/**
	 * Register admin pages.
	 */
	public function register_admin_pages() {
		add_menu_page(
			_x( 'Dashboard', 'admin menu page title', 'andre-base' ),
			_x( 'Rank AI', 'admin menu page title', 'andre-base' ),
			'manage_options',
			'andre-base',
			'__return_false'
		);

		add_submenu_page(
			'andre-base',
			_x( 'Settings', 'admin menu page title', 'andre-base' ),
			_x( 'Settings', 'admin menu page title', 'andre-base' ),
			'manage_options',
			'andre-base-settings',
			'__return_false'
		);
	}
}
