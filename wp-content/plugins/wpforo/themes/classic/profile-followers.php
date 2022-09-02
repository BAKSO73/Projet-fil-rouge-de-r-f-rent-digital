<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

$follows = (array) wpfval( WPF()->current_object, 'follows' );
?>

<div class="wpforo-followers">
    <?php do_action( 'wpforo_template_profile_followers_head_bar', $follows ); ?>

    <h3 class="wpf-tab-subtitle"><?php wpforo_phrase('Followers') ?></h3>

	<?php if( $follows ) : ?>
        <div class="wpforo-followers-list">
			<?php
            foreach( $follows as $follow ) {
				if( $follow['itemtype'] === 'user' ) {
					if( $user = WPF()->member->get_member( $follow['userid'] ) ){
						$user_url = WPF()->member->get_profile_url( $user['userid'] );
						printf(
							'<div class="wpforo-follower">
                                <div class="follower-avatar"><a href="%2$s">%1$s</a></div>
                                <div class="follower-title"><a href="%2$s">%3$s</a></div>
                            </div>',
                            WPF()->member->get_avatar( $user['userid'], 'width="64"', 64 ),
							esc_url( $user_url ),
							esc_html( wpforo_user_dname( $user ) )
						);
					}
				}
			}
            ?>
        </div>
        <div class="followers-foot">
			<?php wpforo_template_pagenavi() ?>
        </div>
	<?php else : ?>
        <p class="wpf-p-error"> <?php wpforo_phrase( 'No followers found for this member.' ) ?> </p>
	<?php endif; ?>
</div>
