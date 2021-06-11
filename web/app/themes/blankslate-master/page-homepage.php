<?php
// Template name: Frontpage template


include get_template_directory() . '/sections/hero.php';
include get_template_directory() . '/sections/search.php';
include get_template_directory() . '/sections/listings.php';

get_header();

$page_id = get_queried_object_id();
hero($page_id);
search_form();


?>
    <h1 class='text-center my-1'>Lediga tjänster</h1>
<?php

listings();

get_footer();

?>