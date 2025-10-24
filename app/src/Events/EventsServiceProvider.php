<?php

namespace AndreBase\Events;

use AndreBase\Models\Event;
use AndreBase\Observers\EventObserver;
use AndreBaseCore\ServiceProviders\ServiceProviderInterface;

/**
 * Register the event observer.
 */
class EventsServiceProvider implements ServiceProviderInterface {
	/**
	 * Register the event observer.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function register( $container ) {
		// Register the event observer.
		Event::observe( EventObserver::class );
	}

	/**
	 * Bootstrap any services if needed.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function bootstrap( $container ) {
		// Bootstrap any services if needed.
	}
}
