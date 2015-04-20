<?php

// [lu2p_form] shortcode
function lu2p_form_func( $atts ){
  global $wpdb, $lu2p;

  // get attributes
  if ( ! is_user_logged_in() ) return;
  $a = shortcode_atts( array(
    'url' => get_post_permalink()
  ), $atts);
  $post_id = url_to_postid($a['url']);
  if ($post_id==0) return;   // URL exist?
  // get users
  $user_id = wp_get_current_user()->data->ID;
  $register = $wpdb->get_var( $wpdb->prepare(
  	 "SELECT count(id) AS result FROM $lu2p
      WHERE 1
        AND post_id=%d
        AND user_id=%d
     ", $post_id, $user_id));
  // display form
  if ($register) $button_value = 'Désinscription';
  else $button_value = 'Inscription';
  $post_file = admin_url( 'admin-post.php' );
  return "
    <form method='POST' action='$post_file'>
      <input type='hidden' name='action' value='lu2p_form'/>
      <input type='hidden' name='register' value='$register'/>
      <input type='hidden' name='post' value='$post_id'/>
      <input type='submit' value='$button_value'/>
    </form>
  ";
}

// POST execution
function lu2p_form_post() {
  global $wpdb, $lu2p;

  if (isset($_POST['post']) && isset($_POST['register'])) {
    $current_user = wp_get_current_user();
    if ($_POST['register']) {
      // remove register
      $wpdb->delete($lu2p,
        array('user_id' => $current_user->data->ID,
              'post_id' => $_POST['post']),
        array('%d', '%d') );
    }
    else {
      // add register
      $wpdb->insert($lu2p,
        array('user_id' => $current_user->data->ID,
              'post_id' => $_POST['post']),
        array('%d', '%d'));
    }
  }
  //redirect
  wp_safe_redirect( wp_get_referer() );
}
