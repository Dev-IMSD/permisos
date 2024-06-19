<!DOCTYPE html>
<html>
<head>
    
	<title> Solicitud N°  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <style>
        body { 
            font-size: 14px;
            font-family: 'Calibri Light', sans-serif;
        }
        #cuerpo { 
            padding: 18px;
            height: 200%; 
        }
        #Cabecera, #body { 
            border: 2px solid lightgrey;
            padding: 8px; 
            margin: -50px; 
        }
        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }
        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }
        table#t01 th {
            background-color: lightgrey;
            color: black;
        }
    </style>
</head>
<body>
    <?php 
        $colorMap = [
            'PERMISO POSTNATAL PARENTAL' => '#7030a0',
            'PERMISO CON GOCE DE REMUNERACIONES' => '#0174c3',
            'PERMISO SIN GOCE DE REMUNERACIONES' => '#ed7d31',
            'PERMISO GREMIAL' => '#44546a',
            'DESCANSO COMPLEMENTARIO' => '#bf8f00',
            'FERIADO LEGAL' => '#538135',
            'HACER USO CONJUNTO DE FERIADO LEGAL' => '#538135'
        ];
        
        $color = /*$colorMap[$solicitud->tipo_solicitud] ??*/ '#000000';
    ?>
    <section id="cuerpo">
        <div id="Cabecera">
            <div style="margin-bottom: -120px; margin-left: 30px; margin-right: 30px;">
                <!-- <img src="https://sistemas.santodomingo.cl/solicitud/Logoo.png" height="80" width="80" style="float: left;"> -->
                <div style="float: left; margin-left: 8px; margin-top: -10px; width: 25%; text-align: left; font-size: 13px; color: #154eb9; font-family: 'Cambria', serif;">
                    <h3 style="float: left;">Dirección de Recursos Humanos</h3>
                </div>
                <div style="float: right; margin-right: 10px; margin-top: -10px; width: 70%; text-align: right; font-family: 'Cambria', serif;">
                    <h3 style="color: #595959;">F 40201</h3>
                    <h2 style="color: #595959;">SOLICITUD DE</h2>
                     
                    <hr style="margin-top: -5px;">
                  </div>
            </div>
        </div>
    </section>
</body>
</html>
