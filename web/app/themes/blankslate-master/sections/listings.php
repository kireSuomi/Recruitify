<?php

function listings(){

    $today = date('Ymd');


    //Query all listings that are not expired
    $posts = get_posts([
        'numberposts' => -1,
        'orderby' => 'meta_value',
        'meta_query' => array(
            array(
                'key' => 'expiration_date',
                'value' => $today,
                'compare' => '>',
            ),
        ),
        'order' => 'ASC',
    ]);

    echo '<section class="listings">';
    foreach ($posts as $key => $post) {
        $title = $post->post_title;
        $excerpt = get_the_excerpt( $post );
        $job_type = get_field('type', $post->ID);
        $location = get_field('location', $post->ID);
        $url = get_the_guid( $post );
    
    
        echo <<<ARTICLE
        <article location='$location' type='$job_type'>
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