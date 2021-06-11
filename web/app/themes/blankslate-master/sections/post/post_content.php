<?php

global $post;
$button_link = '';
$user = 0;
$class = 'button applyJob';
$button_text = 'ANSöK';
if (is_user_logged_in()) {
    $user = get_current_user_id(  );
    $candiates = get_field('candidates', $post->id);
    
    if ($candiates !== false) {
        foreach ($candiates as $key => $value) {
            if (intval($value['name']) == $user)  {
             $class .= ' disabled';
             $button_text = 'Sökt';
            } 
         }
    }
    //Add to post acf field
} else {
    $button_link = '/wp/wp-login.php';
    $button_text = 'ANSöK';

}

echo <<<POST
    <article class='post'>
        <h1>$post->post_title</h1>
        <div>$post->post_content</div>
        <a id='$post->ID' class='$class' user='$user' href='$button_link' >$button_text</a>
    </article>

POST;


?>