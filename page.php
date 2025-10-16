<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PAGE</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
        <?php wp_head(); ?>
    </head>
    <body>
        <?php get_header(); ?>
        <section class='entradascabecera'>
            <h2>Estoy en page</h2>
        <?php
            $entradas = [];
            if (have_posts()){
                while (have_posts()){
                    
                    echo "<div class='entrada'>";
                    $contenido = the_post("<div class='entrada'>", "</div>");
                    $titulo = the_title("<div class='tituloentrada'><h3 class='titulo'>", "</h3></div>");
                    echo "<p class='contenido'>";
                    the_content();
                    echo "</p></div>";
                }
            }
        ?>
        <?php get_footer(); ?>
        </section>
        <script src="" async defer></script>
    </body>
</html>