<?php 

// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit; 

// Include Kirki Framework
get_template_part('framework/admin/kirki/kirki');

// Include Animate Class
get_template_part( 'framework/admin/animate' );

/**
 * Update Kirki Path's
 *
 * @since 1.0.1
 */
if ( ! function_exists( 'lana_theme_kirki_update_url' ) ) {
    function lana_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_stylesheet_directory_uri() . '/framework/admin/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'lana_theme_kirki_update_url' );

/**
 * Enqueue Customize Preview JS
 *
 * @since 1.0.1
 */
if ( ! function_exists( 'lana_customize_preview_js' ) ) {
	function lana_customize_preview_js() {
		wp_register_script( 'lana-customize-preview', LANA_JS . 'customizer.js', array( 'customize-preview', 'jquery' ), rand() );
		wp_enqueue_script( 'lana-customize-preview' );
	}
}
add_action( 'customize_preview_init', 'lana_customize_preview_js' );

/**
 * Enqueue Customize Preview CSS
 *
 * @since 1.0.1
 */
if ( ! function_exists( 'lana_customize_preview_css' ) ) {
	function lana_customize_preview_css() {
		$output  = '<style type="text/css">';
		$output .= '#customize-control-lana_breadcrumb_font_style { pointer-events: none; background: rgba( 1, 183, 242, .5 ); position: relative; border: 5px solid #01B7F2; z-index: 1; }';
		$output .= '#customize-control-lana_breadcrumb_font_style:after { font-size: 20px; font-style: italic; font-weight: bold; position: absolute; content: "PREMIUM FEATURE"; top: 50%; left: 16%; color: red; z-index: 1; }';
		$output .= '</style>';
		echo $output;
	}
}
add_action( 'customize_controls_print_styles', 'lana_customize_preview_css');

/**
 * Remove WP Default Sections
 *
 * @since 1.0.1
 */
function lana_theme_customize_register( $wp_customize ) {
	$wp_customize->remove_section('colors');
}
add_action( 'customize_register', 'lana_theme_customize_register' );

###################################################################################
# GENERAL SETTINGS
###################################################################################
	Kirki::add_panel( 'lana_general_panel', array(
		'priority'		=> 30,
		'title'			=> __( 'General', 'lana' ),
		'description'	=> __( 'General panel.', 'lana' ),
	) );
	Kirki::add_section( 'lana_pages_section', array(
		'title'			=> __( 'General Pages', 'lana' ),
		'description'	=> __( 'General pages section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'panel'			=> 'lana_general_panel'
	) );
	Kirki::add_config( 'lana_page_titles', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_page_titles', array(
		'label'			=> __( 'Page Headings', 'lana' ),
		'description'	=> __( 'Enable pages headings (titles) ?', 'lana' ),
		'section'		=> 'lana_pages_section',
		'settings'		=> 'lana_page_titles',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_section( 'lana_general_styling_section', array(
		'title'			=> __( 'General Styling', 'lana' ),
		'description'	=> __( 'General styling section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'panel'			=> 'lana_general_panel'
	) );
	Kirki::add_config( 'lana_primary_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_primary_color', array(
		'label'			=> __( 'Primary Color', 'lana' ),
		'description'	=> __( 'Select theme primary color.', 'lana' ),
		'help'			=> __( 'All main elements will use this color.', 'lana' ),
		'section'		=> 'lana_general_styling_section',
		'settings'		=> 'lana_primary_color',
		'type'			=> 'color',
		'output'		=> array(
			array(
				'element'	=> '#header .top_nav, .lana-post-slider-item h2, .lana-search-button, .blog-infinite .post-meta .entry-action a.button:hover, .single .post-meta .entry-action a.button:hover, .form-submit input[type="submit"]',
				'property'	=> 'background'
			),
			array(
				'element'	=> '#commentform textarea:focus, #commentform input:focus',
				'property'	=> 'border-color'
			)
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '#header .top_nav, .lana-post-slider-item h2, .lana-search-button, .blog-infinite .post-meta .entry-action a.button:hover, .single .post-meta .entry-action a.button:hover, .form-submit input[type="submit"]',
				'function'	=> 'css',
				'property'	=> 'background'
			),
			array(
				'element'	=> '#commentform textarea:focus, #commentform input:focus',
				'function'	=> 'css',
				'property'	=> 'border-color'
			)
		),
		'default'		=> '#F7655C'
	) );
###################################################################################
# HEADER SETTINGS
###################################################################################
	Kirki::add_panel( 'lana_header_panel', array(
		'title'			=> __( 'Header', 'lana' ),
		'description'	=> __( 'Header settings.', 'lana' ),
		'priority'		=> 40
	) );
	#########################################################
	# HEADER GENERAL SECTION
	#########################################################
	Kirki::add_section( 'lana_header_general_section', array(
		'title'			=> __( 'Header General', 'lana' ),
		'description'	=> __( 'Lana header general section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'panel'			=> 'lana_header_panel'
	) );
	Kirki::add_config( 'lana_sticky_header', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_sticky_header', array(
		'label'			=> __( 'Sticky Header', 'lana' ),
		'description'	=> __( 'Enable sticky header ?', 'lana' ),
		'section'		=> 'lana_header_general_section',
		'settings'		=> 'lana_sticky_header',
		'type'			=> 'switch',
		'default'		=> true
	) );
	######################################################
	# HEADER LOGO SECTION
	######################################################
	Kirki::add_section( 'lana_header_logo_section', array(
		'title'			=> __( 'Header Logo', 'lana' ),
		'description'	=> __( 'Lana header logo section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'panel'			=> 'lana_header_panel'
	) );
	Kirki::add_config( 'lana_logo_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_logo_color', array(
		'settings'		=> 'lana_logo_color',
		'label'			=> __( 'Logo Color', 'lana' ),
		'description'	=> __( 'Works with textual logo only.', 'lana' ),
		'section'		=> 'lana_header_logo_section',
		'type'			=> 'color',
		'output'		=> array(
			array(
				'element'	=> '#header .logo a',
				'property'	=> 'color'
			)
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '#header .logo a',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
		'default'		=> '#2d3e52',
	) );
	##########################################
	# HEADER IMAGE SECTION
	##########################################
	Kirki::add_section( 'header_image', array(
		'title'			=> __( 'Header Image', 'lana' ),
		'description'	=> __( 'Header image section.', 'lana' ),
		'panel'			=> 'lana_header_panel'
	) );
###################################################################################
# LAYOUT SETTINGS
###################################################################################
	Kirki::add_section( 'lana_layout_section', array(
		'title'			=> __( 'Layout', 'lana' ),
		'description'	=> __( 'Layout section.', 'lana' ),
		'priority'		=> 50
	) );
	Kirki::add_config( 'lana_layout_style', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_layout_style', array(
		'label'			=> __( 'Layout Style', 'lana' ),
		'description'	=> __( 'Select layout style.', 'lana' ),
		'section'		=> 'lana_layout_section',
		'settings'		=> 'lana_layout_style',
		'type'			=> 'select',
		'choices'		=> array(
			'boxed'		=> __( 'Boxed', 'lana' ),
			'fullwidth'	=> __( 'FullWidth', 'lana' )
		),
		'default'		=> 'boxed'
	) );
###################################################################################
# SLIDER SETTINGS
###################################################################################
	Kirki::add_section( 'lana_slider_section', array(
		'title'			=> __( 'Posts Slider', 'lana' ),
		'description'	=> __( 'Posts slider section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 60
	) );
	Kirki::add_config( 'lana_slider_enable', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_slider_enable', array(
		'label'			=> __( 'Enable Slider', 'lana' ),
		'description'	=> __( 'Enable slider feature ?', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_enable',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_config( 'lana_slider_homepage', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_slider_homepage', array(
		'label'			=> __( 'Display on Homepage ?', 'lana' ),
		'description'	=> __( 'Enable slider on homepage / frontpage ?', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_homepage',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_config( 'lana_slider_featured_cat', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_slider_featured_cat', array(
		'label'			=> __( 'Post Category', 'lana' ),
		'description'	=> __( 'Select slider post category.', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_featured_cat',
		'type'			=> 'select',
		'choices'		=> Lana::get_post_categories(),
		'default'		=> 1
	) );
	Kirki::add_config( 'lana_slider_pages', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_slider_pages', array(
		'label'			=> __( 'Display on Pages', 'lana' ),
		'description'	=> __( 'Display slider on selected pages.', 'lana' ),
		'tooltip'		=> __( 'You can select multiple pages.', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_pages',
		'type'			=> 'select',
		'multiple'		=> 30,
		'choices'		=> Lana::get_all_pages(),
		'default'		=> ''
	) );
###################################################################################
# BREADCRUMB SETTINGS
###################################################################################	
	Kirki::add_panel( 'lana_breadcrumb_panel', array(
		'title'			=> __( 'Breadcrumb', 'lana' ),
		'description'	=> __( 'Lana breadcrumb section.', 'lana' ),
		'priority'		=> 70
	) );
	Kirki::add_section( 'lana_breadcrumb_general_section', array(
		'title'			=> __( 'Breadcrumb General', 'lana' ),
		'description'	=> __( 'Breadcrumb general section.', 'lana' ),
		'panel'			=> 'lana_breadcrumb_panel'
	) );
	Kirki::add_config( 'lana_breadcrumb', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb', array(
		'settings'			=> 'lana_breadcrumb',
		'label'				=> __( 'Breadcrumb', 'lana' ),
		'description'		=> __( 'Enable theme breadcrumb ?', 'lana' ),
		'section'			=> 'lana_breadcrumb_general_section',
		'type'				=> 'switch',
		'default'			=> true
	) );
	Kirki::add_config( 'lana_breadcrumb_height', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_height', array(
		'settings'			=> 'lana_breadcrumb_height',
		'label'				=> __( 'Height', 'lana' ),
		'description'		=> __( 'Set breadcrumb height.', 'lana' ),
		'section'			=> 'lana_breadcrumb_general_section',
		'type'				=> 'slider',
		'choices'			=> array(
			'min'			=> '56',
			'max'			=> '150',
			'step'			=> '1'
		),
		'output'			=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'height',
				'units'		=> 'px'
			),
			array(
				'element'	=> '.page-title-container .page-title .entry-title',
				'property'	=> 'line-height',
				'units'		=> 'px'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li',
				'property'	=> 'line-height',
				'units'		=> 'px'
			)
		),
		'transport'			=> 'postMessage',
		'js_vars'			=> array(
			array(
				'element'	=> '.page-title-container',
				'function'	=> 'css',
				'property'	=> 'height',
				'units'		=> 'px'
			),
			array(
				'element'	=> '.page-title-container .page-title .entry-title',
				'function'	=> 'css',
				'property'	=> 'line-height',
				'units'		=> 'px'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li',
				'function'	=> 'css',
				'property'	=> 'line-height',
				'units'		=> 'px'
			)
		),
		'default'			=> '80'
	) );
	Kirki::add_section( 'lana_breadcrumb_styling_section', array(
		'title'			=> __( 'Breadcrumb Styling', 'lana' ),
		'description'	=> __( 'Breadcrumb styling section.', 'lana' ),
		'panel'			=> 'lana_breadcrumb_panel'
	) );
	Kirki::add_config( 'lana_breadcrumb_bg_image', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_bg_image', array(
		'settings'			=> 'lana_breadcrumb_bg_image',
		'label'				=> __( 'Background Image', 'lana' ),
		'description'		=> __( 'Set breadcrumb background image.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'image',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'background-image'
			)
		),
		'default'			=> ''
	) );
	Kirki::add_config( 'lana_breadcrumb_bg_image_repeat', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_bg_image_repeat', array(
		'label'			=> __( 'Background Image Repeat', 'lana' ),
		'description'	=> __( 'Breadcrumb background image repeat.', 'lana' ),
		'section'		=> 'lana_breadcrumb_styling_section',
		'settings'		=> 'lana_breadcrumb_bg_image_repeat',
		'type'			=> 'select',
		'choices'		=> array(
			'no-repeat'	=> __( 'No Repeat', 'lana' ),
			'repeat'	=> __( 'Repeat All', 'lana' ),
			'repeat-x'	=> __( 'Repeat Horizontally', 'lana' ),
			'repeat-y'	=> __( 'Repeat Vertically', 'lana' ),
			'inherit'	=> __( 'Inherit', 'lana' )
		),
		'output'		=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'background-repeat'
			)
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.page-title-container',
				'function'	=> 'css',
				'property'	=> 'background-repeat'
			)
		),
		'active_callback'	=> array(
			array(
				'setting'	=> 'lana_breadcrumb_bg_image',
				'operator'	=> '!==',
				'value'		=> ''
			)
		),
		'default'		=> 'no-repeat'
	) );
	Kirki::add_config( 'lana_breadcrumb_bg_image_size', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_bg_image_size', array(
		'label'			=> __( 'Background Image Size', 'lana' ),
		'description'	=> __( 'Breadcrumb background image size.', 'lana' ),
		'section'		=> 'lana_breadcrumb_styling_section',
		'settings'		=> 'lana_breadcrumb_bg_image_size',
		'type'			=> 'select',
		'choices'		=> array(
			'inherit'	=> __( 'Inherit', 'lana' ),
			'cover'		=> __( 'Cover', 'lana' ),
			'contain'	=> __( 'Contain', 'lana' ),
		),
		'output'		=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'background-size'
			)
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.page-title-container',
				'function'	=> 'css',
				'property'	=> 'background-size'
			)
		),
		'active_callback'	=> array(
			array(
				'setting'	=> 'lana_breadcrumb_bg_image',
				'operator'	=> '!==',
				'value'		=> ''
			)
		),
		'default'		=> 'inherit'
	) );
	Kirki::add_config( 'lana_breadcrumb_bg_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_bg_color', array(
		'settings'			=> 'lana_breadcrumb_bg_color',
		'label'				=> __( 'Background Color', 'lana' ),
		'description'		=> __( 'Set breadcrumb background color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'color',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'background'
			)
		),
		'transport'			=> 'postMessage',
		'js_vars'			=> array(
			array(
				'element'	=> '.page-title-container',
				'function'	=> 'css',
				'property'	=> 'background-color'
			)
		),
		'active_callback'	=> array(
			array(
				'setting'	=> 'lana_breadcrumb_bg_image',
				'operator'	=> '==',
				'value'		=> ''
			)
		),
		'default'			=> '#32373c'
	) );
	Kirki::add_config( 'lana_breadcrumb_font_style', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_font_style', array(
		'settings'			=> 'lana_breadcrumb_font_style',
		'label'				=> __( 'Font Style', 'lana' ),
		'description'		=> __( 'Set breadcrumb font style.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'typography',
		'default'			=> '',
		'choices'			=> array(
			'font-style'	=> true,
			'font-family'	=> true,
			'font-size'		=> true,
			'line-height'	=> false,
			'font-weight'	=> true,
		),
		'output'			=> array(
			array(
				'element'	=> '.page-title-container'
			)
		)
	) );
	Kirki::add_config( 'lana_breadcrumb_font_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_font_color', array(
		'settings'			=> 'lana_breadcrumb_font_color',
		'label'				=> __( 'Heading Color', 'lana' ),
		'description'		=> __( 'Set breadcrumb heading color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'color',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .page-title .entry-title',
				'property'	=> 'color'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li:after',
				'property'	=> 'color'
			)
		),
		'transport'			=> 'postMessage',
		'js_vars'			=> array(
			array(
				'element'	=> '.page-title-container .page-title .entry-title',
				'function'	=> 'css',
				'property'	=> 'color'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li:after',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
		'default'			=> '#fff'
	) );
	Kirki::add_config( 'lana_breadcrumb_link_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_link_color', array(
		'settings'			=> 'lana_breadcrumb_link_color',
		'label'				=> __( 'Links Color', 'lana' ),
		'description'		=> __( 'Set breadcrumb links color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'color',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li a',
				'property'	=> 'color'
			)
		),
		'transport'			=> 'postMessage',
		'js_vars'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li a',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
		'default'			=> '#FFF'
	) );
	Kirki::add_config( 'lana_breadcrumb_link_hover_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_link_hover_color', array(
		'settings'			=> 'lana_breadcrumb_link_hover_color',
		'label'				=> __( 'Links Hover Color', 'lana' ),
		'description'		=> __( 'Set breadcrumb links hover color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'color',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li a:hover',
				'property'	=> 'color'
			)
		),
		'transport'			=> 'postMessage',
		'js_vars'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li a:hover',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
		'default'			=> '#F7655C'
	) );
	Kirki::add_config( 'lana_breadcrumb_link_active_color', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_breadcrumb_link_active_color', array(
		'settings'			=> 'lana_breadcrumb_link_active_color',
		'label'				=> __( 'Link Active', 'lana' ),
		'description'		=> __( 'Set breadcrumb active link color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_styling_section',
		'type'				=> 'color',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li.active',
				'property'	=> 'color'
			)
		),
		'transport'			=> 'postMessage',
		'js_vars'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li.active',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
		'default'			=> '#F7655C'
	) );
