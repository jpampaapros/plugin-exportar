<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://apros.global/
 * @since      1.0.0
 *
 * @package    Exporta_Usuarios_Apros
 * @subpackage Exporta_Usuarios_Apros/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php 

$uploads = wp_upload_dir();
$uploads_dir = $uploads['basedir'] . '/apros_export_reclamos';
var_dump($uploads_dir);

?>

<div>
    <h1>Exportar Reclamos</h1>
    <div>
        <p>
            Se exportara los campos del formulario del libro de reclamaciones:
        </p>
    </div>
    <br>

    <button id="export-btn-csv" class="button-primary">Exportar a CSV</button>
    <button id="export-btn-excel" class="button-primary">Exportar a Excel</button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.15/xlsx.full.min.js"></script>



    <script>
        jQuery(document).ready(function($) {
            $('#export-btn-csv').click(function() {
                $.ajax({
                    url: eua.url,
                    type: 'POST',
                    data: {action: 'export_data_reclamos_csv'},
                    success: function(data) {
                        console.log(data);
                        var csv = new Blob([data], {type: 'text/csv'});
                        var url = window.URL.createObjectURL(csv);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'Reclamos.csv';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                });
            });

            $('#export-btn-excel').click(function() {
                $.ajax({
                    url: eua.url,
                    type: 'POST',
                    data: {action: 'export_data_reclamos_excel'},
                    success: function(data) {

                        // console.log({data});
                        let url = data?.data?.url;
                        if(url){
                            var a = document.createElement('a');
                            a.href = url;
                            a.download = 'Reclamos';
                            document.body.appendChild(a);
                            a.click();
                            document.body.removeChild(a);
                        }else{
                            alert("Error al generar el archivo");
                        }

                        // var csv = new Blob([data], {type: 'application/vnd.ms-excel'});
                        // var csv = new Blob([data], {type: 'application/ms-excel'});
                        // var csv = new Blob([data], {type: 'application/vnd.ms-excel'});
                        // var url = window.URL.createObjectURL(csv);
                        
                    }
                });
            });

        });
    </script>

</div>