<?php
/**
* Plugin Name: WP Dumb events register
* Description: A very simple plugin to indicate if a user participe to an event describe by an article.
* Author: François Daneau
* Version: 0.1
* Author URI: http://www.rollerngo.fr
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

/*
TODO :
  * [wpder_list]
  * Installation auto du plugin :
    - création de la BDD
    - marquage avec l'API option de l'état du plugin (installé/ou pas)
  * Passage en objet
*/

//[wpder_button]
function wpder_button_func( $atts ){
  if ( ! is_user_logged_in() ) return;
  $a = shortcode_atts( array(
    'url' => null
  ), $atts);
  $post_id = url_to_postid($a['url']);
  // est ce que l'URL existe ?
  if ($post_id==0) return;
  $user_id = wp_get_current_user()->data->ID;
  //determiner suffixe bdd
  //--
  global $wpdb;
  $register = $wpdb->get_results(
  	"
    SELECT count(id) AS result FROM wp_wpder
    WHERE 1
      AND post_id=$post_id
      AND user_id=$user_id
  	"
  , ARRAY_N)[0][0];
  //affichage du formulaire
  if ($register)
    $button_value = "Désincription";
  else
    $button_value = "Inscription";
  $action_file = admin_url( 'admin-post.php' );
  return "
    <form method='POST' action='$action_file'>
      <input type='hidden' name='action' value='register'/>
      <input type='hidden' name='register' value='$register'/>
      <input type='hidden' name='post' value='$post_id'/>
      <input type='submit' value='$button_value'/>
    </form>
  ";
}

// traitement du post
function prefix_admin_register() {
    $current_user = wp_get_current_user();
    echo $current_user->data->ID;
    echo $_POST['post'];
    echo $_POST['register'];
    wp_safe_redirect( wp_get_referer() );
}

// =============================================================================
// si plugin non installé
  // création de la BDD

// sinon
add_action( 'admin_post_register', 'prefix_admin_register' );
add_shortcode( 'wpder_button', 'wpder_button_func' );
