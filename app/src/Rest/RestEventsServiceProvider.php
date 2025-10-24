<?php

namespace AndreBase\Rest;

use AndreBase\Controllers\Rest\EventsController;

/**
 * Rest events service provider.
 */
class RestEventsServiceProvider extends RestServiceProvider {
	/**
	 * Endpoint.
	 *
	 * @var string
	 */
	protected $endpoint = 'events';

	/**
	 * Rest Controller
	 *
	 * @var string
	 */
	protected $controller = EventsController::class;

	/**
	 * Methods - exclude 'create' since we register it manually with custom args.
	 *
	 * @var array
	 */
	protected $methods = [ 'index', 'find', 'edit', 'delete' ];

	/**
	 * Register routes.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			"$this->namespace/v$this->version",
			"$this->endpoint",
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => $this->callback( $this->controller, 'index' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => $this->get_collection_params(),
				),
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => $this->callback( $this->controller, 'create' ),
					'permission_callback' => array( $this, 'create_item_permissions_check' ),
					'args'                => $this->get_create_params(),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);

		register_rest_route(
			"$this->namespace/v$this->version",
			"$this->endpoint/(?P<id>[\d]+)",
			array(
				'args'   => array(
					'id' => array(
						'description' => __( 'Unique identifier for the post.' ),
						'type'        => 'integer',
					),
				),
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => $this->callback( $this->controller, 'find' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => [
						'id' => [
							'description' => __( 'Unique identifier for the event.' ),
							'type'        => 'integer',
							'required'    => true,
						],
					],
				),
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => $this->callback( $this->controller, 'update' ),
					'permission_callback' => array( $this, 'update_item_permissions_check' ),
					'args'                => [
						'id' => [
							'description' => __( 'Unique identifier for the event.' ),
							'type'        => 'integer',
							'required'    => true,
						],
					],
				),
				array(
					'methods'             => \WP_REST_Server::DELETABLE,
					'callback'            => $this->callback( $this->controller, 'delete' ),
					'permission_callback' => array( $this, 'delete_item_permissions_check' ),
					'args'                => [
						'id' => [
							'description' => __( 'Unique identifier for the event.' ),
							'type'        => 'integer',
							'required'    => true,
						],
					],
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);
	}

	/**
	 * Get our sample schema for a post.
	 *
	 * @return array The sample schema for a post
	 */
	public function get_public_item_schema() {
		if ( $this->schema ) {
			// Since WordPress 5.3, the schema can be cached in the $schema property.
			return $this->schema;
		}

		$this->schema = [
			// This tells the spec of JSON Schema we are using which is draft 4.
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			// The title property marks the identity of the resource.
			'title'      => $this->endpoint,
			'type'       => 'object',
			// In JSON Schema you can specify object properties in the properties attribute.
			'properties' => [
				'id'         => [
					'description' => esc_html__( 'Unique identifier for the object.', 'surecart' ),
					'type'        => 'string',
					'context'     => [ 'view', 'edit', 'embed' ],
					'readonly'    => true,
				],
				'session_id' => [
					'description' => esc_html__( 'Session ID', 'andre-base' ),
					'type'        => 'string',
					'context'     => [ 'view', 'edit', 'embed' ],
					'readonly'    => true,
				],
				'events'     => [
					'description' => esc_html__( 'rrweb events array', 'andre-base' ),
					'type'        => 'array',
					'context'     => [ 'view', 'edit' ],
					'items'       => [
						'type'       => 'object',
						'properties' => [
							'type'      => [
								'description' => esc_html__( 'Event type (0-5)', 'andre-base' ),
								'type'        => 'integer',
							],
							'timestamp' => [
								'description' => esc_html__( 'Event timestamp in milliseconds', 'andre-base' ),
								'type'        => 'integer',
							],
							'data'      => [
								'description' => esc_html__( 'Event-specific data', 'andre-base' ),
								'type'        => 'object',
							],
						],
					],
				],
			],
		];

		return $this->schema;
	}

