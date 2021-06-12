<?php

global $post;

$author = get_user_by( 'ID', $post->post_author);


$location = get_field('location', 'user_'  .  $author->ID);
$job_title = get_field('job_title', 'user_'  .  $author->ID);
$publish_date = explode(' ',$post->post_date)[0];
$last_date = str_replace('/', '-', get_field('expiration_date', $post->ID));

$profile_picture = get_field('profile_picture', 'user_'  . $author->ID);
if ($profile_picture !== null) {
         $profile_picture = $profile_picture['url'];
} else {
        $profile_picture = get_template_directory_uri() . '/assets/images/profile-pic.png';
}
$name = $author->display_name;
$email = $author->user_email;






echo <<<INFO
<section class='post_author'>
        <label>Ort</label>
        <p>$location</p>

        <label>Yrke</label>
        <p>$job_title</p>

        <label>Publiceringsdatum</label>
        <p>$publish_date</p>

        <label class='orange'>Sista ansökningsdatum</label>
        <p class='orange'>$last_date</p>

        <img class='profile_pic' src='$profile_picture' alt='Picture of the job poster $profile_picture' />
        <label class='mt-05 important'>Kontakt</label>
        <p class='mt-05'>$name</p>
        <p class='mt-05 underline'>$email</p>
</section>
INFO;

?>

