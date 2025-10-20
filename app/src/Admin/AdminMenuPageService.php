<?php

namespace RankAI\Admin;

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
			_x( 'Dashboard', 'admin menu page title', 'rank-ai' ),
			_x( 'Rank AI', 'admin menu page title', 'rank-ai' ),
			'manage_options',
			'rank-ai',
			'__return_false'
		);

		add_submenu_page(
			'rank-ai',
			_x( 'Settings', 'admin menu page title', 'rank-ai' ),
			_x( 'Settings', 'admin menu page title', 'rank-ai' ),
			'manage_options',
			'rank-ai-settings',
			'__return_false'
		);
	}

	/**
	 * Render the admin page.
	 */
	public function render_admin_page() {
		echo '<div>Hello World</div>';
	}
}
