<h2 class="ns-mm-main-title">NS Maintenance Mode </h2>
<h3 class="ns-mm-sub-title">Settings </h3>

<form method="post" action="options.php">
	<?php settings_fields('ns_mm_options_group'); ?>

<div class="box-ns">
	<div class="ns-container-btta">

		<div class="ns-mm-section-box">
			<div class="column-ns-btta">
				<div class="ns-mm-title-container">
					<h2>BACKGROUND IMAGE</h2>
				</div>
			</div>

			<div class="ns-label-container-btta">
				Choose your background image
			</div>
			<div>
				<input id="ns_mm_background_image" class="ns-upload-text " name="ns_mm_background_image" type="text" size="36" value="<?php echo esc_html(get_option('ns_mm_background_image', plugins_url('assets/img/1.jpg', __FILE__))); ?>" />
				<input id="ns_mm_background_image_button" class="ns-upload-button btnUploadBtn ns-btns-mm-options " name="ns_mm_background_image_button" type="button" value="Upload Image" />
				<i id="ns_reset_logo" class="fa fa-times-circle"></i>
			</div>
		</div>

		<div class="ns-mm-section-box">
			<div class="column-ns-btta">
				<div class="ns-mm-title-container">
					<h2>SOCIAL LINK AND COLOR</h2>
				</div>
			</div>

			<div class="column-ns-btta column-ns-btta-container">
				<div class="ns-label-container-btta">
					Facebook Link
				</div>
				<div class="ns-input-container-btta ns-mm-link-input">
					<input type="text" id="ns_mm_facebook_icon_link" value="<?php echo esc_html(get_option('ns_mm_facebook_icon_link', '#')); ?>" name="ns_mm_facebook_icon_link" />
				</div>
				<div class="ns-label-container-btta">
					Twitter Link
				</div>
				<div class="ns-input-container-btta ns-mm-link-input">
					<input type="text" id="ns_mm_twitter_icon_link" value="<?php echo esc_html(get_option('ns_mm_twitter_icon_link', '#')); ?>" name="ns_mm_twitter_icon_link" />
				</div>
				<div class="ns-label-container-btta">
					Google Plus Link
				</div>
				<div class="ns-input-container-btta ns-mm-link-input">
					<input type="text" id="ns_mm_google_icon_link" value="<?php echo esc_html(get_option('ns_mm_google_icon_link', '#')); ?>" name="ns_mm_google_icon_link" />
				</div>
			</div>
			<div class="column-ns-btta column-ns-btta-container">
				<div class="ns-label-container-btta">
					Text Color
				</div>
				<div class="ns-input-container-btta">
					<input type="color" id="ns_mm_text_color" value="<?php echo esc_html(get_option('ns_mm_text_color', '#FFFFFF')); ?>" name="ns_mm_text_color" />
				</div>
				<div class="ns-label-container-btta">
					Social, Button, Link Color
				</div>
				<div class="ns-input-container-btta">
					<input type="color" id="ns_mm_sbl_color" value="<?php echo esc_html(get_option('ns_mm_sbl_color', '#FFFFFF')); ?>" name="ns_mm_sbl_color" />
				</div>
				<div class="ns-label-container-btta">
					Social, Button, Link Color Hover
				</div>
				<div class="ns-input-container-btta">
					<input type="color" id="ns_mm_sbl_color_hover" value="<?php echo esc_html(get_option('ns_mm_sbl_color_hover', '#FFFFFF')); ?>" name="ns_mm_sbl_color_hover" />
				</div>
			</div>
			<div class="column-ns-btta column-ns-btta-container">
				<div class="ns-label-container-btta">
					Border input, border button
				</div>
				<div class="ns-input-container-btta">
					<input type="color" id="ns_mm_sbl_border_color" value="<?php echo esc_html(get_option('ns_mm_sbl_border_color', '#FFFFFF')); ?>" name="ns_mm_sbl_border_color" />
				</div>
			</div>
		</div>

		<div class="ns-mm-section-box">
			<div class="column-ns-btta">
				<div class="ns-mm-title-container">
					<h2>TEXT, FOOTER AND FONT</h2>
				</div>
			</div>

			<div class="column-ns-btta">
				<div class="ns-label-container-btta">
					Title Text
				</div>
				<div class="ns-input-container-btta">
					<input type="text" id="ns_mm_title_text" value="<?php echo esc_html(get_option('ns_mm_title_text', 'STAY UPDATE!')); ?>" name="ns_mm_title_text" />
				</div>
				<div class="ns-label-container-btta">
					Subtitle Text
				</div>
				<div class="ns-input-container-btta">
					<input type="text" id="ns_mm_subtitle_text" value="<?php echo esc_html(get_option('ns_mm_subtitle_text', 'Subscribe for latest update on our website')); ?>" name="ns_mm_subtitle_text" />
				</div>
			</div>
			<div class="column-ns-btta">
				<div class="ns-label-container-btta">
					Footer text
				</div>
				<div class="ns-input-container-btta">
					<textarea id="ns_mm_footer_text" name="ns_mm_footer_text"><?php echo esc_html(get_option('ns_mm_footer_text', 'Powered by <a href="http://www.nsthemes.com">NsThemes</a> | <i class="fa fa-copyright"></i> 2015-2016')); ?></textarea>
				</div>
				<div class="ns-label-container-btta">
					Font
				</div>
				<div class="ns-input-container-btta">
						<select name="ns_mm_text_font">
							<option value="">...choose</option>
						<?php 
						foreach ($ns_mm_fonts as $font){
							if(get_option('ns_mm_text_font', 'Lato') == $font) {$sel = ' selected';} else {$sel = '';}
							echo '<option value="'.$font.'"'.$sel.'>'.$font.'</option>';
							}
						?>
						</select>	
				</div>
			</div>
				
		</div>
		<div class="ns-mm-section-box">
			<div class="column-ns-btta">
				<div class="ns-mm-title-container">
					<h2>reCAPTCHA</h2>
				</div>
			</div>
			
			<div class="column-ns-btta">
				<div class="ns-label-container-btta">
					Enable reCAPTCHA
				</div>
				
				<div class="ns-input-container-btta">
					<select name="ns_mm_rec_enabled">
						<option value="">...choose</option>
						<option value="yes" <?php if(get_option('ns_mm_rec_enabled')=='yes') echo 'selected'; ?>>Yes</option>
						<option value="no" <?php if(get_option('ns_mm_rec_enabled')=='no') echo 'selected';   ?>>No</option>
					</select>	
				</div>
				<div class="ns-label-container-btta">
					Create your API keys <a href="https://www.google.com/recaptcha/admin/create" target="_blank">here</a><br>
					Choose: reCAPTCHA v2 option<br>
					And select: 'I'm not a robot'
				</div>
				<div class="ns-label-container-btta">
					Site key
				</div>
				<div class="ns-input-container-btta">
					<input type="text" id="ns_mm_title_text" placeholder="Insert site key" value="<?php echo esc_html(get_option('ns_mm_site_key')); ?>" name="ns_mm_site_key" />
				</div>
				<div class="ns-label-container-btta">
					Secret Key
				</div>
				<div class="ns-input-container-btta">
					<input type="text" id="ns_mm_title_text" placeholder="Insert secret key" value="<?php echo esc_html(get_option('ns_mm_secret_key')); ?>" name="ns_mm_secret_key" />
				</div>
			</div>				
		</div>
		<div class="column-ns-btta">								
			<div class="ns-submit-container-btta">
				<input type="submit" class="button-primary ns-mm-submit-btn" id="submit" name="submit" value="<?php _e('Save Changes') ?>" />
			</div>
		</div>
	</div> <!-- chiuso background -->

</form>