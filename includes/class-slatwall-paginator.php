<?php
/*
 * Copyright © ten24, LLC Inc. All rights reserved.
 * See License.txt for license details.
 */

/**
 * Register all actions and filters for the Slatwall Commerce
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
class Paginator {

        private $_page;
        private $_pages;


        public function __construct($page,$pages ) {

    $this->_page = $page;
    $this->_pages = $pages;

}

public function createLinks( $links, $list_class ) {


    $html = '';
    if($this->_pages > 1){
    $last       = $this->_pages;

    $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
    $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
    $html       = '<nav class="py-2 col-lg-12 col-md-12 mb-12" aria-label="Pagination">';
    $html       .= '<ul class="' . $list_class . '">';


    $class      = ( $this->_page == 1 ) ? "page-item active disabled" : "page-item";
    $anchor_class      = ( $this->_page == 1 ) ? "page-link active disabled" : "page-link";
    $html       .= '<li class="' . $class . '"><a class="'.$anchor_class.'" href="?currentpage=' . ( $this->_page - 1 ) . '" id="' . ( $this->_page - 1 ) . '">&laquo;</a></li>';

    if ( $start > 1 ) {
        $html   .= '<li class="page-item"><a class="page-link" href="?currentpage=1" id="1">1</a></li>';
        $html   .= '<li class="disabled"><span>...</span></li>';
    }

    for ( $i = $start ; $i <= $end; $i++ ) {
        $class  = ( $this->_page == $i ) ? "page-item active disabled" : "page-item";
        $anchor_class      = ( $this->_page == $i ) ? "page-link active disabled" : "page-link";
        $html   .= '<li class="' . $class . '"><a class="'.$anchor_class.'" href="?currentpage=' . $i . '" id="' . $i . '">' . $i . '</a></li>';
    }

    if ( $end < $last ) {
        $html   .= '<li class="page-item disabled"><span>...</span></li>';
        $html   .= '<li><a class="page-link" href="?currentpage=' . $last . '" id="'.$last.'">' . $last . '</a></li>';
    }

    $class      = ( $this->_page == $last ) ? " active disabled" : "page-item";
    $anchor_class      = ( $this->_page == $last ) ? "page-link active disabled" : "page-link";
    $html       .= '<li class="' . $class . '"><a class="'.$anchor_class.'" href="?currentpage=' . ( $this->_page + 1 ) . '" id="' . ( $this->_page + 1 ) . '">&raquo;</a></li>';

    $html       .= '</ul>';
    $html       .= '</nav>';
}
    return $html;
}

}
