<?php

get_header();


include get_template_directory() . '/sections/post/post_hero.php';





?>

<div class='post_container'>
<?php
    include get_template_directory() . '/sections/post/post_author.php';
    include get_template_directory() . '/sections/post/post_content.php';
?>
</div>



<?php get_footer(); ?>