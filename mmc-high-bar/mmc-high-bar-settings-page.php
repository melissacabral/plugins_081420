<div class="wrap">
	<h1>High Bar Settings</h1>
	<form action="options.php" method="post">
		<?php //attach this form to the registered setting (match it to the first arg of register_setting())
		settings_fields( 'high_bar_setting_group' );

		//make the form "sticky" - get the current values from the DB
		$values = get_option('high_bar'); 
		?>
		<label>Bar Announcement Text</label>
		<br>
		<input type="text" name="high_bar[bar_text]" class="regular-text" value="<?php echo stripslashes($values['bar_text']); ?>">

		<br>
		<br>

		<label>Button Text</label>
		<br>
		<input type="text" name="high_bar[button_text]" class="regular-text" value="<?php echo stripslashes($values['button_text']); ?>">

		<br>
		<br>

		<label>Button Link</label>
		<br>
		<input type="url" name="high_bar[button_url]" class="regular-text" value="<?php echo stripslashes($values['button_url']); ?>">

		<br>
		<br>
		<?php submit_button('Save Settings'); ?>

	</form>
</div>