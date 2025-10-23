<?php

namespace AndreBase\Front;

use AndreBaseCore\ServiceProviders\ServiceProviderInterface;

/**
 * Frontend service provider.
 */
class FrontServiceProvider implements ServiceProviderInterface {
	/**
	 * Register all dependencies in the IoC container.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function register( $container ) {
		$container['front'] = fn() => new FrontService();
	}

	/**
	 * Bootstrap any services if needed.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function bootstrap( $container ) {
		$container['front']->bootstrap();
	}
}
