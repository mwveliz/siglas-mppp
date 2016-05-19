<div>   
    <fieldset><h2>ADMINISTRACI&Oacute;N DE GRUPOS DE ARCHIVO</h2></fieldset>
        <br/>
        <table style="width: 100%;">
            <tr style="" class="sf_admin_row">
                <th>Unidades</th>
                <th style="background-color: green; text-align: center; color: white">Archivar</th>
                <th style="background-color: blue; text-align: center; color: white">Leer</th>
                <th style="background-color: goldenrod; text-align: center; color: white">Prestar</th>
                <th style="background-color: orangered; text-align: center; color: white">Anular</th>
                <th style="background-color: orchid; text-align: center; color: white">Administrar</th>
                <th style="background-color: dimgrey; text-align: center; color: white"><b>Total</b></th>
                <th style="background-color: #E7EEF6; text-align: center;">Acciones</th>
            </tr>
            <?php  foreach ( $organigrama as $unidad_id=>$unidad_nombre ) { if($unidad_id!='') { ?>
                <tr class="sf_admin_row">
                    <td>
                        <?php echo html_entity_decode($unidad_nombre); ?>
                    </td>
                    <td style="background-color: #3dc83d; text-align: center;"><?php echo $funcionarios[$unidad_id]['archivar']; ?></td>
                    <td style="background-color: #6262de; text-align: center;"><?php echo $funcionarios[$unidad_id]['leer']; ?></td>
                    <td style="background-color: #efc45d; text-align: center;"><?php echo $funcionarios[$unidad_id]['prestar']; ?></td>
                    <td style="background-color: #f87446; text-align: center;"><?php echo $funcionarios[$unidad_id]['anular']; ?></td>
                    <td style="background-color: #eda7eb; text-align: center;"><?php echo $funcionarios[$unidad_id]['administrar']; ?></td>
                    <td style="background-color: #9a9a9a; text-align: center;"><?php echo $funcionarios[$unidad_id]['count']; ?></td>
                    <td style="background-color: #FFFFFC; text-align: center;"><?php echo link_to(image_tag('icon/edit.png'), 'configuracion/editGroupArchivo?id='.$unidad_id); ?></td>
                </tr>

                
            <?php } } ?>
            <tr>
                <td style="text-align: right"><b>TOTAL:</b></td>
                <td style="background-color: #3dc83d; text-align: center;"><b><?php echo $funcionarios['total']['archivar']; ?></b></td>
                <td style="background-color: #6262de; text-align: center;"><b><?php echo $funcionarios['total']['leer']; ?></b></td>
                <td style="background-color: #efc45d; text-align: center;"><b><?php echo $funcionarios['total']['prestar']; ?></b></td>
                <td style="background-color: #f87446; text-align: center;"><b><?php echo $funcionarios['total']['anular']; ?></b></td>
                <td style="background-color: #eda7eb; text-align: center;"><b><?php echo $funcionarios['total']['administrar']; ?></b></td>
                <td style="background-color: dimgrey; text-align: center; color: white"><b><?php echo $funcionarios['total']['archivar']+$funcionarios['total']['leer']+$funcionarios['total']['prestar']+$funcionarios['total']['anular']+$funcionarios['total']['administrar']; ?></b></td>
                <td colspan="2"></td>
            </tr>
        </table>
    <div id="sf_admin_footer"> </div>
</div>