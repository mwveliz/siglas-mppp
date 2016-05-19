<?php 

 $totales = '';
 
    foreach ($estadistica_datos as $estadistica_dato){
        $nombre =  "'".$estadistica_dato['organismo_siglas']."'";
        $nombre2 =  "'".$estadistica_dato['organismo_nombre']."'";
        $totales[$nombre][$nombre2] = $estadistica_dato['organismo_total'];
    }
$unidad = Doctrine::getTable('Organigrama_Unidad')->find($unidad_id);   
?>

<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        
    Highcharts.setOptions({
	lang: {
		loading: 'Cargando...',
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
			'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                shortMonths: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Nov','Dic'],
		weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                exportButtonTitle: "Exportar",
                printButtonTitle: "Imprimir",
                rangeSelectorFrom: "De",
                rangeSelectorTo: "Hasta",
                rangeSelectorZoom: "Periodo",
                downloadPNG: 'Descargar imagen PNG',
                downloadJPEG: 'Descargar imagen JPEG',
                downloadPDF: 'Descargar documento PDF',
                downloadSVG: 'Descargar imagen SVG',
                resetZoom: 'Restablecer',
                resetZoomTitle: 'Restablecer',
                printButtonTitle: 'Imprimir'
	}
        });
        
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerBars',
                type: 'column'
            },
            colors: [
                '#980000',
                '#0B610B',
                '#04B404', 
                '#2E9AFE', 
                '#B40404', 
                '#3D96AE'
             ],
            credits: {
                enabled: true,
                position: {
                            align: 'right',
                            x: -10,
                            verticalAlign: 'bottom',
                            y: -5
                    },
               text: "<?php echo "Generado el dia: ".date('d/m/Y h:i:s a') ?> / SIGLAS <?php echo sfConfig::get('sf_siglas'); ?>"
            },
            title: {
                text: 'Total de correspondencia recibida de organismos externos'
            },
            subtitle: {
                text: '<?php echo $unidad->getNombre()."<br/>".$fecha; ?>'
            },
            xAxis: {
                categories: ['Totales']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Correspondencia'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
           
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'right',
                verticalAlign: 'top',
                x: 0,
                y: 70,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.point.nombre +', '+this.x+': '+ this.y +'';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [
                    <?php
                    foreach($totales as $key => $value)
                    {
                        foreach($value as $key2 => $value2)
                        {
                            echo "{ name: $key, data: [ { y: $value2, nombre: $key2 } ] },\n";
                        }
                    }
                ?>
                ]
        },
        function(chart){
        chart.renderer.image('/images/other/logo_siglas_watermark_small.png',0,0,89,89).add();
     });
    });
    
});
		</script>
<div id="containerBars" class="highchartsContainer" style="width: 2000px;"></div>