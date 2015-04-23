<?php
/**
* Plugin Name: WP Link Users 2 Posts
* Description: A very simple plugin to associate users with posts.
* Author: François Daneau
* Version: 0.1
* Author URI: http://cheufan.github.io/WP-LinkUsers2Posts/
* Text Domain: wp-link-users-2-posts
* License: GPL2
*/

/*  Copyright 2015  François Daneau  (email : francois@fracanet.fr)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// DB vars
global $wpdb;
$users = $wpdb->prefix.'users';
$lu2p = $wpdb->prefix.'lu2p';

// plugin installation
if (!get_option('lu2p_install'))
  include('lu2p_install.inc');

// Code for [lu2p_form] shortcode
include_once('lu2p_form.inc');
// Code for [lu2p_users] shortcode
include_once('lu2p_users.inc');

// Internationalisation
define('TEXT_DOMAIN', 'wp-linkusers2posts');

function i18n_init() {
 $plugin_dir = basename(dirname(__FILE__));
 load_plugin_textdomain( TEXT_DOMAIN, false, $plugin_dir );
}

// Hooks
add_action('plugins_loaded', 'i18n_init');
add_action( 'admin_post_lu2p_form', 'lu2p_form_post' );
add_shortcode( 'lu2p_form', 'lu2p_form_func' );
add_shortcode( 'lu2p_users', 'lu2p_users_func' );
