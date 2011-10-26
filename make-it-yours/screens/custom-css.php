<div class="wrap">
	<?php screen_icon() ?>
	<h2><?php _e( 'Custom CSS', $this->textdomain ) ?></h2>
	<p></p>
	<form action="" method="post">
		<textarea name="custom-css" id="custom-css" dir="ltr"><?php echo esc_html( get_option( $this->custom_css_key ) ) ?></textarea>
		<div id="color-refrence-bar">
			<input type="text" id="color" class="medium-text" name="" value="" dir="ltr" onclick="javascript:select()" />
			<div class="color-selector"></div>
			<a href="#" class="pick-color"><?php _e( 'Pick a color', $this->textdomain ) ?></a>
		</div>
		<?php submit_button() ?>
	</form>
</div><!-- .wrap -->
<script>
	var editor = CodeMirror.fromTextArea(document.getElementById("custom-css"), {
		lineNumbers: true,
		matchBrackets: true,
		mode: "text/css",
		indentUnit: 4,
		indentWithTabs: true,
		enterMode: "keep",
		tabMode: "shift",
	});
</script>