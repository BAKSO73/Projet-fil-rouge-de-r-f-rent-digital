<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//LOAD LANGUAGES

//load languages functions
if(!function_exists('nfproot_load_languages')){

	function nfproot_load_languages() {

		load_plugin_textdomain(
			'nfprootlang',
			false,
			NFPROOT_BASE_RELATIVE . '/languages/'
			);

	}
	
}

//do not add errors here, since it is expected that this function is invoked more than once