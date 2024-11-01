<?php
/**
* Wikilinker Options
*
* Allow the user to change the default options
*
* @package	wikilinker
* @since	1.0
*/
?>
<div class="wrap">
<h1><?php _e( 'Wikilinker Settings', 'wikilinker' ); ?></h1>
<?php

// If options have been updated on screen, update the database

if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'options-screen' , 'wikilinker_defaults_nonce' ) ) ) {

	// Update the options array from the form fields. Strip invalid tags.

	$options[ 'target' ] = sanitize_text_field( strtolower( trim( $_POST[ 'wikilinker_target' ] ) ) );
	$options[ 'related' ] = sanitize_text_field( strtolower( trim( $_POST[ 'wikilinker_related' ] ) ) );
	$options[ 'language' ] = sanitize_text_field( strtolower( trim( $_POST[ 'wikilinker_language' ] ) ) );

	if ( '' == $options[ 'lang' ] or 2 != strlen( $options[ 'lang' ] ) ) { $options[ 'lang' ] = 'en'; }

    update_option( 'wikilinker_defaults', $options );

	echo '<div class="update fade"><p><strong>' . __( 'Settings Saved.', 'wikilinker' ) . "</strong></p></div>\n";
}

// Fetch options into an array

$options = get_wikilinker_defaults();
?>

<form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/options-general.php?page=wikilinker-options&amp;updated=true' ?>">

<table class="form-table">
<tr>
<th scope="row"><label for="wikilinker_language"><?php _e( 'Language', 'wikilinker' ); ?></label></th>
<td><input type="text" size="2" maxlength="2" name="wikilinker_language" value="<?php echo esc_html( $options[ 'language' ] ); ?>"/><p class="description"><?php _e( 'A two letter language identifier. The default is EN for English.', 'wikilinker' ); ?></p></td>
</tr>

<tr>
<th scope="row"><label for="wikilinker_related"><?php _e( 'Related', 'wikilinker' ); ?></label></th>
<td><input type="text" size="10" maxlength="10" name="wikilinker_related" value="<?php echo esc_html( $options[ 'related' ] ); ?>"/><p class="description"><?php _e( 'The rel attribute specifies the relationship between the current document and the linked document. <a href="http://www.w3schools.com/tags/att_a_rel.asp">Read more</a>.', 'wikilinker' ); ?></p></td>
</tr>

<tr>
<th scope="row"><label for="wikilinker_target"><?php _e( 'Target', 'wikilinker' ); ?></label></th>
<td><input type="text" size="12" maxlength="12" name="wikilinker_target" value="<?php echo esc_html( $options[ 'target' ] ); ?>"/><p class="description"><?php _e( 'The target attribute specifies where to open the linked document. <a href="http://www.w3schools.com/tags/att_a_target.asp">Read more</a>.', 'wikilinker' ); ?></p></td>
</tr>

</table>

<?php wp_nonce_field( 'options-screen', 'wikilinker_defaults_nonce', true, true ); ?>

<br/><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes', 'wikilinker' ); ?>"/>

</form>

</div>