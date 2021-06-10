<?php get_header(); ?>
<main class='pageNotFound'>
    <h1>Fel: 404 - Sidan hittades inte.</h1>
    <p>Du kommer inom kort tillbaka till framsidan.</p>
    <script>
        setTimeout(() => {
            window.location.href ='/'
        }, 3000);
    </script>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>