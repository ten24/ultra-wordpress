<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this slatwall
 * so that it is ready for translation.
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this slatwall
 * so that it is ready for translation.
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 * @author     Yash <raj.yash@orangemantra.in>
 */
class Slatwall_i18n {


	/**
	 * Load the slatwall text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_slatwall_textdomain() {

		load_slatwall_textdomain(
			'slatwall',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
