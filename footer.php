<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <footer id="site-footer" class="site-footer">
    <nav class="footer-nav" aria-label="<?php echo esc_attr_x('Menú principal', 'aria', 'jerotheme'); ?>">
      <?php 
            $arg = array(
                'theme_location' => 'footer-menu',
                'container' => 'nav',
                # EL menu class se come al container
                'container_class' => 'footer-nav',
                'menu_class' => 'footer-nav'
            );
            wp_nav_menu($arg);
        ?>
    </nav>
  </footer>