	/**
	 * Get the collection params for GET requests (filtering/querying).
	 *
	 * @return array
	 */
	public function get_collection_params() {
		return [
			'context'    => $this->get_context_param(),
			'page'       => array(
				'description'       => __( 'Current page of the collection.' ),
				'type'              => 'integer',
				'default'           => 1,
				'sanitize_callback' => 'absint',
				'validate_callback' => 'rest_validate_request_arg',
				'minimum'           => 1,
			),
			'per_page'   => array(
				'description'       => __( 'Maximum number of items to be returned in result set.' ),
				'type'              => 'integer',
				'default'           => 10,
				'minimum'           => 1,
				'maximum'           => 100,
				'sanitize_callback' => 'absint',
				'validate_callback' => 'rest_validate_request_arg',
			),
			'order_by'   => array(
				'description'       => __( 'Order by column.' ),
				'type'              => 'string',
				'default'           => 'created_at',
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => 'rest_validate_request_arg',
			),
			'order'      => array(
				'description'       => __( 'Order direction.' ),
				'type'              => 'string',
				'default'           => 'DESC',
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => 'rest_validate_request_arg',
			),
			'user_id'    => [
				'description'       => esc_html__( 'Filter by user ID.', 'andre-base' ),
				'type'              => 'integer',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'rest_validate_request_arg',
			],
			'session_id' => [
				'description'       => esc_html__( 'Filter by session ID.', 'andre-base' ),
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_key',
				'validate_callback' => function ( $param ) {
					// Validate session ID format: {timestamp}-{random}.
					if ( ! preg_match( '/^\d+-[a-z0-9]+$/', $param ) ) {
						return new \WP_Error(
							'invalid_session_id',
							esc_html__( 'Invalid session ID format.', 'andre-base' ),
							[ 'status' => 400 ]
						);
					}
					return true;
				},
			],
		];
	}

	/**
	 * Get the params for POST requests (creating events).
	 *
	 * @return array
	 */
	public function get_create_params() {
		return [
			'session_id' => [
				'required'          => true,
				'type'              => 'string',
				'description'       => esc_html__( 'Session ID for the recording.', 'andre-base' ),
				'sanitize_callback' => 'sanitize_key',
			],
			'events'     => [
				'required'          => true,
				'type'              => 'array',
				'description'       => esc_html__( 'Array of rrweb events.', 'andre-base' ),
				'sanitize_callback' => [ $this, 'sanitize_events' ],
			],
			'timestamp'  => [
				'type'              => 'integer',
				'description'       => esc_html__( 'Timestamp when events were collected.', 'andre-base' ),
				'sanitize_callback' => 'absint',
			],
		];
	}

	/**
	 * Register additional routes for this endpoint.
	 *
	 * @return void
	 */
	public function registerRoutes() {
		// Override the default create route to add custom args.
		register_rest_route(
			"$this->name/v$this->version",
			"$this->endpoint",
			[
				[
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => $this->callback( $this->controller, 'create' ),
					'permission_callback' => [ $this, 'create_item_permissions_check' ],
					'args'                => $this->get_create_params(),
				],
			]
		);
	}

	/**
	 * Sanitize rrweb events array.
	 *
	 * @param array $events Events array from rrweb.
	 * @return array Sanitized events array.
	 */
	public function sanitize_events( $events ) {
		// Sanitize each event, preserving JSON structure.
		return array_map(
			function ( $event ) {
				return [
					'type'      => (int) $event['type'],
					'timestamp' => (int) $event['timestamp'],
					'data'      => $event['data'], // Keep data as-is (JSON structure for replay).
				];
			},
			$events
		);
	}

	/**
	 * Anyone can create an event
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return true|\WP_Error True if the request has access to create items, WP_Error object otherwise.
	 */
	public function create_item_permissions_check( $request ) {
		return true;
	}

	/**
	 * Anyone can get a specific subscription
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return true|\WP_Error True if the request has access to create items, WP_Error object otherwise.
	 */
	public function get_item_permissions_check( $request ) {
		return current_user_can( 'edit_posts' );
	}

	/**
	 * Need priveleges to read checkout sessions.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return true|\WP_Error True if the request has access to create items, WP_Error object otherwise.
	 */
	public function get_items_permissions_check( $request ) {
		return current_user_can( 'edit_posts' );
	}

	/**
	 * Anyone can update.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return true|\WP_Error True if the request has access to create items, WP_Error object otherwise.
	 */
	public function update_item_permissions_check( $request ) {
		return current_user_can( 'edit_posts' );
	}

	/**
	 * Nobody can delete.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return false
	 */
	public function delete_item_permissions_check( $request ) {
		return current_user_can( 'edit_posts' );
	}
}
