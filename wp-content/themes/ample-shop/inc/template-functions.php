<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Ample_Shop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ample_shop_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ample_shop_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ample_shop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ample_shop_pingback_header' );



/* for time format  *
* @since Ample shop 1.0.0
*
*/
if (!function_exists('ample_shop_posted_on_theme')) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function ample_shop_posted_on_theme()
	{




		$time_string = get_the_time(get_option('date_format'));



		$posted_on = '<a href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute('echo=0') . '"><i class="ample fa fa-clock"></i>' . esc_html($time_string) . '</a> ';


		$byline = '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"><i class="ample fa fa-user-circle"></i>' . esc_html(get_the_author()) . '</a> ';

		echo '<div class="date">' .  $posted_on . '</div> <div class="by-author vcard author">' . $byline . '</div>'; // WPCS: XSS OK.



	}
endif;