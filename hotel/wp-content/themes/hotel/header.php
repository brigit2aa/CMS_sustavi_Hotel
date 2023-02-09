<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Hotel</title>
    
    <?php wp_head(); ?>
  </head>
  <body>
    <!-- Navigation -->
    <header>
<nav class="container containerheder">
<div class="row">
<div class="col-sm-4">
  <a class="navbar-brand" href="<?php echo get_site_url() ?>">
    <img class="headerimg" src="<?php echo get_template_directory_uri() . '/img/hotel7.png'; ?>" alt="...">
  </a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
    <?php
        wp_nav_menu( array(
          'theme_location'    => 'glavni-menu',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'collapse navbar-collapse',
          'container_id'      => 'navbarResponsive',
          'menu_class'        => 'navbar-nav ml-auto',
          'fallback_cb'       =>  'WP_Bootstrap_Navwalker::fallback',
          'walker'            =>  new WP_Bootstrap_Navwalker(),
      ) );
      ?> 
</div>
</div>
</nav>
</header>