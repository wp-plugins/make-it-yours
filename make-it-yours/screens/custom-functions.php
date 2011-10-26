<div class="wrap">
	<?php screen_icon() ?>
	<h2><?php _e( 'Custom Functions', $this->textdomain ) ?></h2>
	<p></p>
	<form action="" method="post">
		<textarea name="custom-functions" id="custom-functions" dir="ltr"><?php echo esc_html( get_option( $this->custom_functions_key, "<?php \n\n" ) ) ?></textarea>
		<?php submit_button() ?>
	</form>
</div><!-- .wrap -->
<script>
	var editor = CodeMirror.fromTextArea(document.getElementById("custom-functions"), {
		lineNumbers: true,
		matchBrackets: true,
		mode: "application/x-httpd-php",
		indentUnit: 4,
		indentWithTabs: true,
		enterMode: "keep",
		tabMode: "shift"
	});
</script>