<?php
/*
Plugin Name: Make it Yours
Description: Customize your theme with advanced panels for CSS and PHP
Version: 0.1.2
Author: Hassan Derakhshandeh

		* 	Copyright (C) 2011  Hassan Derakhshandeh
		*	http://tween.ir/
		*	hassan.derakhshandeh@gmail.com

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( MIY_VERSION, '0.1.2' );

class Make_It_Yours {

	private $textdomain;
	private $custom_css_key;
	private $custom_functions_key;
	private $scrollto;

	function Make_It_Yours() {
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'after_setup_theme', array( &$this, 'exec_custom_functions' ) );
		add_action( 'wp_head', array( &$this, 'custom_css' ), 100 );
		add_action( 'miy_custom_css', array( &$this, 'minify_css' ) );

		$this->custom_css_key = get_stylesheet() . '_custom_css';
		$this->custom_functions_key = get_stylesheet() . '_custom_functions';
	}

	function admin_menu() {
		$cpage = add_submenu_page( 'themes.php', __( 'Custom CSS', $this->textdomain ), __( 'Custom CSS', $this->textdomain ), 'manage_options', 'custom-css', array( &$this, 'custom_css_page' ) );
		$fpage = add_submenu_page( 'themes.php', __( 'Custom Functions', $this->textdomain ), __( 'Custom Functions', $this->textdomain ), 'manage_options', 'custom-functions', array( &$this, 'custom_functions_page' ) );

		add_action( "load-{$cpage}", array( &$this, 'save_user_css' ) );
		add_action( "load-{$fpage}", array( &$this, 'save_user_functions' ) );
		add_action( "admin_print_styles-{$cpage}", array( &$this, 'admin_queue' ) );
		add_action( "admin_print_styles-{$fpage}", array( &$this, 'admin_queue' ) );
	}

	function custom_css_page() {
		require_once( dirname( __FILE__ ) . '/screens/custom-css.php' );
	}

	function custom_functions_page() {
		require_once( dirname( __FILE__ ) . '/screens/custom-functions.php' );
	}

	function admin_queue() {
		wp_enqueue_style( 'make-it-yours', plugins_url( 'css/admin.css', __FILE__ ), array( 'farbtastic' ), MIY_VERSION );
		wp_enqueue_script( 'make-it-yours', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery', 'farbtastic' ), MIY_VERSION );
	}

	function save_user_css() {
		if( isset( $_POST['custom-css'] ) ) {
			update_option( $this->custom_css_key, stripcslashes( $_POST['custom-css'] ) );
			$location = "themes.php?page=custom-css&scrollto=" . ( isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0 );
			header( "Location: $location" );
		}
	}

	function save_user_functions() {
		if( isset( $_POST['custom-functions'] ) ) {
			update_option( $this->custom_functions_key, stripcslashes( $_POST['custom-functions'] ) );
			$location = "themes.php?page=custom-functions&scrollto=" . ( isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0 );
			header( "Location: $location" );
		}
	}

	/**
	 * Run "Custom Functions" using PHP Eval.
	 *
	 * @since 0.1
	 * @since 0.1.1 we hook this to 'after_setup_theme'
	 */
	function exec_custom_functions() {
		$user_functions = get_option( $this->custom_functions_key );
		$user_functions = trim( $user_functions );
		$user_functions = trim( $user_functions, '<?php' );
		if( $user_functions )
			if( false === @eval( $user_functions ) ) {
				// error
			}
	}

	function custom_css() {
		echo '<style>' . apply_filters( 'miy_custom_css', get_option( $this->custom_css_key ) ) . '</style>';
	}

	/**
	 * Removes white-spaces and comments to minify the $css.
	 *
	 * Props to Karthik Viswanathan
	 * @link http://www.lateralcode.com/css-minifier/
	 *
	 * @return string $css
	 */
	function minify_css( $css ) {
		$css = preg_replace( '#\s+#', ' ', $css );
		$css = preg_replace( '#/\*.*?\*/#s', '', $css );
		$css = str_replace( '; ', ';', $css );
		$css = str_replace( ': ', ':', $css );
		$css = str_replace( ' {', '{', $css );
		$css = str_replace( '{ ', '{', $css );
		$css = str_replace( ', ', ',', $css );
		$css = str_replace( '} ', '}', $css );
		$css = str_replace( ';}', '}', $css );

		return trim( $css );
	}
}
new Make_It_Yours();