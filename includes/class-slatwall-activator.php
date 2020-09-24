<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * Fired during slatwall activation
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */

/**
 * Fired during slatwall activation.
 *
 * This class defines all code necessary to run during the slatwall's activation.
 *
 * @since      1.0.0
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */
class Slatwall_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

            global $table_prefix, $wpdb;

    $tblname = 'slatwall_login';
    $wp_track_table = $table_prefix . "$tblname";
    $charset_collate = $wpdb->get_charset_collate();
    #Check to see if the table exists already, if not, then create it

    if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table)
    {

        $sql = "CREATE TABLE $wp_track_table (
                id int(11) NOT NULL auto_increment,
                domain varchar(200) NOT NULL,
                access_key varchar(200) NOT NULL,
                access_key_secret varchar(200) NOT NULL,
                token text NOT NULL,
                `status`  ENUM('0', '1') DEFAULT '0',
                UNIQUE KEY id (id)
        ) $charset_collate;";


        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

	}

}
