<?php
$args = array(
    'category_name' => 'prog', // slug de la categoría en minúsculas y sin acentos
    'posts_per_page' => -1
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        echo "<div class='entrada'>";

        the_title("<div class='tituloentrada'><h3 class='titulo'>", "</h3></div>");

        if (has_post_thumbnail()) {
            the_post_thumbnail('full', array('class' => 'img-fluid'));
        }

        echo "<div class='contenido'>";
        the_content();
        echo "</div>";

        echo "</div>";
    }
} else {
    echo '<p>No hay contenido en la categoría Programación.</p>';
}

wp_reset_postdata();
?>
