<?php
/*
Plugin Name: Koshinski - Visual Maxlength
Plugin URI:
Description: Dieses Wordpress Plugin bietet eine visuelle Unterstützung bei Eingabefeldern mit dem <code>maxlength</code> Attribut über die verbleibende Zeichenzahl.
Version: 1.0
Author: koshinski
Author Email: kosh@koshinski.de
Author URI: http://www.koshinski.de/
License:

  Copyright 2014 koshinski (kosh@koshinski.de)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

if ( ! defined( 'ABSPATH' ) ) wp_die();

class Maxlength {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Maxlength';
	const slug = 'maxlength';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'install_maxlength' ) );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_maxlength' ) );
	}
  
	/**
	 * Runs when the plugin is activated
	 */  
	function install_maxlength() {
		// do not generate any output here
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	function init_maxlength() {
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();
	}

	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( !is_admin() ) {
			$this->load_file( self::slug . '-script', '/js/maxlength.min.js', true );
			$this->load_file( self::slug . '-style', '/css/maxlength.css' );
		}
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file

} // end class
new Maxlength();

