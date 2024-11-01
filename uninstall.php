<?php
/**
* Uninstaller
*
* Uninstall the plugin by removing any options from the database
*
* @package	wikilinker
* @since	1.0
*/

// If the uninstall was not called by WordPress, exit

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit(); }

// Delete the default settings

delete_option( 'wikilinker_defaults' );
?>