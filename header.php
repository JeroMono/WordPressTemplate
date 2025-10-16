<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header id="site-header" class="site-header">
    <div class="logo">
        <img id="weblogo"
             src="<?php echo esc_url( get_template_directory_uri() . '/images/logo.png' ); ?>"
             alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
    </div>

    <nav class="main-nav" aria-label="<?php echo esc_attr_x('Menú principal', 'aria', 'jerotheme'); ?>">
      <?php
      wp_nav_menu([
        'theme_location' => 'main-menu',
        'container'      => false,
        'menu_class'     => 'menu',
        'menu_id'        => 'primary-menu'
      ]);
      ?>
    </nav>
  </header>