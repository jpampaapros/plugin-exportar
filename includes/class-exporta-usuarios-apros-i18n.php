<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://apros.global/
 * @since      1.0.0
 *
 * @package    Exporta_Usuarios_Apros
 * @subpackage Exporta_Usuarios_Apros/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Exporta_Usuarios_Apros
 * @subpackage Exporta_Usuarios_Apros/includes
 * @author     Apros <vcosta@apros.pe>
 */
class Exporta_Usuarios_Apros_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'exporta-usuarios-apros',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
