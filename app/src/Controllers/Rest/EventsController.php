<?php

namespace AndreBase\Controllers\Rest;

use AndreBase\Models\Event;

/**
 * Events controller.
 */
class EventsController {
	/**
	 * Find model.
	 *
	 * @param \WP_REST_Request $request Rest Request.
	 *
	 * @return \Model|\WP_Error
	 */
	public function find( \WP_REST_Request $request ) {
		return Event::find( (int) $request->get_param( 'id' ) );
	}

	/**
	 * Index model.
	 *
	 * @param \WP_REST_Request $request Rest Request.
	 *
	 * @return \Model[]|\WP_Error
	 */
	public function index( \WP_REST_Request $request ) {
		$event = new Event();

		// order by. Default to created_at DESC.
		if ( $request->get_param( 'order_by' ) ) {
			$event->order_by( $request->get_param( 'order_by' ), $request->get_param( 'order' ) );
		}

		// handle session id.
		if ( $request->get_param( 'session_id' ) ) {
			$event->where( 'session_id', $request->get_param( 'session_id' ) );
		}

		// handle user id.
		if ( $request->get_param( 'user_id' ) ) {
			$event->where( 'user_id', $request->get_param( 'user_id' ) );
		}

		if ( $request->get_param( 'page' ) && $request->get_param( 'per_page' ) ) {
			$event->setPagination(
				[
					'page'     => $request->get_param( 'page' ),
					'per_page' => $request->get_param( 'per_page' ),
				]
			);
		}

		return $event->get();
	}

	/**
	 * Create model.
	 *
	 * @param \WP_REST_Request $request Rest Request.
	 *
	 * @return array|\WP_Error
	 */
	public function create( \WP_REST_Request $request ) {
		$events     = $request->get_param( 'events' );
		$session_id = $request->get_param( 'session_id' );

		if ( empty( $events ) || ! is_array( $events ) ) {
			return new \WP_Error( 'invalid_events', 'Events parameter must be a non-empty array', [ 'status' => 400 ] );
		}

		// Use bulk insert for performance.
		return $this->bulk_insert_events( $events, $session_id );
	}

	/**
	 * Bulk insert events for performance.
	 *
	 * @param array  $events     Array of events to insert.
	 * @param string $session_id Session ID.
	 *
	 * @return array|\WP_Error
	 */
	private function bulk_insert_events( $events, $session_id ) {
		global $wpdb;

		$table_name = $wpdb->prefix . 'andre_base_events';

		$values       = [];
		$placeholders = [];

		foreach ( $events as $event ) {
			$event = new Event( $event );
			$event->fireModelEvent( 'creating' );

			if ( empty( $event->type ) ) {
				continue;
			}

			// Encode data as JSON if it's an array or object.
			$data = is_array( $event->data ) || is_object( $event->data )
				? wp_json_encode( $event->data )
				: $event->data;

			$values[]       = $event->type;
			$values[]       = $session_id;
			$values[]       = $data;
			$values[]       = $event->user_id;
			$values[]       = $event->timestamp;
			$placeholders[] = '(%s, %s, %s, %d, %s)';
		}

		if ( empty( $placeholders ) ) {
			return new \WP_Error( 'no_valid_events', 'No valid events to insert', [ 'status' => 400 ] );
		}

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$query = "INSERT INTO `{$table_name}` 
			(type, session_id, data, user_id, timestamp) 
			VALUES " . implode( ', ', $placeholders );

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$result = $wpdb->query( $wpdb->prepare( $query, $values ) );

		if ( false === $result ) {
			return new \WP_Error(
				'bulk_insert_failed',
				'Failed to insert events: ' . $wpdb->last_error,
				[ 'status' => 500 ]
			);
		}

		foreach ( $events as $event ) {
			$event = new Event( $event );
			$event->fireModelEvent( 'created' );
		}

		return [
			'success'      => true,
			'events_added' => $result,
		];
	}

	/**
	 * Update model.
	 *
	 * @param \WP_REST_Request $request Rest Request.
	 *
	 * @return \AndreBase\Models\Event|\WP_Error
	 */
	public function update( \WP_REST_Request $request ) {
		return Event::update( $request->get_json_params() );
	}

	/**
	 * Delete model.
	 *
	 * @param \WP_REST_Request $request Rest Request.
	 *
	 * @return \AndreBase\Models\Event|\WP_Error
	 */
	public function delete( \WP_REST_Request $request ) {
		return Event::delete( $request->get_param( 'id' ) );
	}
}
