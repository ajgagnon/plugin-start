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
			'Rank AI',
			'Rank AI',
			'manage_options',
			'rank-ai',
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
