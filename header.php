<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body>

  <header>
    <nav>
      <?php
        $args = array(
        	'theme_location' => 'mainNav',
          'depth'          => 1,
        	'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
        );
        wp_nav_menu($args);
      ?>
    </nav>
  </header>
