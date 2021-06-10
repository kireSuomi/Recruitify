<?php

    //Green logo for hero
    $logo =  file_get_contents(get_template_directory() . '/assets/images/logo_green.svg', FILE_USE_INCLUDE_PATH);

?>


<section class='postSingleHero'>
    <?php echo "<a href='/'>$logo</a>" ?>
</section>