<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rt-assign
 */

get_header();

get_template_part( 'template-parts/features-section', get_post_type() ); 
?>

	<div class="blog-custom">
		<div style="margin-left: 0.3rem;">
		<div class="blog-posts">
			<header class="archive-page-header">
				<?php
				the_archive_title( '<h5 class="archive-page-title">', '</h5>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				<hr class="archive-bar">
			</header><!-- .page-header -->				
			<div class="all-posts">
			<?php 
				if ( have_posts() ) : ?>
				
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', 'page' );

					endwhile;
					wp_reset_postdata();

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
			?>
			</div>
		</div>
		</div>
		<div class="blog-sidebar">
		<?php get_sidebar(); ?>
		</div>
	</div>

	<hr class="line-break">

<?php
get_footer();