###################################################################################
# BLOG SETTINGS
###################################################################################
	Kirki::add_panel( 'lana_blog_panel', array(
		'priority'		=> 80,
		'title'			=> __( 'Blog', 'lana' ),
		'description'	=> __( 'Blog section.', 'lana' )
	) );
	Kirki::add_section( 'lana_blog_single_posts_section', array(
		'title'			=> __( 'Blog Single Posts', 'lana' ),
		'description'	=> __( 'Blog single posts section.', 'lana' ),
		'panel'			=> 'lana_blog_panel',
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_config( 'lana_blog_single_featured_thumb', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_blog_single_featured_thumb', array( 
		'label'			=> __( 'Featured Thumbnails', 'lana' ),
		'description'	=> __( 'Enable featured thumbnails on single posts ?', 'lana' ),
		'section'		=> 'lana_blog_single_posts_section',
		'settings'		=> 'lana_blog_single_featured_thumb',
		'type'			=> 'switch',
		'default'		=> false
	) );
###################################################################################
# SOCIAL ICONS SETTINGS
###################################################################################
	Kirki::add_section( 'lana_social_icons_section', array(
		'title'			=> __( 'Social Icons', 'lana' ),
		'description'	=> __( 'Social icons section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 90
	) );
	Kirki::add_config( 'lana_social_rss', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_social_rss', array(
		'label'			=> __( 'RSS URL', 'lana' ),
		'description'	=> __( 'Set your rss page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_rss',
		'type'			=> 'text',
		'default'		=> ''
	) );
	Kirki::add_config( 'lana_social_facebook', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_social_facebook', array(
		'label'			=> __( 'Facebook URL', 'lana' ),
		'description'	=> __( 'Set your facebook page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_facebook',
		'type'			=> 'text',
		'default'		=> ''
	) );
	Kirki::add_config( 'lana_social_twitter', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_social_twitter', array(
		'label'			=> __( 'Twitter URL', 'lana' ),
		'description'	=> __( 'Set your twitter page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_twitter',
		'type'			=> 'text',
		'default'		=> ''
	) );
	Kirki::add_config( 'lana_social_googleplus', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_social_googleplus', array(
		'label'			=> __( 'Google+ URL', 'lana' ),
		'description'	=> __( 'Set your google+ page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_googleplus',
		'type'			=> 'text',
		'default'		=> ''
	) );
###################################################################################
# FOOTER SETTINGS
###################################################################################
	Kirki::add_section( 'lana_footer_section', array(
		'title'			=> __( 'Footer', 'lana' ),
		'description'	=> __( 'Footer section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 110
	) );
	Kirki::add_config( 'lana_footer_social_icons', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_footer_social_icons', array(
		'label'			=> __( 'Social Icons', 'lana' ),
		'description'	=> __( 'Enable social icons in footer area ?', 'lana' ),
		'section'		=> 'lana_footer_section',
		'settings'		=> 'lana_footer_social_icons',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_config( 'lana_footer_copyright', array(
		'capability'	=> 'edit_theme_options'
	) );
	Kirki::add_field( 'lana_footer_copyright', array(
		'label'			=> __( 'Copyright', 'lana' ),
		'description'	=> __( 'Add custom footer copyright.', 'lana' ),
		'section'		=> 'lana_footer_section',
		'settings'		=> 'lana_footer_copyright',
		'type'			=> 'textarea',
		'default'		=> __( 'Lana WordPress Theme by Theme-Vision.com', 'lana' )
	) );
###################################################################################
# WORDPRESS ADDITIONAL CSS SETTINGS
###################################################################################
	Kirki::add_section( 'custom_css', array(
		'title'			=> __( 'Additional CSS', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 139
	) );
###################################################################################
# LANA SUPPORT SETTINGS
###################################################################################
	Kirki::add_section( 'lana_support_section', array(
		'title'			=> __( 'Lana Support', 'lana' ),
		'description'	=> __( 'Hey! Buy us a cofee and we shall come with new features and updates.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 140
	) );
	
/**
 * Lana Upgrade to PRO
 *
 * @since 1.0.1
 */
function lana_upgrade_to_pro() {
	wp_register_script( 'lana_customizer_script', LANA_JS . 'customizer.js', array('jquery'), uniqid(), true );
    wp_enqueue_script( 'lana_customizer_script' );
    wp_localize_script( 'lana_customizer_script', 'themevision', array(
        'URL'   => esc_url( 'http://theme-vision.com/lana-pro/' ),
        'Label' => __( 'Upgrade to PRO', 'lana' ),
    ) );
}
add_action( 'customize_controls_enqueue_scripts', 'lana_upgrade_to_pro' );

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since 1.0.1
 *
 */
function lana_customize_support_register( $wp_customize ){
	class Lana_Customize_Lana_Support extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info"> 
			<a title="<?php esc_attr_e( 'Donate', 'lana' ); ?>" href="<?php echo esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=L3ND84K5MCEZ6' ); ?>" target="_blank">
			<?php _e( 'Donate', 'lana' ); ?>
			</a>
			<a title="<?php esc_attr_e( 'Review Lana', 'lana' ); ?>" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/lana' ); ?>" target="_blank">
			<?php _e( 'Rate Lana', 'lana' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/lana' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'lana' ); ?>" target="_blank">
			<?php _e( 'Support Forum', 'lana' ); ?>
			</a>
		</div>
		<?php
		}
	}
}
add_action('customize_register', 'lana_customize_support_register');

/**
 * Customize Register
 *
 * @since 1.0.1
 */
function lana_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'title_tagline', array( 
		'title'		=> __( 'Site Identity', 'lana' ),
		'priority'	=> 1
	) );
	$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'custom_logo', array(
		'label'         => __( 'Logo', 'lana' ),
		'section'       => 'lana_header_logo_section',
		'height'        => '65',
		'width'         => '300',
		'flex_height'   => true,
		'flex_width'    => true,
		'button_labels' => array(
			'select'       => __( 'Select logo', 'lana' ),
			'change'       => __( 'Change logo', 'lana' ),
			'remove'       => __( 'Remove', 'lana' ),
			'default'      => __( 'Default', 'lana' ),
			'placeholder'  => __( 'No logo selected', 'lana' ),
			'frame_title'  => __( 'Select logo', 'lana' ),
			'frame_button' => __( 'Choose logo', 'lana' ),
		) 
	) ) );
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('static_front_page');
	###################################################################################
	# LANA SUPPORT
	###################################################################################
	$wp_customize->add_setting( 'lana_support', array(
		'default'			=> false,
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Lana_Customize_Lana_Support(
			$wp_customize,'lana_support', array(
				'label'		=> __('Lana Upgrade', 'lana'),
				'section'	=> 'lana_support_section',
				'settings'	=> 'lana_support',
			)
		)
	);
}
add_action( 'customize_register', 'lana_customize_register' );

/**
 * Styling Lana Support Section
 *
 * @since 1.0.1
 */
function lana_customize_styles_support( $input ) { ?>
	<style type="text/css">
		#customize-theme-controls #accordion-section-lana_support_section .accordion-section-title:after {
			color: #fff;
		}
		#customize-theme-controls #accordion-section-lana_support_section .accordion-section-title {
			background-color: rgba(247, 101, 92, 0.9);
			color: #fff;
		}
		#customize-theme-controls #accordion-section-lana_support_section .accordion-section-title:hover {
			background-color: rgba(247, 101, 92, 1);
		}
		#customize-theme-controls #accordion-section-lana_support_section .theme-info a {
			padding: 10px 8px;
			display: block;
			border-bottom: 1px solid #eee;
			color: #555;
		}
		#customize-theme-controls #accordion-section-lana_support_section .theme-info a:hover {
			color: #222;
			background-color: #f5f5f5;
		}
		.lana-customize-heading h3 {
			border: 1px dashed #4A73AA;
			font-weight: 600;
			text-align: center;
			color: #4A73AA;
		}
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'lana_customize_styles_support');