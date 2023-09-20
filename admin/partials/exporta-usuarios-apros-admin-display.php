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
<div>
    <h1>Exportar usuarios</h1>
    <div>
        <p>
            Exporta los campos:
        </p>
        <ul style="list-style-type: disc;margin-left:25px;">
            <li>DNI</li>
            <li>NOMBRE</li>
            <li>BANCO</li>
            <li>NRO DE CUENTA</li>
        </ul>
    </div>
    <br>

    <button id="export-btn" class="button-primary">Exportar Usuarios</button>



    <script>
        jQuery(document).ready(function($) {
            $('#export-btn').click(function() {
                $.ajax({
                    url: eua.url,
                    type: 'POST',
                    data: {action: 'export_data_users'},
                    success: function(data) {
                        var csv = new Blob([data], {type: 'text/csv'});
                        var url = window.URL.createObjectURL(csv);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'usuarios.csv';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                });
            });
        });
    </script>

</div>