<div class="image_gallery">
  <div class="image_gallery-text">
    <p class="image_gallery-texthead"><?php echo get_theme_mod('it_gallery_headline'); ?></p>
    <a href="<?php echo get_permalink( get_theme_mod( 'it_gallery_btn', '#' ) ); ?>"><button class="image_gallery-btn">view all</button></a>
  </div>
  <hr class="line-break" style="margin-top: 0;">
  <div class="grid_container grid_container-columns-3">
    <?php
    $query_images_args = array(
  'post_type'      => 'it-portfolio',
  'posts_per_page' => 6,
  );

  $query = new WP_Query( $query_images_args );
  
  if ( $query -> have_posts() ):
      while ( $query -> have_posts() ):
        $query -> the_post();
        ?>
        <img class="grid_container-item grid_container-img" src="<?php
            $image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
            echo $image[0];?>"> 
        <?php
      endwhile;
      ?>
  <?php
  else:
  ?>
  <div class="container">
    <p>
      <?php esc_html_e( 'Sorry, no portfolio items found. Add posts in portfolio posts in admin.')?>
    </p>
  </div>
  <?php
  endif;
  ?>
  </div>
  <hr class="line-break">
</div>



























