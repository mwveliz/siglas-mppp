<script>
    var id_entrada = 1;
    function agregar_parametro_entrada()
    {
        $('#grilla_parametros_entrada').append(
                '<tr id="parametro_entrada_'+id_entrada+'">'+
                    '<td>'+
                        '<input type="text" size="10" name="parametros_prueba[parametros_entrada][nombres][]"/>'+
                    '</td>'+
                    '<td>'+
                        '<select name="parametros_prueba[parametros_entrada][tipo][]">'+
                            '<option value="integer">Integer</option>'+
                            '<option value="string">String</option>'+
                        '<select/>'+
                    '</td>'+
                    '<td>'+
                        '<input type="text" name="parametros_prueba[parametros_entrada][pruebas][]"/>'+
                    '</td>'+
                    '<td>'+
                        '<a href="#" onclick="eliminar_parametro_entrada(\'parametro_entrada_'+id_entrada+'\'); return false;">'+
                            '<img src="/images/icon/delete.png" title="Eliminar">'+
                        '</a>'+
                    '</td>'+
                '</tr>');
        id_entrada++;
    }
    
    function eliminar_parametro_entrada(elemento)
    {
        $('#'+elemento).remove();
    }
</script>

<div class="sf_admin_form_row sf_admin_text">
    <div>
        <label>Parametros entrada</label>
        <div class="content">
            <a href="#" onclick="agregar_parametro_entrada(); return false;">Agregar parametro de entrada</a>
            <table id="grilla_parametros_entrada">
                <th style="min-width: 100px;">Parametro</th>
                <th style="min-width: 75px;">Tipo</th>
                <th style="min-width: 180px;">Valor de prueba</th>
                <th></th>
            </table>
        </div>
    </div>
</div>