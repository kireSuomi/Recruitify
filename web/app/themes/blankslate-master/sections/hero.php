<?php

function hero($page_id){
    $bg_image = get_field('image', $page_id)['url'];
    $logo =  file_get_contents(get_template_directory() . '/assets/images/logo_white.svg', FILE_USE_INCLUDE_PATH);

    echo <<<HERO
    <section class='hero'>
        <img  src="$bg_image" />
        $logo
    </section>
    HERO;
}
