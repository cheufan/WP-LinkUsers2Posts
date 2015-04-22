<?php

//[lu2p_users] shortcode
function lu2p_users_func( $atts ){
  global $wpdb, $users, $lu2p;

  if ( ! is_user_logged_in() ) return;
  //get users
  $post_id = get_the_ID();
  $query = "
    SELECT $users.ID, user_nicename FROM $users
    JOIN $lu2p ON $users.ID=user_id
    WHERE post_id=$post_id
    ORDER BY create_date
    ";
  $rows = $wpdb->get_results( $query, ARRAY_A );
  $users_list = [];
  foreach ($rows as $row) {
    $firstname = get_metadata('user',$row['ID'],'first_name',true);
    $lastname = get_metadata('user',$row['ID'],'last_name',true)[0];
    $pseudo = ucfirst($row['user_nicename']);
    if (!$lastname || !$firstname) $user =  " $pseudo";
    else $user = " $firstname $lastname";
    $users_list[] = $user;
  }
  // display results
  $users_nbr = count($users_list);
  if ($users_nbr) {
    $users_list = implode(',',$users_list);
    if ($users_nbr==1)
      $verb = __('is', TEXT_DOMAIN);
    else {
      $verb = __('are', TEXT_DOMAIN);
      $users_list = substr_replace(
        $users_list,
        __(' and', TEXT_DOMAIN),
        strrpos($users_list,', '),
        1
      );
    }
    return sprintf(__('%s %s registred.', TEXT_DOMAIN),
                  $users_list,
                  $verb);
  }
  return;
}
