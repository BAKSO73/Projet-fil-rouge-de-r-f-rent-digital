<?php
header( 'Content-Type: application/javascript' );
define( 'WP_USE_THEMES', false );
$vars_file = '../../cookies-and-content-security-policy-vars.php';
if ( file_exists( $vars_file ) ) {
	require_once( $vars_file );
}
if ( isset( $wp_load_path ) ) {
	require_once( $wp_load_path );
} else {
	require_once( explode( 'wp-content', __FILE__)[0] . 'wp-load.php' );
}
$cacsp_option_frames_js = '';
$contentSecurityPolicyFrame = get_cacsp_options( 'cacsp_option_always_frames', true );
$cookie_filter = false;

if ( isset( $_COOKIE["cookies_and_content_security_policy"] ) ) {
	$cookie_filter = str_replace( '\\', '', $_COOKIE['cookies_and_content_security_policy'] );
}
else if ( isset( $_SERVER["HTTP_X_WPENGINE_SEGMENT"] ) ) {
	$cookie_filter = urldecode( str_replace( '\\', '', $_SERVER["HTTP_X_WPENGINE_SEGMENT"] ) );
}

if ( $cookie_filter ) {
	$cookie_filter_json = json_decode( $cookie_filter );
	if ( $cookie_filter_json ) {
		foreach( $cookie_filter_json as $value ) {
			if ( $value == 'statistics' ) {
				$contentSecurityPolicyFrame .= ' ' . get_cacsp_options( 'cacsp_option_statistics_frames', true );
			} else if ( $value == 'experience' ) {
				$contentSecurityPolicyFrame .= ' ' . get_cacsp_options( 'cacsp_option_experience_frames', true );
			} else if ( $value == 'markerting' ) {
				$contentSecurityPolicyFrame .= ' ' . get_cacsp_options( 'cacsp_option_markerting_frames', true );
			}
		}
	}
}
$cacsp_option_frames_js = cacsp_single_space( $contentSecurityPolicyFrame );
$cookies_and_content_policy_error_message = 'cookiesAndContentPolicyErrorMessage(\'' . $cacsp_option_frames_js . '\', \'' . home_url() . '\');';
echo 'jQuery(window).on("load", function() { ' . $cookies_and_content_policy_error_message . ' });';
echo "\n";
echo 'var mutationTimer;';
echo "\n";
echo 'MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
var observer = new MutationObserver(function(mutations, observer) {
	mutations.forEach(function (mutation) {
        [].filter.call(mutation.addedNodes, function (node) {
            return node.nodeName == "IFRAME";
        }).forEach(function (node) {
			clearTimeout(mutationTimer);
			mutationTimer = setTimeout(function () {
            	' . $cookies_and_content_policy_error_message . '
			}, 1000);
        });
		[].filter.call(mutation.addedNodes, function (node) {
            return node.nodeName == "OBJECT";
        }).forEach(function (node) {
			clearTimeout(mutationTimer);
			mutationTimer = setTimeout(function () {
            	' . $cookies_and_content_policy_error_message . '
			}, 1000);
        });
    });
});
observer.observe(document, {
	attributes: true,
	childList: true,
	attributeOldValue: true,
	subtree: true,
});';
