<?php
namespace AndreBase\Models;

use AndreBase\Models\Model;

/**
 * The integration model.
 */
class Event extends Model {
	/**
	 * The integrations table name.
	 *
	 * @var string
	 */
	protected $table_name = 'andre_base_events';

	/**
	 * The object name
	 *
	 * @var string
	 */
	protected $object_name = 'event';

	/**
	 * Fillable items.
	 *
	 * @var array
	 */
	protected $fillable = [ 'id', 'type', 'session_id', 'data', 'user_id', 'timestamp' ];

	/**
	 * Get the data attribute, decoding JSON if needed.
	 *
	 * @param string $value The raw value from database.
	 *
	 * @return mixed
	 */
	public function getDataAttribute( $value ) {
		if ( is_string( $value ) ) {
			$decoded = json_decode( $value, true );
			return ( null !== $decoded ) ? $decoded : $value;
		}
		return $value;
	}

	/**
	 * Set the data attribute, encoding to JSON if needed.
	 *
	 * @param mixed $value The value to set.
	 *
	 * @return void
	 */
	public function setDataAttribute( $value ) {
		$this->attributes['data'] = is_array( $value ) || is_object( $value )
			? wp_json_encode( $value )
			: $value;
	}
}
