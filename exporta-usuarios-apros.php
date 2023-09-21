<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://apros.global/
 * @since             1.0.0
 * @package           Exporta_Usuarios_Apros
 *
 * @wordpress-plugin
 * Plugin Name:       Exportar reclamos
 * Plugin URI:        https://https://apros.global/
 * Description:       Exportar reclamos personalizado, hecho por Apros
 * Version:           1.0.0
 * Author:            Apros
 * Author URI:        https://https://apros.global/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       exporta-usuarios-apros
 * Domain Path:       /languages
 */

 require __DIR__ .  '/vendor/autoload.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

global $wpdb;
$pluginName = basename(plugin_dir_path( __FILE__ ));
define( 'EXPORTA_USUARIOS_APROS_VERSION', '1.0.0' );
define('EUA_DATA_TABLE_NAME', $wpdb->prefix.'ctb_data_plays');
define('EUA_TEXT_DOMAIN', 'chapa-tu-bono-jugadas');
define( 'EUA_URL_PLUGIN', plugin_dir_path( __FILE__ ) );
define( 'EUA_URL_PLUGIN_FRONT', site_url().'/wp-content/plugins/'.$pluginName);


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-exporta-usuarios-apros-activator.php
 */
function activate_exporta_usuarios_apros() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exporta-usuarios-apros-activator.php';
	Exporta_Usuarios_Apros_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-exporta-usuarios-apros-deactivator.php
 */
function deactivate_exporta_usuarios_apros() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-exporta-usuarios-apros-deactivator.php';
	Exporta_Usuarios_Apros_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_exporta_usuarios_apros' );
register_deactivation_hook( __FILE__, 'deactivate_exporta_usuarios_apros' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-exporta-usuarios-apros.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_exporta_usuarios_apros() {

	$plugin = new Exporta_Usuarios_Apros();
	$plugin->run();

}
run_exporta_usuarios_apros();
