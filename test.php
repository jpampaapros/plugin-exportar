<?php



require __DIR__ .  '/vendor/autoload.php';

$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A1', 'Hello World !');

$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

// ob_start();
// $writer->save('php://output');
// $content = ob_get_contents();
// ob_end_clean();

// $writer->save('hello world.xlsx');

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="Reclamos.xlsx"');

// header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment;filename="myfile.xls"');
// header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
// $writer->save('php://output');

// $writer->save('world.xls');

// $uploads = wp_upload_dir();
// $uploads_dir = $uploads['basedir'] . '/apros_export_reclamos';

$uploads_dir = "/Users/jpampa/Local Sites/plugin-pdf/app/public/wp-content/uploads/apros_export_reclamos";
wp_mkdir_p($uploads_dir);

$writer->save($uploads_dir.'/world.xls');





// echo $content;
// echo $writer;

// echo '<pre>';
// var_dump($writer);
// echo '</pre>';

// global $wpdb;

// $data_query = $wpdb->get_results( "
// SELECT
//     esUnaPrueba.meta_value AS esUnaPrueba,
//     ano.meta_value AS ano,
//     fecha.meta_value AS fecha,
//     codigoReclamo.meta_value AS codigoReclamo,
//     depatarmento.meta_value AS depatarmento,
//     provincia.meta_value AS provincia,
//     distrito.meta_value AS distrito,
//     hora.meta_value AS hora,
//     pdfInformacion.meta_value AS pdfInformacion,
//     idProyecto.meta_value AS idProyecto,
//     alias.meta_value AS alias,
//     proyecto.meta_value AS proyecto,
//     nombre.meta_value AS nombre,
//     apellidoPaterno.meta_value AS apellidoPaterno,
//     apellidosMaterno.meta_value AS apellidosMaterno,
//     mayorEdad.meta_value AS mayorEdad,
//     tutor.meta_value AS tutor,
//     domicilioApoderado.meta_value AS domicilioApoderado,
//     telefono.meta_value AS telefono,
//     correo.meta_value AS correo,
//     tipoDocumento.meta_value AS tipoDocumento,
//     nroDocumento.meta_value AS nroDocumento,
//     direccion.meta_value AS direccion,
//     referencia.meta_value AS referencia,
//     departamentoId.meta_value AS departamentoId,
//     provinciaId.meta_value AS provinciaId,
//     distritoId.meta_value AS distritoId,
//     tipoBien.meta_value AS tipoBien,
//     pdfTipoBien.meta_value AS pdfTipoBien,
//     monto.meta_value AS monto,
//     detalleReclamacion.meta_value AS detalleReclamacion,
//     pdfDetalleReclamacion.meta_value AS pdfDetalleReclamacion,
//     textoDetalleReclamacion.meta_value AS textoDetalleReclamacion,
//     peticion.meta_value AS peticion
// FROM {$wpdb->prefix}posts u
// LEFT JOIN {$wpdb->prefix}postmeta esUnaPrueba ON u.ID = esUnaPrueba.post_id AND esUnaPrueba.meta_key = 'es-una-prueba'
// LEFT JOIN {$wpdb->prefix}postmeta ano ON u.ID = ano.post_id AND ano.meta_key = 'ano'
// LEFT JOIN {$wpdb->prefix}postmeta fecha ON u.ID = fecha.post_id AND fecha.meta_key = 'fecha'
// LEFT JOIN {$wpdb->prefix}postmeta codigoReclamo ON u.ID = codigoReclamo.post_id AND codigoReclamo.meta_key = 'codigo-reclamo'
// LEFT JOIN {$wpdb->prefix}postmeta depatarmento ON u.ID = depatarmento.post_id AND depatarmento.meta_key = 'departamento'
// LEFT JOIN {$wpdb->prefix}postmeta provincia ON u.ID = provincia.post_id AND provincia.meta_key = 'provincia'
// LEFT JOIN {$wpdb->prefix}postmeta distrito ON u.ID = distrito.post_id AND distrito.meta_key = 'distrito'
// LEFT JOIN {$wpdb->prefix}postmeta hora ON u.ID = hora.post_id AND hora.meta_key = 'hora'
// LEFT JOIN {$wpdb->prefix}postmeta pdfInformacion ON u.ID = pdfInformacion.post_id AND pdfInformacion.meta_key = 'pdf-informacion'
// LEFT JOIN {$wpdb->prefix}postmeta idProyecto ON u.ID = idProyecto.post_id AND idProyecto.meta_key = 'id-proyecto'
// LEFT JOIN {$wpdb->prefix}postmeta alias ON u.ID = alias.post_id AND alias.meta_key = 'alias'
// LEFT JOIN {$wpdb->prefix}postmeta proyecto ON u.ID = proyecto.post_id AND proyecto.meta_key = 'proyecto'
// LEFT JOIN {$wpdb->prefix}postmeta nombre ON u.ID = nombre.post_id AND nombre.meta_key = 'nombre'
// LEFT JOIN {$wpdb->prefix}postmeta apellidoPaterno ON u.ID = apellidoPaterno.post_id AND apellidoPaterno.meta_key = 'apellido-paterno'
// LEFT JOIN {$wpdb->prefix}postmeta apellidosMaterno ON u.ID = apellidosMaterno.post_id AND apellidosMaterno.meta_key = 'apellido-materno'
// LEFT JOIN {$wpdb->prefix}postmeta mayorEdad ON u.ID = mayorEdad.post_id AND mayorEdad.meta_key = 'mayor-edad'
// LEFT JOIN {$wpdb->prefix}postmeta tutor ON u.ID = tutor.post_id AND tutor.meta_key = 'tutor'
// LEFT JOIN {$wpdb->prefix}postmeta domicilioApoderado ON u.ID = domicilioApoderado.post_id AND domicilioApoderado.meta_key = 'domicilio-apoderado'
// LEFT JOIN {$wpdb->prefix}postmeta telefono ON u.ID = telefono.post_id AND telefono.meta_key = 'telefono'
// LEFT JOIN {$wpdb->prefix}postmeta correo ON u.ID = correo.post_id AND correo.meta_key = 'correo'
// LEFT JOIN {$wpdb->prefix}postmeta tipoDocumento ON u.ID = tipoDocumento.post_id AND tipoDocumento.meta_key = 'tipo-documento'
// LEFT JOIN {$wpdb->prefix}postmeta nroDocumento ON u.ID = nroDocumento.post_id AND nroDocumento.meta_key = 'nro-documento'
// LEFT JOIN {$wpdb->prefix}postmeta direccion ON u.ID = direccion.post_id AND direccion.meta_key = 'direccion'
// LEFT JOIN {$wpdb->prefix}postmeta referencia ON u.ID = referencia.post_id AND referencia.meta_key = 'referencia'
// LEFT JOIN {$wpdb->prefix}postmeta departamentoId ON u.ID = departamentoId.post_id AND departamentoId.meta_key = 'departamento_id'
// LEFT JOIN {$wpdb->prefix}postmeta provinciaId ON u.ID = provinciaId.post_id AND provinciaId.meta_key = 'provincia_id'
// LEFT JOIN {$wpdb->prefix}postmeta distritoId ON u.ID = distritoId.post_id AND distritoId.meta_key = 'distrito_id'
// LEFT JOIN {$wpdb->prefix}postmeta tipoBien ON u.ID = tipoBien.post_id AND tipoBien.meta_key = 'tipo-bien'
// LEFT JOIN {$wpdb->prefix}postmeta pdfTipoBien ON u.ID = pdfTipoBien.post_id AND pdfTipoBien.meta_key = 'pdf-tipo-bien'
// LEFT JOIN {$wpdb->prefix}postmeta monto ON u.ID = monto.post_id AND monto.meta_key = 'monto'
// LEFT JOIN {$wpdb->prefix}postmeta detalleReclamacion ON u.ID = detalleReclamacion.post_id AND detalleReclamacion.meta_key = 'detalle-reclamacion'
// LEFT JOIN {$wpdb->prefix}postmeta pdfDetalleReclamacion ON u.ID = pdfDetalleReclamacion.post_id AND pdfDetalleReclamacion.meta_key = 'pdf-detalle-reclamacion'
// LEFT JOIN {$wpdb->prefix}postmeta textoDetalleReclamacion ON u.ID = textoDetalleReclamacion.post_id AND textoDetalleReclamacion.meta_key = 'texto-detalle-reclamacion'
// LEFT JOIN {$wpdb->prefix}postmeta peticion ON u.ID = peticion.post_id AND peticion.meta_key = 'peticion'
// WHERE 1=1
//     AND u.ID > 0
//     AND codigoReclamo.meta_value IS NOT NULL
// ORDER BY fecha.meta_value ASC",ARRAY_A);

