<?php
/**
 * Template Name: Pagina Programación
 * Description: Plantilla de página con estructura propia.
 */
?>

<?php get_header(); ?>

<main id="site-content" class="container">
  <?php
    echo "entro";
    get_template_part('template-parts/loop-prog');
    
  ?>
</main>

<?php get_footer(); ?>