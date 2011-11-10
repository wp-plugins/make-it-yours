<div class="wrap">
	<?php screen_icon() ?>
	<h2><?php _e( 'Custom Functions', $this->textdomain ) ?></h2>
	<p></p>
	<form action="" method="post" id="custom-functions">
		<textarea cols="70" rows="25" name="custom-functions" id="newcontent" dir="ltr" tabindex="1"><?php echo esc_html( get_option( $this->custom_functions_key, "<?php \n\n" ) ) ?></textarea>
		<input type="hidden" name="scrollto" id="scrollto" value="<?php echo isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0; ?>" />
		<?php submit_button() ?>
	</form>
</div><!-- .wrap -->
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#custom-functions').submit(function(){ $('#scrollto').val( $('#newcontent').scrollTop() ); });
	$('#newcontent').scrollTop( $('#scrollto').val() );
});
/* ]]> */
</script>