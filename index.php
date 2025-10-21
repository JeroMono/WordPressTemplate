<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>INDEX</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
        <?php wp_head(); ?>
    </head>
    <body>
        <?php get_header(); ?>
        <section class='entradascabecera'>
            <h2>Entradas del Blog</h2>
        <?php
        echo "estoy en index";
            get_template_part('template-parts/loop-generico');
        ?>
        
        <?php get_footer(); ?>
        </section>
        <script src="" async defer></script>
    </body>
</html>