// $spreadsheet = PhpOffice\PhpSpreadsheet\Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();

// $columns = array(
//     "esUnaPrueba",
//     "ano",
//     "fecha",
//     "codigoReclamo",
//     "depatarmento",
//     "provincia",
//     "distrito",
//     "hora",
//     "pdfInformacion",
//     "idProyecto",
//     "alias",
//     "proyecto",
//     "nombre",
//     "apellidoPaterno",
//     "apellidosMaterno",
//     "mayorEdad",
//     "tutor",
//     "domicilioApoderado",
//     "telefono",
//     "correo",
//     "tipoDocumento",
//     "nroDocumento",
//     "direccion",
//     "referencia",
//     "departamentoId",
//     "provinciaId",
//     "distritoId",
//     "tipoBien",
//     "pdfTipoBien",
//     "monto",
//     "detalleReclamacion",
//     "pdfDetalleReclamacion",
//     "textoDetalleReclamacion",
//     "peticion",

// );

// $columnIndex = 1;
// foreach ($columns as $column) {
//     $sheet->setCellValueByColumnAndRow($columnIndex, 1, $column);
//     $columnIndex++;
// }

// $row = 2;
// foreach ($data_query as $data) {
//     $columnIndex = 1;
//     foreach ($columns as $column) {
//         $sheet->setCellValueByColumnAndRow($columnIndex, $row, $data[$column]);
//         $columnIndex++;
//     }
//     $row++;
// }

// $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
// $writer->save($excelFilePath);

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="Reclamos.xlsx"');

// echo $writer;