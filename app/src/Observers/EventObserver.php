<?php
/**
 * Example Event Observer
 *
 * This is an example of how to create a Laravel-style model observer.
 * Rename this file to EventObserver.php and customize as needed.
 *
 * @package AndreBase
 */

namespace AndreBase\Observers;

use AndreBase\Models\Event;

/**
 * Event Observer
 *
 * Handles all Event model lifecycle events in one organized class.
 *
 * Usage:
 * Event::observe(EventObserver::class);
 */
class EventObserver {
	/**
	 * Handle the Event "creating" event.
	 * Called before a new event is inserted into the database.
	 *
	 * @param Event $event The event model.
	 * @return bool|void Return false to cancel creation.
	 */
	public function creating( Event $event ) {
		if ( empty( $event->user_id ) ) {
			$event->user_id = (int) get_current_user_id();
		}
	}

	/**
	 * Handle the Event "updating" event.
	 * Called before an existing event is updated in the database.
	 *
	 * @param Event $event The event model.
	 * @return bool|void Return false to cancel update.
	 */
	public function updating( Event $event ) {
		$event->updated_at = current_time( 'mysql' );
	}
}
