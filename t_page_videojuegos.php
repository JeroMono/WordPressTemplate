<?php
/**
 * Template Name: Pagina Videojuegos
 * Description: Plantilla de página con estructura propia.
 */
?>

<?php get_header(); ?>

<main id="site-content" class="container">
  <?php
    get_template_part('template-parts/loop-videojuegos');
    
  ?>
</main>

<?php get_footer(); ?>