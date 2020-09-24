<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * Fired during slatwall deactivation
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */

/**
 * Fired during slatwall deactivation.
 *
 * This class defines all code necessary to run during the slatwall's deactivation.
 *
 * @since      1.0.0
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */
class Slatwall_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

             global $table_prefix, $wpdb;
    $wpdb->query( 'DROP TABLE IF EXISTS '.$table_prefix.'slatwall_login' );

	}

}
