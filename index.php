<?php
/*
Plugin Name: yTicket for WP
Plugin URI: http://ticketingsystem.it/
Description: yTicket for WP is a plugin that allows you to interface your own website created with the WP platform for Help Desk Ticketing System yTicket.
With this plugin, you can:
1) create a form with which customers can open a ticket from a page of the website
2) create a form with which customers can check the processing status of a ticket
Version: 1.5.7
Author: IMSEO
Author URI: http://imseo.it/
*/

/*
Copyright (C) 2012 IMSEO, http://imseo.it/wallaceer (dev@imseolab.it)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

require_once dirname( __FILE__ ) . '/functions.php';
yTicketTextLn();
    
    /**
     * load configuration's section
     */
    if ( is_admin() ):
            require_once dirname( __FILE__ ) . '/admin.php';
    else:

        if(get_option('yticket_css') == 1):
            add_action( 'wp_enqueue_scripts', 'yTicket_enqueue_styles' );
        endif;
        
        add_action( 'wp_enqueue_scripts', 'yTicket_enqueue_js' );

    endif;


?>