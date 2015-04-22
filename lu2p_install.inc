<?php

// Table creation
$query = "
  CREATE TABLE IF NOT EXISTS $lu2p (
    id int(11) NOT NULL AUTO_INCREMENT,
    post_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
  )";

//mark as install
if ($wpdb->query($query))
  add_option('lu2p_install', true);
