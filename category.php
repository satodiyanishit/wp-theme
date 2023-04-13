<?php
/**
 * Template Name: category.
 * The template for displaying author archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rt-assign
 */

get_header();

get_template_part( 'template-parts/features-section', get_post_type() ); 

?>
<div class="image_gallery-text">
  <p class="image_gallery-texthead">DESIGN IS THE SOUL</p>
  <div>
  <?php
        $categories = get_categories(array('hide_empty' => false));
        foreach ( $categories as $category ) {
          ?>
          <a
            href="<?php echo esc_url(  get_category_link( $category->term_id ) ); ?>" 
            role="button" 
            class="portfolio-tabs"
          >
            <?php esc_html_e( $category->name ); ?>
          </a>
          <?php
        }
      ?>
  </div>
</div>

<hr class="line-break" style="margin-top: -0.2rem;">
<div class="grid_container grid_container-columns-3" style="margin-bottom: 2rem;">

<?php

$posts_per_page = get_option( 'posts_per_page' ); //admin->settings

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$id    = get_query_var( 'cat' );
// $id    = $_GET['cat'];
$query = new WP_Query(
	array(
		'post_type'      => array( 'it-portfolio', 'post' ),
		'posts_per_page' => $posts_per_page,
		'paged'          => $paged,
		'cat'            => $id,
		'nopaging'       => false,    
	)
);
?>
<?php
if ( $query -> have_posts() ):
    while ( $query -> have_posts() ):
      $query -> the_post();
      ?>
  <div class="portfolio-images">
      <img class="myImg grid_container-item grid_container-img" src="<?php
      $image=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
      echo $image[0];?>">
      <div class="portfolio-images-overlay">
        <a href="#" class="icon" title="User Profile">
          <i class="fa fa-eye"></i>
        </a>
      </div>
  </div>
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

<!-- Pagination bar:template-functions-->
<?php it_pagination_bar( $query ); ?>

<hr class="line-break">

<div id="myModal" class="modal">

  <span class="close">&times;</span>
  <div class="custom-modal">
    <img class="modal-content" id="img01">
    <div style="display:flex; justify-content: space-between; align-items:center; margin-top: 1.5rem;">
      <span class="dashicons dashicons-arrow-left-alt"></span>
      <p class="modal-cap">Lorem ipsum anion jarsa lorem</p>
      <span class="dashicons dashicons-arrow-right-alt"></span>
    </div>
    <div id="caption"></div>
  </div>

</div>


<script type="text/javascript">

var modal = document.getElementById("myModal");

var images = document.querySelectorAll('.myImg');
var img_array = [...images];
img_array.forEach(img => {
  img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
  }

});
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
modal.style.display = "none";
}
</script>
<?php

get_footer();