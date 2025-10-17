<?php

namespace RankAI\Middleware;

use Closure;
use RankAICore\Requests\RequestInterface;

/**
 * Middleware for handling model archiving.
 */
class AdminPageMiddleware {

	/**
	 * Enqueue component assets.
	 *
	 * @param RequestInterface $request Request.
	 * @param Closure          $next Next.
	 * @return function
	 */
	public function handle( RequestInterface $request, Closure $next ) {
		// Enqueue scripts.
		$dashboard_asset_file = include trailingslashit( \RankAI\RankAI::core()->assets()->getPath() ) . 'build/index.asset.php';
		wp_enqueue_script(
			'rank-ai-admin',
			trailingslashit( \RankAI\RankAI::core()->assets()->getUrl() ) . 'build/index.js',
			$dashboard_asset_file['dependencies'],
			$dashboard_asset_file['version'],
			true
		);

		$dashboard_style_asset_file = include trailingslashit( \RankAI\RankAI::core()->assets()->getPath() ) . 'build/admin.scss.asset.php';
		wp_enqueue_style(
			'rank-ai-admin-style',
			trailingslashit( \RankAI\RankAI::core()->assets()->getUrl() ) . 'build/index.css',
			$dashboard_style_asset_file['dependencies'],
			$dashboard_style_asset_file['version']
		);

		return $next( $request );
	}
}
