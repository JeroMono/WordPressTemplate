<?php
echo "entramos loop";
if (have_posts()){
    while (have_posts()){
        
        echo "<div class='entrada'>";
        the_post("<div class='entrada'>", "</div>");
        the_title("<div class='tituloentrada'><h3 class='titulo'>", "</h3></div>");
        if (has_post_thumbnail()){
            the_post_thumbnail('full', array('class' => 'img-fluid'));
        }
        echo "<p class='contenido'>";
        the_content();
        echo "</p></div>";
    }
}else{
    echo "no hay post";
}

?>