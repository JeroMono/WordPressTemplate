<?php
    $args = array('post_type' => 'Videojuegos');
    $videojuegos = new WP_Query($args);
    
    if ($videojuegos->have_posts()) {
        while ($videojuegos->have_posts()) {
            $videojuegos->the_post();    
            echo "<div class='entrada'>";

            the_title("<div class='tituloentrada'><h3 class='titulo'>", "</h3></div>");

            if(has_post_thumbnail()){
                the_post_thumbnail('full', array('class' => 'img-fluid'));
            }
            echo "<div class='contenido'>";
        the_content();
        the_field('gameplay');
        echo "</div>";

        echo "</div>";
        }
        wp_reset_postdata();
    } else {
        echo '<p>No content found 2</p>';
    }
?>