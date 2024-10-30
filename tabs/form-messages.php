<h2><?php _e( 'Form Messages', 'mailflatrate-for-wp' ); ?></h2>
<?php 
echo '<form method="post" action="options.php">'; 
	settings_fields( 'mailflatrate-plugin-setting-form-code-messages' );
    do_settings_sections( 'mailflatrate-plugin-setting-form-code-messages' );
	
	 ?>
<table class="form-table mc4wp-form-messages mailflatrate-form-messages">

	<?php
	/** @ignore */
	
	?>

	<tr valign="top">
    <div style="display:none">
    	<?php echo _e( 'First name', 'mailflatrate-for-wp' ); ?>
        <?php echo _e( 'Last name', 'mailflatrate-for-wp' ); ?>
        <?php echo _e( 'Email', 'mailflatrate-for-wp' ); ?>
    </div>
		<th scope="row"><label for="mailflatrate-successfully-subscribeed"><?php _e( 'Successfully subscribed', 'mailflatrate-for-wp' ); ?></label></th>
		<td>
        <input id="mailflatrate-successfully-subscribeed-color" value="<?php echo esc_attr( get_option('mailflatrate-successfully-subscribeed-color') ); ?>" name="mailflatrate-successfully-subscribeed-color" type="hidden" />
			<input type="text" class="widefat" id="mailflatrate-successfully-subscribeed" name="mailflatrate-successfully-subscribeed" value="<?php echo __(get_option('mailflatrate-successfully-subscribeed'),'mailflatrate-for-wp' ); ?>" required  />
			<p class="help"><?php _e( 'The text that shows when an email address is successfully subscribed to the selected list(s).', 'mailflatrate-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="mailflatrate-invalid-email-address"><?php _e( 'Invalid email address', 'mailflatrate-for-wp' ); ?></label></th>
		<td>
        <input id="mailflatrate-invalid-email-address-color" name="mailflatrate-invalid-email-address-color" value="<?php echo esc_attr( get_option('mailflatrate-invalid-email-address-color') ); ?>" type="hidden" />
			<input type="text" class="widefat" id="mailflatrate-invalid-email-address" name="mailflatrate-invalid-email-address" value="<?php echo __( get_option('mailflatrate-invalid-email-address'),'mailflatrate-for-wp' ); ?>" required />
			<p class="help"><?php _e( 'The text that shows when an invalid email address is given.', 'mailflatrate-for-wp' ); ?></p>
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row"><label for="mailflatate_already_subscribed"><?php _e( 'Already subscribed', 'mailflatrate-for-wp' ); ?></label></th>
		<td>
        <input id="mailflatate_already_subscribed-color" name="mailflatate_already_subscribed-color" value="<?php echo esc_attr( get_option('mailflatate_already_subscribed-color') ); ?>" type="hidden" />
			<input type="text" class="widefat" id="mailflatate_already_subscribed" name="mailflatate_already_subscribed" value="<?php echo __( get_option('mailflatate_already_subscribed'),'mailflatrate-for-wp' ); ?>" required />
			<p class="help"><?php _e( 'The text that shows when the given email is already subscribed to the selected list(s).', 'mailflatrate-for-wp' ); ?></p>
		</td>
	</tr>
    <tr valign="top">
		<th scope="row"><label for="agree_to_terms"><?php _e('Agree to terms','mailflatrate-for-wp'); ?></label></th>
		<td>
        
        <input id="agree_to_terms-color" name="mailflatrate-agree_to_terms-color" type="hidden" value="<?php echo esc_attr( get_option('mailflatrate-agree_to_terms-color') ); ?>" />
			<input type="text" class="widefat" id="agree_to_terms" name="mailflatrate-agree_to_terms" value="<?php echo __( get_option('mailflatrate-agree_to_terms'),'mailflatrate-for-wp' ); ?>" required />
			<p class="help"><?php _e( 'The text that shows when the checkbox isn´t checked', 'mailflatrate-for-wp' ); ?></p>
		</td>
	</tr>
    
    
    
    <tr valign="top">
		<th scope="row"><label for="missing-email-address"><?php _e('Missing email address','mailflatrate-for-wp'); ?></label></th>
		<td>
        
        <input id="missing-email-address-color" name="missing-email-address-color" type="hidden" value="<?php echo esc_attr( get_option('missing-email-address-color') ); ?>" />
			<input type="text" class="widefat" id="missing-email-address" name="missing-email-address" value="<?php echo __( get_option('missing-email-address'),'mailflatrate-for-wp' ); ?>" required />
			<p class="help"><?php _e( 'This text appears if the e-mail was not specified', 'mailflatrate-for-wp' ); ?></p>
		</td>
	</tr>
    
     <tr valign="top">
		<th scope="row"><label for="data-protection"><?php _e('Data protection','mailflatrate-for-wp'); ?></label></th>
		<td>
        
        <input id="data-protection-color" name="data-protection-color" type="hidden" value="<?php echo esc_attr( get_option('data-protection-color') ); ?>" />
			<input type="text" class="widefat" id="data-protection" name="data-protection" value="<?php echo __( get_option('data-protection'),'mailflatrate-for-wp' ); ?>" required />
			<p class="help"><?php _e( 'This text appears if data protection was not specified', 'mailflatrate-for-wp' ); ?></p>
		</td>
	</tr>
	
</table>
<?php submit_button(); ?>
<?php echo '</form>'; ?>
<script>
jQuery("#mailflatrate-successfully-subscribeed-color, #mailflatrate-invalid-email-address-color, #mailflatate_already_subscribed-color, #agree_to_terms-color, #missing-email-address-color, #data-protection-color").spectrum({
        flat: false,
        showInput: true,
        className: "full-spectrum",
        showInitial: true,
        showPalette: true,
        showSelectionPalette: true,
        maxPaletteSize: 10,
        preferredFormat: "hex",
        localStorageKey: "spectrum.example",
        move: function (color) {
        },
        show: function () {

        },
        beforeShow: function () {

        },
        hide: function (color) {
        },

        palette: [
            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)", /*"rgb(153, 153, 153)","rgb(183, 183, 183)",*/
            "rgb(204, 204, 204)", "rgb(217, 217, 217)", /*"rgb(239, 239, 239)", "rgb(243, 243, 243)",*/ "rgb(255, 255, 255)"],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
            "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
            "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
            "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
            "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
            "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
            "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
            "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
            "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
            /*"rgb(133, 32, 12)", "rgb(153, 0, 0)", "rgb(180, 95, 6)", "rgb(191, 144, 0)", "rgb(56, 118, 29)",
            "rgb(19, 79, 92)", "rgb(17, 85, 204)", "rgb(11, 83, 148)", "rgb(53, 28, 117)", "rgb(116, 27, 71)",*/
            "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
            "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
        ]
    });
</script>