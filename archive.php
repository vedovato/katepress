<?php get_header(); ?>

<section>

  <div>
    <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
      <article>
        <div>
          <div>
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <span><?php the_author_meta('first_name'); ?> - <?php the_date(); ?></span>
            <p><?php echo substr(get_the_excerpt(), 0, 270); ?>...</p>
            <a href="<?php the_permalink(); ?>">More</a>
          </div>

          <div>
            <?php the_post_thumbnail(); ?>
          </div>
        </div>
      </article>

    <?php endwhile; ?>
    <?php else: ?>
      <p><?php _e('Sorry, nothing here, yet.'); ?></p>
    <?php endif; ?>
  </div>

  <aside>
    <?php dynamic_sidebar('sidebar'); ?>
  </aside>

</section>

<?php get_footer(); ?>
