<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- HTML, CSS and JS made by NsThemes , https://www.nsthemes.com -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php 
        wp_head(); 
		$isMailSent = false;
		$isReCaptcha = get_option('ns_mm_rec_enabled');
		if($isReCaptcha == 'yes')
			$isReCaptcha = true;
		else
			$isReCaptcha = false;

		if($isReCaptcha){
			$site_key = get_option('ns_mm_site_key');
			$secret_key = get_option('ns_mm_secret_key');
			if(isset($_POST['submit'])){
				$sender_name = stripslashes($_POST["ns-maintenance-mode-name"]);
				$sender_email = stripslashes($_POST["ns-maintenance-mode-email"]);
				$response = $_POST["g-recaptcha-response"];
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$data = array(
					'secret' => $secret_key,
					'response' => $_POST["g-recaptcha-response"]
				);
				$options = array(
					'http' => array (
						'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
						'method' => 'POST',
						'content' => http_build_query($data)
					)
				);
				$context  = stream_context_create($options);
				$verify = file_get_contents($url, false, $context);
				$captcha_success=json_decode($verify);
				if ($captcha_success->success==false) {
					// echo "<p>You are a bot! Go away!</p>";
				} else if ($captcha_success->success==true) {
			
					if (isset($_REQUEST['ns-maintenance-mode-sent']) && $_REQUEST['ns-maintenance-mode-sent'] != ''){
					// Create post object
						$my_post = array(
							'post_title'    => 'Subscription',
							'post_content'  => '',
							'post_status'   => 'publish',
							'post_type'     => 'subscriber',
						);
						
						$name = sanitize_text_field($_REQUEST['ns-maintenance-mode-name']);
						$email = sanitize_email($_REQUEST['ns-maintenance-mode-email']);
						
						if(is_email($email)){
							// Insert the post into the database
							$post_id = wp_insert_post( $my_post );
							if($name && $name != ''){
								
								update_post_meta($post_id, 'ns-maintenance-mode-name', $name);
							}
							if($email && $email != ''){
								
								update_post_meta($post_id, 'ns-maintenance-mode-email', $email);
							}
			
							$objectmm = "New subscription to ".get_bloginfo( 'name' );
							$message = "Hi,<br> a new user subscribe to your email";
							$message .= "<br> Name: <b>".$name."</b>";
							$message .= "<br> Email:  <b>".$email."</b>";
							$message .= "<br><br> This email was sent by Maintenance Mode";
			
							wp_mail( get_option( 'admin_email' ), $objectmm , ns_mm_mail_template($message) );
							echo '<div class="mm-spaghetti-mailsent" id="mm-spaghetti-mailsent">Your email was sent.</div>';
							$isMailSent = true;
						}
						else{
							echo '<div class="mm-spaghetti-mailsent" id="mm-spaghetti-mailsent" style="border: 1px solid #AA0101 !important;">Your email is not valid.</div>';
						}
					}
				}
			}
		}else{
			if (isset($_REQUEST['ns-maintenance-mode-sent']) && $_REQUEST['ns-maintenance-mode-sent'] != ''){
				// Create post object
				$my_post = array(
					'post_title'    => 'Subscription',
					'post_content'  => '',
					'post_status'   => 'publish',
					'post_type'     => 'subscriber',
				);
				
				$name = sanitize_text_field($_REQUEST['ns-maintenance-mode-name']);
				$email = sanitize_email($_REQUEST['ns-maintenance-mode-email']);
				
				if(is_email($email)){
					// Insert the post into the database
					$post_id = wp_insert_post( $my_post );
					if($name && $name != ''){
						
						update_post_meta($post_id, 'ns-maintenance-mode-name', $name);
					}
					if($email && $email != ''){
						
						update_post_meta($post_id, 'ns-maintenance-mode-email', $email);
					}
	
					$objectmm = "New subscription to ".get_bloginfo( 'name' );
					$message = "Hi,<br> a new user subscribe to your email";
					$message .= "<br> Name: <b>".$name."</b>";
					$message .= "<br> Email:  <b>".$email."</b>";
					$message .= "<br><br> This email was sent by Maintenance Mode";
	
					wp_mail( get_option( 'admin_email' ), $objectmm , ns_mm_mail_template($message) );
					echo '<div class="mm-spaghetti-mailsent" id="mm-spaghetti-mailsent">Your email was sent.</div>';
					$isMailSent = true;
				}
				else{
					echo '<div class="mm-spaghetti-mailsent" id="mm-spaghetti-mailsent" style="border: 1px solid #AA0101 !important;">Your email is not valid.</div>';
				}
			}
		}
        ?> 
      <!-- head home -->
   </head>
   <body>
      <div class="bgLauncher">
      <div class="row" style="margin: 0px; max-width: unset;">
         <div class="col-md-12" style="height:100px;">
         </div>
         <div class="col-md-12 col-sm-12">
            <div class="col-md-3 col-sm-3">
            </div>
            <div class="col-md-6 col-sm-6">
               	<div class="col-md-12 snack ns-mm-txt-color">
                  	<h1><?php echo esc_html(get_option('ns_mm_title_text', 'STAY UPDATE!')); ?></h1>
               	</div>
               	<div class="col-md-12 spaghetti ns-mm-txt-color">
                  	<h2><?php echo esc_html(get_option('ns_mm_subtitle_text', 'Subscribe for latest update on our website')); ?></h2>
               	</div>
			   	<?php
					if($isReCaptcha)
						echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
                ?>
               <form method="POST" action="?" name="mm-subscription" id="mm-subscription">
                  	<?php
                     	if(!$isMailSent){
                    ?>
							<div class="col-md-12" style="margin-top: 30px;">
								<input type="text" class="form-control NSnome" placeholder="INSERT YOUR NAME HERE" name="ns-maintenance-mode-name" required>
							</div>
							<div class="col-md-12">
								<input type="text" class="form-control NSmail" placeholder="INSERT YOUR EMAIL HERE" name="ns-maintenance-mode-email" required>
							</div>
							<div class="col-md-12">
								<?php
									if($isReCaptcha)
										echo "<div class=\"captcha_wrapper\">
											<div class=\"g-recaptcha\" data-sitekey=\"$site_key\"></div>
										</div>";
						}
								?>
							</div>
							<div class="col-md-12" style="margin-top:20px;">
								<?php
									if(!$isMailSent){
								?>
									<div class="col-md-6" style="text-align: right; float: right !important; padding: 0px !important;">
										<button id="submit" type="submit" name="submit" class="btn btn-default buttone">Sign up</button>
									</div>
									<div class="col-md-6 mt-2" style="text-align: left; padding: 0px !important; max-width: 200px;">
										<a href="<?php echo esc_html(get_option('ns_mm_facebook_icon_link', '#')); ?>"><i class="fa fa-facebook-square fa-3x socialll"></i></a><a href="<?php echo esc_html(get_option('ns_mm_twitter_icon_link', '#')); ?>"><i class="fa fa-twitter-square fa-3x socialll"></i></a><a href="<?php echo esc_html(get_option('ns_mm_google_icon_link', '#')); ?>"><i class="fa fa-google-plus-square fa-3x socialll"></i></a>
									</div>
								<?php
									}else{
								?>
									<div class="col-md-12" style="text-align: center; padding: 0px !important; margin-top:140px;">
										<a href="<?php echo esc_html(get_option('ns_mm_facebook_icon_link', '#')); ?>"><i class="fa fa-facebook-square fa-3x socialll"></i></a><a href="<?php echo esc_html(get_option('ns_mm_twitter_icon_link', '#')); ?>"><i class="fa fa-twitter-square fa-3x socialll"></i></a><a href="<?php echo esc_html(get_option('ns_mm_google_icon_link', '#')); ?>"><i class="fa fa-google-plus-square fa-3x socialll"></i></a>
									</div>
								<?php
									}
								?>
							</div>
                     		<input type="hidden" name="ns-maintenance-mode-sent" value="1">
               </form>
               <div class="col-md-12 footNs ns-mm-txt-color">
               <p>
               <?php echo get_option('ns_mm_footer_text', ''); ?>
               </p>
               </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>