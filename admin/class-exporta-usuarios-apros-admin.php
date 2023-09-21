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
			'Exportar Reclamos', // title page
			'Exportar Reclamos', // title menu
			'manage_options',
			'export-users', // slug
			'export_users_menu_page', // function
			'dashicons-database-export',
			2
		);
	}

	public function export_data_reclamos_csv(){

		// pdfUrl.meta_value AS pdfUrl,
		// adjunto.meta_value AS adjunto
		// LEFT JOIN {$wpdb->prefix}postmeta pdfUrl ON u.ID = pdfUrl.post_id AND pdfUrl.meta_key = 'pdf-url'
		// LEFT JOIN {$wpdb->prefix}postmeta adjunto ON u.ID = adjunto.post_id AND adjunto.meta_key = 'adjunto'
		global $wpdb;
    	$data_query = $wpdb->get_results( "
		SELECT
			esUnaPrueba.meta_value AS esUnaPrueba,
			ano.meta_value AS ano,
			fecha.meta_value AS fecha,
			codigoReclamo.meta_value AS codigoReclamo,
			depatarmento.meta_value AS depatarmento,
			provincia.meta_value AS provincia,
			distrito.meta_value AS distrito,
			hora.meta_value AS hora,
			pdfInformacion.meta_value AS pdfInformacion,
			idProyecto.meta_value AS idProyecto,
			alias.meta_value AS alias,
			proyecto.meta_value AS proyecto,
			nombre.meta_value AS nombre,
			apellidoPaterno.meta_value AS apellidoPaterno,
			apellidosMaterno.meta_value AS apellidosMaterno,
			mayorEdad.meta_value AS mayorEdad,
			tutor.meta_value AS tutor,
			domicilioApoderado.meta_value AS domicilioApoderado,
			telefono.meta_value AS telefono,
			correo.meta_value AS correo,
			tipoDocumento.meta_value AS tipoDocumento,
			nroDocumento.meta_value AS nroDocumento,
			direccion.meta_value AS direccion,
			referencia.meta_value AS referencia,
			departamentoId.meta_value AS departamentoId,
			provinciaId.meta_value AS provinciaId,
			distritoId.meta_value AS distritoId,
			tipoBien.meta_value AS tipoBien,
			pdfTipoBien.meta_value AS pdfTipoBien,
			monto.meta_value AS monto,
			detalleReclamacion.meta_value AS detalleReclamacion,
			pdfDetalleReclamacion.meta_value AS pdfDetalleReclamacion,
			textoDetalleReclamacion.meta_value AS textoDetalleReclamacion,
			peticion.meta_value AS peticion
		FROM {$wpdb->prefix}posts u
		LEFT JOIN {$wpdb->prefix}postmeta esUnaPrueba ON u.ID = esUnaPrueba.post_id AND esUnaPrueba.meta_key = 'es-una-prueba'
		LEFT JOIN {$wpdb->prefix}postmeta ano ON u.ID = ano.post_id AND ano.meta_key = 'ano'
		LEFT JOIN {$wpdb->prefix}postmeta fecha ON u.ID = fecha.post_id AND fecha.meta_key = 'fecha'
		LEFT JOIN {$wpdb->prefix}postmeta codigoReclamo ON u.ID = codigoReclamo.post_id AND codigoReclamo.meta_key = 'codigo-reclamo'
		LEFT JOIN {$wpdb->prefix}postmeta depatarmento ON u.ID = depatarmento.post_id AND depatarmento.meta_key = 'departamento'
		LEFT JOIN {$wpdb->prefix}postmeta provincia ON u.ID = provincia.post_id AND provincia.meta_key = 'provincia'
		LEFT JOIN {$wpdb->prefix}postmeta distrito ON u.ID = distrito.post_id AND distrito.meta_key = 'distrito'
		LEFT JOIN {$wpdb->prefix}postmeta hora ON u.ID = hora.post_id AND hora.meta_key = 'hora'
		LEFT JOIN {$wpdb->prefix}postmeta pdfInformacion ON u.ID = pdfInformacion.post_id AND pdfInformacion.meta_key = 'pdf-informacion'
		LEFT JOIN {$wpdb->prefix}postmeta idProyecto ON u.ID = idProyecto.post_id AND idProyecto.meta_key = 'id-proyecto'
		LEFT JOIN {$wpdb->prefix}postmeta alias ON u.ID = alias.post_id AND alias.meta_key = 'alias'
		LEFT JOIN {$wpdb->prefix}postmeta proyecto ON u.ID = proyecto.post_id AND proyecto.meta_key = 'proyecto'
		LEFT JOIN {$wpdb->prefix}postmeta nombre ON u.ID = nombre.post_id AND nombre.meta_key = 'nombre'
		LEFT JOIN {$wpdb->prefix}postmeta apellidoPaterno ON u.ID = apellidoPaterno.post_id AND apellidoPaterno.meta_key = 'apellido-paterno'
		LEFT JOIN {$wpdb->prefix}postmeta apellidosMaterno ON u.ID = apellidosMaterno.post_id AND apellidosMaterno.meta_key = 'apellido-materno'
		LEFT JOIN {$wpdb->prefix}postmeta mayorEdad ON u.ID = mayorEdad.post_id AND mayorEdad.meta_key = 'mayor-edad'
		LEFT JOIN {$wpdb->prefix}postmeta tutor ON u.ID = tutor.post_id AND tutor.meta_key = 'tutor'
		LEFT JOIN {$wpdb->prefix}postmeta domicilioApoderado ON u.ID = domicilioApoderado.post_id AND domicilioApoderado.meta_key = 'domicilio-apoderado'
		LEFT JOIN {$wpdb->prefix}postmeta telefono ON u.ID = telefono.post_id AND telefono.meta_key = 'telefono'
		LEFT JOIN {$wpdb->prefix}postmeta correo ON u.ID = correo.post_id AND correo.meta_key = 'correo'
		LEFT JOIN {$wpdb->prefix}postmeta tipoDocumento ON u.ID = tipoDocumento.post_id AND tipoDocumento.meta_key = 'tipo-documento'
		LEFT JOIN {$wpdb->prefix}postmeta nroDocumento ON u.ID = nroDocumento.post_id AND nroDocumento.meta_key = 'nro-documento'
		LEFT JOIN {$wpdb->prefix}postmeta direccion ON u.ID = direccion.post_id AND direccion.meta_key = 'direccion'
		LEFT JOIN {$wpdb->prefix}postmeta referencia ON u.ID = referencia.post_id AND referencia.meta_key = 'referencia'
		LEFT JOIN {$wpdb->prefix}postmeta departamentoId ON u.ID = departamentoId.post_id AND departamentoId.meta_key = 'departamento_id'
		LEFT JOIN {$wpdb->prefix}postmeta provinciaId ON u.ID = provinciaId.post_id AND provinciaId.meta_key = 'provincia_id'
		LEFT JOIN {$wpdb->prefix}postmeta distritoId ON u.ID = distritoId.post_id AND distritoId.meta_key = 'distrito_id'
		LEFT JOIN {$wpdb->prefix}postmeta tipoBien ON u.ID = tipoBien.post_id AND tipoBien.meta_key = 'tipo-bien'
		LEFT JOIN {$wpdb->prefix}postmeta pdfTipoBien ON u.ID = pdfTipoBien.post_id AND pdfTipoBien.meta_key = 'pdf-tipo-bien'
		LEFT JOIN {$wpdb->prefix}postmeta monto ON u.ID = monto.post_id AND monto.meta_key = 'monto'
		LEFT JOIN {$wpdb->prefix}postmeta detalleReclamacion ON u.ID = detalleReclamacion.post_id AND detalleReclamacion.meta_key = 'detalle-reclamacion'
		LEFT JOIN {$wpdb->prefix}postmeta pdfDetalleReclamacion ON u.ID = pdfDetalleReclamacion.post_id AND pdfDetalleReclamacion.meta_key = 'pdf-detalle-reclamacion'
		LEFT JOIN {$wpdb->prefix}postmeta textoDetalleReclamacion ON u.ID = textoDetalleReclamacion.post_id AND textoDetalleReclamacion.meta_key = 'texto-detalle-reclamacion'
		LEFT JOIN {$wpdb->prefix}postmeta peticion ON u.ID = peticion.post_id AND peticion.meta_key = 'peticion'
		WHERE 1=1
			AND u.ID > 0
			AND codigoReclamo.meta_value IS NOT NULL
		ORDER BY fecha.meta_value ASC",ARRAY_A);
		
		$columns = array(
			"esUnaPrueba",
			"ano",
			"fecha",
			"codigoReclamo",
			"depatarmento",
			"provincia",
			"distrito",
			"hora",
			// "pdfUrl",
			"pdfInformacion",
			"idProyecto",
			"alias",
			"proyecto",
			"nombre",
			"apellidoPaterno",
			"apellidosMaterno",
			"mayorEdad",
			"tutor",
			"domicilioApoderado",
			"telefono",
			"correo",
			"tipoDocumento",
			"nroDocumento",
			"direccion",
			"referencia",
			"departamentoId",
			"provinciaId",
			"distritoId",
			"tipoBien",
			"pdfTipoBien",
			"monto",
			"detalleReclamacion",
			"pdfDetalleReclamacion",
			"textoDetalleReclamacion",
			"peticion",
			// "adjunto"
		);



		$writer = League\Csv\Writer::createFromString('');

		$writer->insertOne($columns);

		$writer->insertAll($data_query);

		$csv = $writer->getContent();

		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="Reclamos.csv"');

		echo $csv;
		// $writer->save('hello world.xlsx');
	}

	public function export_data_reclamos_excel(){
		
		global $wpdb;

		$data_query = $wpdb->get_results( "
		SELECT
			esUnaPrueba.meta_value AS esUnaPrueba,
			ano.meta_value AS ano,
			fecha.meta_value AS fecha,
			codigoReclamo.meta_value AS codigoReclamo,
			depatarmento.meta_value AS depatarmento,
			provincia.meta_value AS provincia,
			distrito.meta_value AS distrito,
			hora.meta_value AS hora,
			pdfInformacion.meta_value AS pdfInformacion,
			idProyecto.meta_value AS idProyecto,
			alias.meta_value AS alias,
			proyecto.meta_value AS proyecto,
			nombre.meta_value AS nombre,
			apellidoPaterno.meta_value AS apellidoPaterno,
			apellidosMaterno.meta_value AS apellidosMaterno,
			mayorEdad.meta_value AS mayorEdad,
			tutor.meta_value AS tutor,
			domicilioApoderado.meta_value AS domicilioApoderado,
			telefono.meta_value AS telefono,
			correo.meta_value AS correo,
			tipoDocumento.meta_value AS tipoDocumento,
			nroDocumento.meta_value AS nroDocumento,
			direccion.meta_value AS direccion,
			referencia.meta_value AS referencia,
			departamentoId.meta_value AS departamentoId,
			provinciaId.meta_value AS provinciaId,
			distritoId.meta_value AS distritoId,
			tipoBien.meta_value AS tipoBien,
			pdfTipoBien.meta_value AS pdfTipoBien,
			monto.meta_value AS monto,
			detalleReclamacion.meta_value AS detalleReclamacion,
			pdfDetalleReclamacion.meta_value AS pdfDetalleReclamacion,
			textoDetalleReclamacion.meta_value AS textoDetalleReclamacion,
			peticion.meta_value AS peticion
		FROM {$wpdb->prefix}posts u
		LEFT JOIN {$wpdb->prefix}postmeta esUnaPrueba ON u.ID = esUnaPrueba.post_id AND esUnaPrueba.meta_key = 'es-una-prueba'
		LEFT JOIN {$wpdb->prefix}postmeta ano ON u.ID = ano.post_id AND ano.meta_key = 'ano'
		LEFT JOIN {$wpdb->prefix}postmeta fecha ON u.ID = fecha.post_id AND fecha.meta_key = 'fecha'
		LEFT JOIN {$wpdb->prefix}postmeta codigoReclamo ON u.ID = codigoReclamo.post_id AND codigoReclamo.meta_key = 'codigo-reclamo'
		LEFT JOIN {$wpdb->prefix}postmeta depatarmento ON u.ID = depatarmento.post_id AND depatarmento.meta_key = 'departamento'
		LEFT JOIN {$wpdb->prefix}postmeta provincia ON u.ID = provincia.post_id AND provincia.meta_key = 'provincia'
		LEFT JOIN {$wpdb->prefix}postmeta distrito ON u.ID = distrito.post_id AND distrito.meta_key = 'distrito'
		LEFT JOIN {$wpdb->prefix}postmeta hora ON u.ID = hora.post_id AND hora.meta_key = 'hora'
		LEFT JOIN {$wpdb->prefix}postmeta pdfInformacion ON u.ID = pdfInformacion.post_id AND pdfInformacion.meta_key = 'pdf-informacion'
		LEFT JOIN {$wpdb->prefix}postmeta idProyecto ON u.ID = idProyecto.post_id AND idProyecto.meta_key = 'id-proyecto'
		LEFT JOIN {$wpdb->prefix}postmeta alias ON u.ID = alias.post_id AND alias.meta_key = 'alias'
		LEFT JOIN {$wpdb->prefix}postmeta proyecto ON u.ID = proyecto.post_id AND proyecto.meta_key = 'proyecto'
		LEFT JOIN {$wpdb->prefix}postmeta nombre ON u.ID = nombre.post_id AND nombre.meta_key = 'nombre'
		LEFT JOIN {$wpdb->prefix}postmeta apellidoPaterno ON u.ID = apellidoPaterno.post_id AND apellidoPaterno.meta_key = 'apellido-paterno'
		LEFT JOIN {$wpdb->prefix}postmeta apellidosMaterno ON u.ID = apellidosMaterno.post_id AND apellidosMaterno.meta_key = 'apellido-materno'
		LEFT JOIN {$wpdb->prefix}postmeta mayorEdad ON u.ID = mayorEdad.post_id AND mayorEdad.meta_key = 'mayor-edad'
		LEFT JOIN {$wpdb->prefix}postmeta tutor ON u.ID = tutor.post_id AND tutor.meta_key = 'tutor'
		LEFT JOIN {$wpdb->prefix}postmeta domicilioApoderado ON u.ID = domicilioApoderado.post_id AND domicilioApoderado.meta_key = 'domicilio-apoderado'
		LEFT JOIN {$wpdb->prefix}postmeta telefono ON u.ID = telefono.post_id AND telefono.meta_key = 'telefono'
		LEFT JOIN {$wpdb->prefix}postmeta correo ON u.ID = correo.post_id AND correo.meta_key = 'correo'
		LEFT JOIN {$wpdb->prefix}postmeta tipoDocumento ON u.ID = tipoDocumento.post_id AND tipoDocumento.meta_key = 'tipo-documento'
		LEFT JOIN {$wpdb->prefix}postmeta nroDocumento ON u.ID = nroDocumento.post_id AND nroDocumento.meta_key = 'nro-documento'
		LEFT JOIN {$wpdb->prefix}postmeta direccion ON u.ID = direccion.post_id AND direccion.meta_key = 'direccion'
		LEFT JOIN {$wpdb->prefix}postmeta referencia ON u.ID = referencia.post_id AND referencia.meta_key = 'referencia'
		LEFT JOIN {$wpdb->prefix}postmeta departamentoId ON u.ID = departamentoId.post_id AND departamentoId.meta_key = 'departamento_id'
		LEFT JOIN {$wpdb->prefix}postmeta provinciaId ON u.ID = provinciaId.post_id AND provinciaId.meta_key = 'provincia_id'
		LEFT JOIN {$wpdb->prefix}postmeta distritoId ON u.ID = distritoId.post_id AND distritoId.meta_key = 'distrito_id'
		LEFT JOIN {$wpdb->prefix}postmeta tipoBien ON u.ID = tipoBien.post_id AND tipoBien.meta_key = 'tipo-bien'
		LEFT JOIN {$wpdb->prefix}postmeta pdfTipoBien ON u.ID = pdfTipoBien.post_id AND pdfTipoBien.meta_key = 'pdf-tipo-bien'
		LEFT JOIN {$wpdb->prefix}postmeta monto ON u.ID = monto.post_id AND monto.meta_key = 'monto'
		LEFT JOIN {$wpdb->prefix}postmeta detalleReclamacion ON u.ID = detalleReclamacion.post_id AND detalleReclamacion.meta_key = 'detalle-reclamacion'
		LEFT JOIN {$wpdb->prefix}postmeta pdfDetalleReclamacion ON u.ID = pdfDetalleReclamacion.post_id AND pdfDetalleReclamacion.meta_key = 'pdf-detalle-reclamacion'
		LEFT JOIN {$wpdb->prefix}postmeta textoDetalleReclamacion ON u.ID = textoDetalleReclamacion.post_id AND textoDetalleReclamacion.meta_key = 'texto-detalle-reclamacion'
		LEFT JOIN {$wpdb->prefix}postmeta peticion ON u.ID = peticion.post_id AND peticion.meta_key = 'peticion'
		WHERE 1=1
			AND u.ID > 0
			AND codigoReclamo.meta_value IS NOT NULL
		ORDER BY fecha.meta_value ASC",ARRAY_A);

		$spreadsheet = new PhpOffice\PhpSpreadsheet\Writer\Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$columns = array(
			"esUnaPrueba",
			"ano",
			"fecha",
			"codigoReclamo",
			"depatarmento",
			"provincia",
			"distrito",
			"hora",
			"pdfInformacion",
			"idProyecto",
			"alias",
			"proyecto",
			"nombre",
			"apellidoPaterno",
			"apellidosMaterno",
			"mayorEdad",
			"tutor",
			"domicilioApoderado",
			"telefono",
			"correo",
			"tipoDocumento",
			"nroDocumento",
			"direccion",
			"referencia",
			"departamentoId",
			"provinciaId",
			"distritoId",
			"tipoBien",
			"pdfTipoBien",
			"monto",
			"detalleReclamacion",
			"pdfDetalleReclamacion",
			"textoDetalleReclamacion",
			"peticion",
		);

		$columnIndex = 1;
		foreach ($columns as $column) {
			$sheet->setCellValueByColumnAndRow($columnIndex, 1, $column);
			$columnIndex++;
		}

		$row = 2;
		foreach ($data_query as $data) {
			$columnIndex = 1;
			foreach ($columns as $column) {
				$sheet->setCellValueByColumnAndRow($columnIndex, $row, $data[$column]);
				$columnIndex++;
			}
			$row++;
		}


		$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

		// ob_start();
		// $writer->save('php://output');
		// $content = ob_get_contents();
		// ob_end_clean();
		// $writer->save($excelFilePath);
		// Definir las cabeceras para que el navegador descargue un archivo Excel

		// ob_start();
		// $writer->save('php://output');
		// $content = ob_get_contents();
		// ob_end_clean();

		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="Reclamos.xlsx"');

		// echo $content;

		// header('Content-Type: application/vnd.ms-excel');
		// header('Content-Disposition: attachment;filename="Reclamos.xls"');
		// header('Cache-Control: max-age=0');
		
		// $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
		// $writer->save('php://output');



		// $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
		// $activeWorksheet = $spreadsheet->getActiveSheet();
		// $activeWorksheet->setCellValue('A1', 'Hello World !');

		// $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

		$uploads = wp_upload_dir();
		$time_now = time();
		$uploads_dir = $uploads['basedir'] . '/apros_export_reclamos';
		$uploads_dir_web = $uploads['baseurl'] . '/apros_export_reclamos';
		$path_file = $uploads_dir."/Reclamos-$time_now.XLSX";
		$path_file_web = $uploads_dir_web."/Reclamos-$time_now.XLSX";

		if(!wp_mkdir_p($uploads_dir)):

			$data = array(
				"mensaje" => "No se creo la carpeta"
			);
			return wp_send_json_success( $data);
			
		endif;
		
		$writer->save($path_file);

		$data = array(
			"mensaje" => "Datos guardados",
			"url" => $path_file_web
		);

		return wp_send_json_success( $data);		

	}

}

function export_users_menu_page(){
    include_once EUA_URL_PLUGIN . 'admin/partials/exporta-usuarios-apros-admin-display.php';
}