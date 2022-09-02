<?php
 //if this file is called directly, abort.
if(!defined('ABSPATH')) die('please, do not call this page directly');

//LOAD LANGUAGES

//load languages functions
if(!function_exists('nfpmnm_load_languages')){

	function nfpmnm_load_languages() {

		load_plugin_textdomain(
			'nfpmnmlang',
			false,
			NFPMNM_BASE_RELATIVE . '/languages/'
			);

	}
	
} else {
	
	error_log('NUTSFORPRESS ERROR: function "nfpmnm_load_languages" already exists');
	
}