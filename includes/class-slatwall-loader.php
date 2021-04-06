<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * Register all actions and filters for the slatwall
 *
 * @link       https://www.slatwallcommerce.com/
 * @since      1.0.0
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */

/**
 * Register all actions and filters for the slatwall.
 *
 * Maintain a list of all hooks that are registered throughout
 * the slatwall, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Slatwall_Ecommerce
 * @subpackage Slatwall_Ecommerce/includes
 */
class Slatwall_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the slatwall loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the slatwall loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */

        protected $shortcodes;


        public function __construct() {

		$this->actions = array();
		$this->filters = array();
                $this->shortcodes = array();

	}

	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

    public function add_shortcode( $tag, $component, $callback, $priority = 10, $accepted_args = 2 ) {
        $this->shortcodes = $this->add( $this->shortcodes, $tag, $component, $callback, $priority, $accepted_args );
    }


	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}



	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

                foreach ( $this->shortcodes as $hook ) {
			add_shortcode( $hook['hook'], array( $hook['component'], $hook['callback'] ));
		}


	}




}
