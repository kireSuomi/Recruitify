<?php

/*
Plugin Name: Recruitify Admin plugin
Plugin URI: https://www.advancedcustomfields.com
Description: Customize WordPress with powerful, professional and intuitive fields.
Version: 5.9.4
Author: Elliot Condon
Author URI: https://www.advancedcustomfields.com
Text Domain: acf
Domain Path: /lang
*/


function admin_page_html(){
 
  echo "<h1>Potentiala kandidater</h1><hr>";
  listJobsAndCandidates();
}

function listJobsAndCandidates(){
  $currentUser = get_user_by( 'ID', get_current_user_id() );
  $args = array(
    'author'        =>  $currentUser->ID,
    'orderby'       =>  'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => -1
    );

  $posts = get_posts($args);

  foreach ($posts as $key => $post) {
    $candidates = get_field('candidates', $post->ID);
    echo "<h2>$post->post_title</h2>";

    if ($candidates !== null) {
      echo "<div class='candidates'>";
      foreach ($candidates as $key => $userID) {
        $userID = intval($userID['name']);

        $user = get_user_by( 'ID',  $userID );
        $name = $user->display_name;
        $location = get_field('location', "user_$userID");
        $job_title = get_field('job_title', "user_$userID"); 
        $picture_url = get_field('profile_picture', "user_$userID")['url'];
        $email = $user->user_email;


        echo <<<USER
        <div class='backend-user'>
          <img src='$picture_url' />
          <h2>$name</h2>
          <p>$location</p>
          <p>$job_title</p>
          <p><b>$email</b></p>
        </div>
        USER;
      }
      echo "</div>";
    } else {
      echo "<p>Inga personer har sökt denna position.</p>";
    }
  }


}

//Add admin page to the menu
add_action( 'admin_menu', 'add_admin_page');
function add_admin_page() {
  // add top level menu page
  add_menu_page(
    'My Plugin Settings', //Page Title
    'Candidates', //Menu Title
    'manage_options', //Capability
    'my-plugin', //Page slug
    'admin_page_html' //Callback to print html
  );
}


?>