<?php
/**
* Widget class for Custom widget
*
* @link https://developer.wordpress.org/themes/functionality/custom-headers/
*
* @package rt-assign
*/

class it_portfolio_widget extends WP_Widget {

    // setup the widget name, description, etc...
    public function __construct() {

        $widget_ops = array(
            'classname'   => 'sidebar_portfolio',
            'description' => esc_html__( 'Displays thumbnails of the posts', 'it_domain' )
        );

        parent::__construct( 'it_portfolio', 'Portfolio', $widget_ops );
    }

    // handles the back-end of the widget(rendering)
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = 'Portfolio';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label> 
            <input class="widget_portfolio_title" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    // handles the front-end of the widget
    public function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];

		$query_images_args = array(
			'post_type'      => 'it-portfolio',
			'posts_per_page' => 8,
			);
		  
			$query = new WP_Query( $query_images_args );
			
			?>
			<div class="sidebar_portfolio">
				<h3 class="sidebar_portfolio-text">
				<?php
                    if ( isset( $instance[ 'title' ] ) ) {
                        $title = $instance[ 'title' ];
                    } else {
                        $title = 'Portfolio';
                    }
                    echo $title;
                ?>
				</h1>
				<hr class='sidebar-break'>
				<div class="sidebar_portfolio-grid">
			<?php
			if ( $query -> have_posts() ):
				while ( $query -> have_posts() ):
				  $query -> the_post();
				  ?>
				<div class="sidebar_portfolio-gitem">
                <a href="<?php echo get_post_permalink(); ?>"> <?php the_post_thumbnail();?></a>
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
		</div>
		<?php
        echo $args[ 'after_widget' ];
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'it_portfolio_widget' );
} );



class it_popular_widget extends WP_Widget {

    // setup the widget name, description, etc...
    public function __construct() {

        $widget_ops = array(
            'classname'   => 'sidebar_popular',
            'description' => esc_html__( 'Displays popular posts based on view counts', 'it_domain' )
        );

        parent::__construct( 'it_popular', 'Popular Posts', $widget_ops );
    }

    // handles the back-end of the widget(rendering)
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = 'Popular Posts';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label> 
            <input class="widget_popular_title" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    // handles the front-end of the widget
    public function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];

			$popularpost = new WP_Query( array('post_type'=> 'it-portfolio', 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

			?>
			<div class="sidebar_portfolio">
				<h3 class="sidebar_portfolio-text">
				<?php
                    if ( isset( $instance[ 'title' ] ) ) {
                        $title = $instance[ 'title' ];
                    } else {
                        $title = 'Popular Posts';
                    }
                    echo $title;
                ?>
				</h1>
				<hr class='sidebar-break'>
				<div class="sidebar_portfolio-g1">
				<?php
			if ( $popularpost->have_posts() ):
				while ( $popularpost->have_posts() ) : 
					$popularpost->the_post();
				  ?>
				<div class="popular-flex">
					<div class="sidebar_portfolio-gitem">
					<a href="<?php echo get_post_permalink(); ?>"> <?php the_post_thumbnail();?></a>
					</div>	
					<div class="post-flex">
						<p><?php the_title();?></p>
						<p class="post-flex-meta">by <span><?php the_author(); ?></span> on <?php the_time('j F, Y'); ?> </p>
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
				<?php esc_html_e( 'No popular posts found')?>
			</p>
			</div>
			<?php
			endif;
			?>
			</div>
		</div>
		<?php
        echo $args[ 'after_widget' ];
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'it_popular_widget' );
} );

//customize default recent posts
class WP_Custom_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'sidebar_popular',
			'description'                 => __( 'Your site&#8217;s most recent Posts.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'recent-posts', __( 'Recent Posts' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( 'Recent Posts' );
		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query(
			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @since 3.4.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args     An array of arguments used to retrieve the recent posts.
			 * @param array $instance Array of settings for the current widget.
			 */
			apply_filters(
				'widget_posts_args',
				array(
                    'post_type'           => 'it-portfolio',
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

        <div class="sidebar_portfolio">
				<h3 class="sidebar_portfolio-text">
				<?php
                    if ( isset( $instance[ 'title' ] ) ) {
                        $title = $instance[ 'title' ];
                    } else {
                        $title = 'Recent Posts';
                    }
                    echo $title;
                ?>
				</h3>
				<hr class='sidebar-break'>
				<div class="sidebar_portfolio-g1">
				<?php
			if ( $r->have_posts() ):
				while ( $r->have_posts() ) : 
					$r->the_post();
				  ?>
				<div class="popular-flex">
					<div class="sidebar_portfolio-gitem">
					<a class="custom_recent_posts" href="<?php echo get_post_permalink(); ?>"> <?php the_post_thumbnail();?></a>
					</div>	
					<div class="post-flex">
						<p><?php the_title(); ?></p>
						<p class="post-flex-meta">by <span><?php the_author(); ?></span> <?php the_time('j F, Y'); ?> </p>
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
				<?php esc_html_e( 'No popular posts found')?>
			</p>
			</div>
			<?php
			endif;
			?>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}
}

add_action( 'widgets_init', function() {
    register_widget( 'WP_Custom_Recent_Posts' );
} );


class it_related_posts_widget extends WP_Widget {

    // setup the widget name, description, etc...
    public function __construct() {

        $widget_ops = array(
            'classname'   => 'sidebar_popular',
            'description' => esc_html__( 'Displays related posts', 'it_domain' )
        );

        parent::__construct( 'it_related_posts', 'Related Posts', $widget_ops );
    }

    // handles the back-end of the widget(rendering)
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = 'Related Posts';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?>:</label> 
            <input class="widget_related_posts_title" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    // handles the front-end of the widget
    public function widget( $args, $instance ) {
        echo $args[ 'before_widget' ];

			$cat_name= get_query_var( 'cat' );
			$relatedpost = new WP_Query(
				array(
					'post_type'      => array( 'it-portfolio', 'post' ),
					'posts_per_page' => '4',
					'cat'            => '1'
				)
			);
			?>
			<div class="sidebar_portfolio"
			>
				<h3 class="sidebar_portfolio-text">
				<?php
                    if ( isset( $instance[ 'title' ] ) ) {
                        $title = $instance[ 'title' ];
                    } else {
                        $title = 'Related Posts';
                    }
                    echo $title;
                ?>
				</h1>
				<hr class='sidebar-break'>
				<div class="sidebar_portfolio-g1">
				<?php
			if ( $relatedpost->have_posts() ):
				while ( $relatedpost->have_posts() ) : 
					$relatedpost->the_post();
				  ?>
				<div class="popular-flex">
					<div class="sidebar_portfolio-gitem">
					<a href="<?php echo get_post_permalink(); ?>"> <?php the_post_thumbnail();?></a>
					</div>	
					<div class="post-flex">
						<?php echo $cat_name;?>
						<p><?php the_title();?></p>
						<p class="post-flex-meta">by <span><?php the_author(); ?></span> on <?php the_time('j F, Y'); ?> </p>
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
				<?php esc_html_e( 'No Related posts found')?>
			</p>
			</div>
			<?php
			endif;
			?>
			</div>
		</div>
		<?php
        echo $args[ 'after_widget' ];
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'it_related_posts_widget' );
} );