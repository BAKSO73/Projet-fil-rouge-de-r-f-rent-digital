<?php
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

$follows = (array) wpfval( WPF()->current_object, 'follows' );
?>

<div class="wpforo-following">
    <?php do_action( 'wpforo_template_profile_following_head_bar', $follows ); ?>

    <h3 class="wpf-tab-subtitle"><?php wpforo_phrase('Following') ?></h3>

	<?php if( $follows ) : ?>
        <div class="wpforo-following-list">
            <?php
            foreach( $follows as $follow ) {
	            if( $follow['itemtype'] === 'user' ) {
		            if( $user = WPF()->member->get_member( $follow['itemid'] ) ){
			            $user_url = WPF()->member->get_profile_url( $user['userid'] );
			            printf(
				            '<div class="wpforo-follower">
                                <div class="follower-avatar"><a href="%2$s">%1$s</a></div>
                                <div class="follower-title"><a href="%2$s">%3$s</a></div>
                                <div class="sbn-action">%4$s</div>
                            </div>',
				            WPF()->member->get_avatar( $user['userid'], 'width="64"', 64 ),
				            esc_url( $user_url ),
				            esc_html( wpforo_user_dname( $user ) ),
				            (
                                ( WPF()->current_object['user_is_same_current_user'] || wpforo_current_user_is( 'admin' ) )
                                ? sprintf(
                                    '<a href="%1$s" title="%2$s"><i class="fas fa-bell-slash"></i> %2$s</a>',
                                    esc_url( $follow['unfollow_link'] ),
                                    wpforo_phrase( 'Unfollow', false )
                                ) : ''
                            )
			            );
		            }
	            }
            }
            ?>
        </div>
        <div class="sbn-foot">
			<?php wpforo_template_pagenavi() ?>
        </div>
	<?php else : ?>
        <p class="wpf-p-error"> <?php wpforo_phrase( 'No following found for this member.' ) ?> </p>
	<?php endif; ?>
</div>
