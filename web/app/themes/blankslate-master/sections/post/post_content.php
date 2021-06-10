<?php

global $post;
$button_link = '';
if (is_user_logged_in()) {
    //Add to post acf field
} else {
    $button_link = '/wp/wp-login.php';
}

echo <<<POST
    <article class='post'>
        <h1>$post->post_title</h1>
        <div>$post->post_content</div>
        <a href='$button_link' class='button'>ANSöK</a>
    </article>

POST;


?>