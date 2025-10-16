<?php
/**
 * Template Name: Pagina Vertical
 * Description: Plantilla de página con estructura propia.
 */
?>

<?php get_header(); ?>

<main id="site-content" class="container">
  <?php
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();
        the_title('<h1>', '</h1>');
        the_content();
      endwhile;
    endif;
  ?>
</main>

<?php get_footer(); ?>