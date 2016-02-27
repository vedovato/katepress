<?php get_header(); ?>

<div>

  <section>
    <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <div><?php the_content(); ?>/div>
    </article>
    <?php endwhile; else: ?>
      <p><?php _e('Sorry, nothing here, yet.'); ?></p>
    <?php endif; ?>
  </section>

  <aside>
    <?php dynamic_sidebar('sidebar'); ?>
  </aside>

</div>

<?php get_footer(); ?>
