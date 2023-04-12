<?php
/**
 * rt-assign Theme Customizer
 *
 * @package rt-assign
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function initial_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'initial_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'initial_theme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'initial_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function initial_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function initial_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function initial_theme_customize_preview_js() {
	wp_enqueue_script( 'initial-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'initial_theme_customize_preview_js' );



//personal customize settings
function it_header_text($wp_customize) {
	$wp_customize->add_section('it_header_text_section' ,array(
		'title'=>'Header Text'
	));

	$wp_customize->add_setting('it_header_text_headline', array(
		'default'=> "Gearing up the ideas"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_header_text_headline_control' ,array(
		'label'=>'Headline',
		'section'=>'it_header_text_section',
		 'settings'=>'it_header_text_headline'
	)));

	$wp_customize->add_setting('it_header_text_desc', array(
		'default'=> "Lorem ipsum dolor sit amet, consec Ut enim ad minim veniam, quis nostrud exercitation. ullam modo consequat. irure dolor in reperit in voluptate."
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_header_text_desc_control' ,array(
		'label'=>'Description',
		'section'=>'it_header_text_section',
		'settings'=>'it_header_text_desc',
		'type'=>'textarea'
	)));
}

add_action('customize_register','it_header_text');

function it_footer_text($wp_customize) {
	$wp_customize->add_section('it_footer_text_section' ,array(
		'title'=>'Footer Text'
	));

	$wp_customize->add_setting('it_footer_text_contact_title', array(
		'default'=> "Contact Us"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_footer_text_contact_title_control' ,array(
		'label'=>'Contact Title',
		'section'=>'it_footer_text_section',
		'settings'=>'it_footer_text_contact_title',
	)));

	$wp_customize->add_setting('it_footer_text_contact_desc', array(
		'default'=> "Street 21 Planet, A-11, dapibus tristique 123511<br>
		Tel:123 456 7890 Fax:123 456789"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_footer_text_contact_desc_control' ,array(
		'label'=>'Contact Info',
		'section'=>'it_footer_text_section',
		'settings'=>'it_footer_text_contact_desc',
		'type'=>'textarea'
	)));

	$wp_customize->add_setting('it_footer_text_email', array(
		'default'=> "contactus@dsignfly.com"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_footer_text_email_control' ,array(
		'label'=>'Email',
		'section'=>'it_footer_text_section',
		'settings'=>'it_footer_text_email',
	)));

	$wp_customize->add_setting('it_footer_text_email_link', array(
		'default'=> "mailto:contactus@dsignfly.com"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_footer_text_email_link_control' ,array(
		'label'=>'Email Link',
		'section'=>'it_footer_text_section',
		'settings'=>'it_footer_text_email_link',
	)));

	$wp_customize -> add_setting( 'it_social_icons', array(
		'default' => 'www.google.com,
		www.facebook.com,
		www.pinterest.com,
		www.twitter.com,
		www.linkedin.com'
	) );

	$wp_customize -> add_control( new WP_Customize_Control( $wp_customize, 'it_social_icons-control',
	array(
		'label'    => 'Social Links',
		'section'  => 'it_footer_text_section',
		'settings' => 'it_social_icons',
		'type'     => 'textarea'
	) ) );
}

add_action('customize_register','it_footer_text');

function it_gallery($wp_customize) {
	$wp_customize->add_section('it_gallery_section' ,array(
		'title'=>'Gallery Settings'
	));

	$wp_customize->add_setting('it_gallery_headline', array(
		'default'=> "D'SIGN IS THE SOUL"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_gallery_headline_control' ,array(
		'label'=>'Gallery Headline',
		'section'=>'it_gallery_section',
		'settings'=>'it_gallery_headline'
	)));

	$wp_customize->add_setting('it_gallery_btn', array(
		'default'=> ""
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_gallery_btn_control' ,array(
		'label'=>'Description',
		'section'=>'it_gallery_section',
		'settings'=>'it_gallery_btn',
		'type'=>'dropdown-pages'
	)));
}

add_action('customize_register','it_gallery');

function it_blog_text($wp_customize) {
	$wp_customize->add_section('it_blog_section' ,array(
		'title'=>'Blog Page'
	));

	$wp_customize->add_setting('it_blog_headline', array(
		'default'=> "LET'S BLOG"
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'it_blog_headline_control' ,array(
		'label'=>'Blog Headline',
		'section'=>'it_blog_section',
		 'settings'=>'it_blog_headline'
	)));

}

add_action('customize_register','it_blog_text');