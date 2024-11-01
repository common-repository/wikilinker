<?php
/*
Plugin Name: Wikilinker
Plugin URI: https://github.com/dartiss/wikilinker
Description: Simple shortcode to quickly add links to Wikipedia.
Version: 1.0.3
Author: David Artiss
Author URI: https://artiss.blog
Text Domain: wikilinker
*/

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function wikilinker_set_plugin_meta( $links, $file ) {

	if ( false !== strpos( $file, 'wikilinker.php' ) ) {

		$links = array_merge( $links, array( '<a href="https://github.com/dartiss/wikilinker">' . __( 'Github', 'wikilinker' ) . '</a>' ) );

		$links = array_merge( $links, array( '<a href="http://wordpress.org/support/plugin/wikilinker">' . __( 'Support', 'wikilinker' ) . '</a>' ) );
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'wikilinker_set_plugin_meta', 10, 2 );

/**
* Add Settings link to plugin list
*
* Add a Settings link to the options listed against this plugin
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function wikilinker_add_settings_link( $links, $file ) {

	static $this_plugin;

	if ( !$this_plugin ) { $this_plugin = plugin_basename( __FILE__ ); }

	if ( false !== strpos( $file, 'wikilinker.php' ) ) {
		$settings_link = '<a href="options-general.php?page=wikilinker-options">' . __( 'Settings', 'wikilinker' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}

add_filter( 'plugin_action_links', 'wikilinker_add_settings_link', 10, 2 );

/**
* Add settings option
*
* Add a new settings option to the admin menu
*
* @since	1.0
*/

function add_wikilinker_menu() {

	global $wikilinker_options_hook;

	$wikilinker_options_hook = add_submenu_page( 'options-general.php', __( 'Wikilinker Settings', 'wikilinker' ), __( 'Wikilinker', 'wikilinker' ), 'manage_options', 'wikilinker-options', 'wikilinker_options' );

	add_action( 'load-' . $wikilinker_options_hook, 'add_wikilinker_help' );

}

add_action( 'admin_menu','add_wikilinker_menu' );

/**
* Add Wikilinker options screen
*
* Define an option screen
*
* @since	1.0
*/

function wikilinker_options() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'options-screen.php' );

}

/**
* Add Options Help
*
* Add help tab to options screen
*
* @since	1.0
*/

function add_wikilinker_help() {

	global $wikilinker_options_hook;
	$screen = get_current_screen();

	if ( $screen->id != $wikilinker_options_hook ) { return; }

	$screen -> add_help_tab( array( 'id' => 'wikilinker-help-tab', 'title'	=> __( 'Help', 'wikilinker' ), 'content' => wikilinker_help_text() ) );
}

/**
* Options Help Text
*
* Return help text for options screen
*
* @since	1.0
*
* @return	string	Help Text
*/

function wikilinker_help_text() {

	$help_text = '<p>' . __( 'Use this screen to define the default parameters for the Wikilinker shortcode. These can be overridden at any time by using the appropriate parameter on the shortcode.', 'wikilinker' ) . '</p>';

	return $help_text;
}

/**
* Wikilinker shortcode
*
* Shortcode function to add a Wikipedia link
*
* @since	1.0
*
* @param	string	$paras		Shortcode parameters
* @param	string	$content	Content to be suppressed
* @return	string				Output code
*/

function wikilinker_shortcode( $paras = '', $content = '' ) {

	// Extract the shortcode parameters

	extract( shortcode_atts( array( 'alt' => '', 'rel' => '', 'lang' => '', 'target' => '' ), $paras ) );

	// Get the default settings and, if any optional parameters aren't set, use the defaults

	$options = get_wikilinker_defaults();
	if ( '' == $rel ) { $rel = $options[ 'related' ]; }
	if ( '' == $target ) { $target = $options[ 'target' ]; }
	if ( '' == $lang ) { $lang = $options[ 'language' ]; }

	// If an alternative link is specified use that rather than the linked text

	if ( '' != $alt ) { $lookup = $alt; } else { $lookup = $content; }

	// Now ensure that all spaces are replaced with underscores. It's what Wikipedia would want

	$lookup = str_replace( ' ', '_', $lookup );

	// Build the title plus any additional, optional parameters

	$title = sprintf( __( '%s on Wikipedia', 'wikilinker' ), $content );

	$extras = '';
	if ( '' != $rel ) { $extras .= ' rel="' . $rel . '"'; }
	if ( '' != $target ) { $extras .= ' target="' . $target . '"'; }

	// Generate the HTML code

	$output = '<a href="https://' . $lang . '.wikipedia.org/wiki/' . $lookup . '" title="' . $title . '"' . $extras  . '>' . $content . '</a>';

	return $output;

}

add_shortcode( 'wikilink', 'wikilinker_shortcode' );

/**
* Get Wikilinker defaults
*
* Get the default values for the Wikilinker parameters
*
* @since	1.0
*
* @return	string			Defaults
*/

function get_wikilinker_defaults() {

	$options = get_option( 'wikilinker_defaults' );

	if ( !is_array( $options ) ) {
		$options = array(
						'related' => '',
						'language' => 'en',
						'target' => ''
					);
	}

	return $options;
}
?>