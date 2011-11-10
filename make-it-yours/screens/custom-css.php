<div class="wrap">
	<?php screen_icon() ?>
	<h2><?php _e( 'Custom CSS', $this->textdomain ) ?></h2>
	<p></p>
	<form action="" method="post" id="custom-css">
		<textarea cols="70" rows="25" name="custom-css" id="newcontent" dir="ltr" tabindex="1"><?php echo esc_html( get_option( $this->custom_css_key ) ) ?></textarea>
		<div id="color-refrence-bar">
			<input type="text" id="color" class="medium-text" name="" value="" dir="ltr" onclick="javascript:select()" />
			<div class="color-selector"></div>
			<a href="#" class="pick-color"><?php _e( 'Pick a color', $this->textdomain ) ?></a>
		</div>
		<input type="hidden" name="scrollto" id="scrollto" value="<?php echo isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0; ?>" />
		<?php submit_button() ?>
	</form>
</div><!-- .wrap -->
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#custom-css').submit(function(){ $('#scrollto').val( $('#newcontent').scrollTop() ); });
	$('#newcontent').scrollTop( $('#scrollto').val() );
});
/* ]]> */
</script>