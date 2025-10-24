<?php

namespace AndreBase\Database\Tables;

use AndreBase\Database\Table;

/**
 * The integrations table class.
 */
class Events {
	/**
	 * Holds the table instance.
	 *
	 * @var \SureCart\Database\Table
	 */
	protected $table;

	/**
	 * Version number for the table.
	 * Change this to update the table.
	 *
	 * @var integer
	 */
	protected $version = 1;

	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $name = 'andre_base_events';

	/**
	 * Get the table dependency.
	 *
	 * @param \SureCart\Database\Table $table The table dependency.
	 */
	public function __construct( Table $table ) {
		$this->table = $table;
	}

	/**
	 * Get the table name.
	 *
	 * @return string
	 */
	public function getName(): string {
		global $wpdb;
		return $wpdb->prefix . $this->name;
	}

	/**
	 * Add relationships custom table
	 * This allows for simple, efficient queries
	 *
	 * @return mixed
	 */
	public function install() {
		return $this->table->create(
			$this->name,
			'
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			session_id varchar(64) NOT NULL,
            type tinyint NOT NULL,
            data text NOT NULL,
            timestamp bigint(20) UNSIGNED NOT NULL,
            user_id bigint(20) UNSIGNED NOT NULL,
            PRIMARY KEY (id),
            INDEX session_idx (session_id, timestamp),
            INDEX timestamp_idx (timestamp),
            INDEX user_idx (user_id)
			',
			$this->version
		);
	}

	/**
	 * Uninstall tables
	 *
	 * @return boolean
	 */
	public function uninstall(): bool {
		return $this->table->drop( $this->getName() );
	}

	/**
	 * Does the table exist?
	 *
	 * @return boolean
	 */
	public function exists(): bool {
		return $this->table->exists( $this->name );
	}
}
