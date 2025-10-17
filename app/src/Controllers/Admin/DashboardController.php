<?php

namespace RankAI\Controllers\Admin;

/**
 * Dashboard controller.
 */
class DashboardController {
	/**
	 * Index action.
	 *
	 * @return string
	 */
	public function index() {
		// Enqueue scripts.
		$asset_file = include trailingslashit( \RankAI\RankAI::core()->assets()->getPath() ) . 'build/index.asset.php';
		wp_enqueue_script(
			'rank-ai-admin',
			trailingslashit( \RankAI\RankAI::core()->assets()->getUrl() ) . 'build/index.js',
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		return '<div id="app" class="rank-ai"></div>';
	}
}
