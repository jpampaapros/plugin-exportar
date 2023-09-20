<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://apros.global/
 * @since      1.0.0
 *
 * @package    Exporta_Usuarios_Apros
 * @subpackage Exporta_Usuarios_Apros/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Exporta_Usuarios_Apros
 * @subpackage Exporta_Usuarios_Apros/admin
 * @author     Apros <vcosta@apros.pe>
 */
class Exporta_Usuarios_Apros_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Exporta_Usuarios_Apros_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Exporta_Usuarios_Apros_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/exporta-usuarios-apros-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Exporta_Usuarios_Apros_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Exporta_Usuarios_Apros_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/exporta-usuarios-apros-admin.js', array( 'jquery' ), $this->version, false );
		
        $name_file = plugin_dir_path(__FILE__) . 'js/exporta-usuarios-apros-admin.js';
        $file_version = date("eua-public", filemtime($name_file));

		wp_register_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__) . 'js/exporta-usuarios-apros-admin.js',
            array('jquery'),
            $file_version,
            true
        );

        wp_localize_script(
            $this->plugin_name,
            'eua',
            array(
                'url' => admin_url('admin-ajax.php'),
            )
        );

		wp_enqueue_script($this->plugin_name);

	}

	public function add_dashboard(){
		add_menu_page(
			'Exportar usuarios', // title page
			'Exportar usuarios', // title menu
			'manage_options',
			'export-users', // slug
			'export_users_menu_page', // function
			'dashicons-database-export',
			2
		);
	}

	public function export_data_users(){

		global $wpdb;
    	$data_query = $wpdb->get_results( "SELECT
		m3.meta_value AS DNI,
		CONCAT (m2.meta_value, ', ', m1.meta_value) AS NOMBRE,
		m4.meta_value AS BANCO,
		m5.meta_value AS NRO_DE_CUENTA
		FROM {$wpdb->prefix}users u
		LEFT JOIN {$wpdb->prefix}usermeta m1 ON u.ID = m1.user_id AND m1.meta_key = 'first_name'
		LEFT JOIN {$wpdb->prefix}usermeta m2 ON u.ID = m2.user_id AND m2.meta_key = 'last_name'
		LEFT JOIN {$wpdb->prefix}usermeta m3 ON u.ID = m3.user_id AND m3.meta_key = 'dni'
		LEFT JOIN {$wpdb->prefix}usermeta m4 ON u.ID = m4.user_id AND m4.meta_key = 'banco'
		LEFT JOIN {$wpdb->prefix}usermeta m5 ON u.ID = m5.user_id AND m5.meta_key = 'nro_de_cuenta'
		WHERE 1=1
			AND u.ID > 0
			AND m3.meta_value != 'dni'
			AND m3.meta_value != 0
			AND m3.meta_value != '0'
		ORDER BY Nombre ASC",ARRAY_A);
		
		$columns = array("DNI", "NOMBRE", "BANCO", "NRO_DE_CUENTA");

		$writer = League\Csv\Writer::createFromString('');

		$writer->insertOne($columns);

		$writer->insertAll($data_query);
		$csv = $writer->getContent();

		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="usuarios.csv"');
		echo $csv;

		/*
				global $wpdb;
    	$data_query = $wpdb->get_results( "SELECT
		u.ID AS user_id,
		u.user_login,
		u.user_nicename,
		u.user_email,
		u.user_registered,
		u.display_name,
		m1.meta_value AS first_name,
		m2.meta_value AS last_name,
		m4.meta_value AS last_campaign,
		m5.meta_value AS user_document,
		m6.meta_value AS user_full_name,
		m7.meta_value AS user_telephone,
		p.reward_id AS user_reward,
		p.reward_name AS user_prize,
		p.reward_code,
		p.date_played AS date_campaign_played
		
		FROM {$wpdb->prefix}users u
		LEFT JOIN {$wpdb->prefix}usermeta m1 ON u.ID = m1.user_id AND m1.meta_key = 'first_name'
		LEFT JOIN {$wpdb->prefix}usermeta m2 ON u.ID = m2.user_id AND m2.meta_key = 'last_name'
		LEFT JOIN {$wpdb->prefix}usermeta m4 ON u.ID = m4.user_id AND m4.meta_key = 'last_campaign'
		LEFT JOIN {$wpdb->prefix}usermeta m5 ON u.ID = m5.user_id AND m5.meta_key = 'user_document'
		LEFT JOIN {$wpdb->prefix}usermeta m6 ON u.ID = m6.user_id AND m6.meta_key = 'user_full_name'
		LEFT JOIN {$wpdb->prefix}usermeta m7 ON u.ID = m7.user_id AND m7.meta_key = 'user_telephone'
		LEFT JOIN {$wpdb->prefix}ctb_data_plays p ON u.ID = p.id_user
		WHERE 1=1
			AND u.ID > 0
		ORDER BY user_id DESC",ARRAY_A);
		
		$columns = array("id_user", "user_login", "user_nicename", "user_email", "user_registered", "display_name", "first_name", "last_name", "last_campaign", "user_document", "user_full_name", "user_telephone", "user_reward","user_prize","reward_code","date_campaign_played");

		$writer = League\Csv\Writer::createFromString('');

		$writer->insertOne($columns);

		$writer->insertAll($data_query);
		$csv = $writer->getContent();

		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="usuarios.csv"');
		echo $csv;
		*/
	}

}

function export_users_menu_page(){
    include_once EUA_URL_PLUGIN . 'admin/partials/exporta-usuarios-apros-admin-display.php';
}