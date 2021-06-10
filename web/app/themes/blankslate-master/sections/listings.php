<?php

function listings(){
    $posts = get_posts([
        'numberposts' => 6
    ]);

    echo '<section class="listings">';
    foreach ($posts as $key => $post) {
        $title = $post->post_title;
        $excerpt = get_the_excerpt( $post );
        $job_type = get_field('type', $post->ID);
        $location = get_field('location', $post->ID);
        $url = get_the_guid( $post );
    
    
        echo <<<ARTICLE
        <article>
            <h2>$title</h2>
            <label>Yrke: $job_type</label>
            <label>Ort: $location</label>
            <p class='excerpt'>$excerpt</p>
            <a class='button' href='$url'>sök tjänsten</a>
        </article>
        ARTICLE;
    }
    echo '</section>';
}

?>