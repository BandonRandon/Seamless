<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Seamless
 * @subpackage Functions
 * @version 0.4.0
 * @author Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2010 - 2012, Justin Tadlock
 * @link http://themehybrid.com/themes/seamless
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'seamless_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function seamless_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'header', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'about', 'footer' ) );
	add_theme_support( 'hybrid-core-drop-downs' );
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '1c', '2c-l', '2c-r' ) );
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'dev-stylesheet' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background', array( 'default-color' => 'E6E6E6' ) );

	/* Register support for some post formats */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'quote', 'video' ) );

    /* Wraps <blockquote> around quote posts. */
	add_filter( 'the_content', 'seamless_quote_content' );

    /* Adds the featured image to image posts if no content is found. */
	add_filter( 'the_content', 'seamless_image_content' );

	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'seamless_embed_defaults' );

	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'seamless_disable_sidebars' );
	add_action( 'template_redirect', 'seamless_one_column' );

    /* Enqueue scripts (and related stylesheets) */
	add_action( 'wp_enqueue_scripts', 'seamless_scripts' );

    /* Enqueue scripts (and related stylesheets) */
	add_action( 'wp_print_styles', 'load_fonts' );

	/* Set the content width. */
	hybrid_set_content_width( 600 );
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */
function seamless_one_column() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) )
		add_filter( 'get_theme_layout', 'seamless_theme_layout_one_column' );

	elseif ( is_attachment() && 'layout-default' == theme_layouts_get_layout() )
		add_filter( 'get_theme_layout', 'seamless_theme_layout_one_column' );
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.2.0
 */
function seamless_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 */
function seamless_disable_sidebars( $sidebars_widgets ) {
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
	}

	return $sidebars_widgets;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 0.1.0
 */
function seamless_embed_defaults( $args ) {

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-3c-l' == $layout || 'layout-3c-r' == $layout || 'layout-3c-c' == $layout )
			$args['width'] = 500;
		elseif ( 'layout-1c' == $layout )
			$args['width'] = 928;
		else
			$args['width'] = 600;
	}
	else
		$args['width'] = 600;

	return $args;
}

/**
 * Registers scripts for the theme and enqueue those used sitewide.
 *
 * @since 0.1.0.
 */

function seamless_scripts() {

	wp_register_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_register_script( 'html5-shiv', get_template_directory_uri() . '/js/html5-shiv.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'small-menu' );
	wp_enqueue_script( 'html5-shiv' );

}

/**
 * Register and load the Open Sans font
 *
 */

function load_fonts() {
            wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans');
            wp_enqueue_style( 'googleFonts');
        }
 
add_action('wp_print_styles', 'load_fonts');

/**
 * Returns the number of images attached to the current post in the loop.
 *
 * @since 0.1.0
 * @return int
 * @note This is copied from Justin Tadlock's Theme Hybrid theme, Picturesque.
 * @author Justin Tadlock
 * @copyright Copyright (c), Justin Tadlock
 * @link http://themehybrid.com
 */
function seamless_get_image_attachment_count() {

	$images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1 ) );

	return count( $images );

}

/**
 * Wraps the output of the quote post format content in a <blockquote> element if the user hasn't added a 
 * <blockquote> in the post editor.
 *
 * @since 0.1.0
 * @param string $content The post content.
 * @return string $content
 */
function seamless_quote_content( $content ) {

	if ( has_post_format( 'quote' ) ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}

/**
 * Returns the featured image for the image post format if the user didn't add any content to the post.
 *
 * @since 0.1.0
 * @param string $content The post content.
 * @return string $content
 */
function seamless_image_content( $content ) {

	if ( has_post_format( 'image' ) && '' == $content ) {
		if ( is_singular() )
			$content = get_the_image( array( 'size' => 'full', 'meta_key' => false, 'link_to_post' => false ) );
		else
			$content = get_the_image( array( 'size' => 'full', 'meta_key' => false ) );
	}

	return $content;
}

/**
 * Grabs the first URL from the post content of the current post.  This is meant to be used with the link post 
 * format to easily find the link for the post. 
 *
 * @since 0.1.0
 * @return string The link if found.  Otherwise, the permalink to the post.
 *
 * @note This is copied from Justin Tadlock's Theme Hybrid. He modified it from twenty eleven - see below.
 * @note This is a modified version of the twentyeleven_url_grabber() function in the TwentyEleven theme.
 * @author wordpressdotorg
 * @copyright Copyright (c) 2011 - 2012, wordpressdotorg
 * @link http://wordpress.org/extend/themes/twentyeleven
 * @license http://wordpress.org/about/license
 */
function seamless_url_grabber() {

	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )

		return get_permalink( get_the_ID() );

	return esc_url_raw( $matches[1] );

}

?>