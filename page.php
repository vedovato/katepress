<?php get_header(); ?>

<section class="wrapper innerWrapper single">

  <div class="leftCol">
    <h2 class="widgetTitle">Destaques</h2>

    <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <div class="content">
        <h1><?php the_title(); ?></h1>
        <span><?php the_author_meta('first_name'); ?> - <?php the_date(); ?></span>
        <div class="contentBody">
          <?php the_content(); ?>
        </div>
      </div>
    </article>
    <?php endwhile; else: ?>
      <p><?php _e('Desculpe, não há nada aqui.'); ?></p>
    <?php endif; ?>
  </div>

  <aside class="rightCol">
    <?php dynamic_sidebar('sidebar'); ?>
  </aside>

</section>

<?php get_footer(); ?>
