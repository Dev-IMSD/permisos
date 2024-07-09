<!DOCTYPE html>

<html lang="en">
<?php if (!empty($solicitud)) : ?>
    
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="/Logoo.png" rel="shortcut icon" type="image/png">
            <title> Solicitud N° <?php echo $solicitud['id_solicitud']; ?></title>
        </head>
        <style>
            body {
                font-size: 14px;
                font-family: Calibri, Arial, sans-serif;
            }

            #cuerpo {
                padding: 12px;
                height: 0%;
            }

            #Cabecera,
            #body {
                border: 2px solid lightgrey;
                padding: 0px;
                margin-right: -50px;
                margin-left: -50px;
                margin-top: -45px;
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

            div {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
            }

            td > p,label{
                margin: 5 0 5 0;
                padding: 0 0 0 0;
            }
            
        </style>

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

            $color = $colorMap[$solicitud['tipo_solicitud']];
            ?>

            <section id="cuerpo">
                <div id="Cabecera">
                    <!-- CABECERA DEL PDF -->
                    <div style=" margin-bottom: -50px ;margin-left:30px;margin-right:30px; ">
                        <img src="https://sistemas.santodomingo.cl/solicitud/Logoo.png" height="80" width="80" style="float: left;">

                        <div style=" float: left; margin-left: 8px; margin-top: -10px; width: 25%; text-align: left; font-size: 13px; color:#154eb9; font-family: Cambria, serif; ">
                            <h3 style="float: left;"> Dirección de Recursos Humanos</h3>
                        </div>

                        <div style=" float: right; width: 200%; text-align: right; font-family: Cambria, serif; ">

                            <h3 style="color: #595959; margin-top: -1px;"> F 40206 </h3>
                            <h2 style="color: #595959; margin-top: -15px;"> SOLICITUD DE </h2>
                            <h1 style="color:<?php echo $color ?>; margin-top: -15px;"> <?php echo $solicitud['tipo_solicitud'] ?></h1>
                            <h1 style="color: #595959; margin-top: -15px;">N° <?php echo $solicitud['id_solicitud'] ?></h1>
                            <p style="margin-top: -15px;color: #595959;  ">Fecha de Solicitud <?php $newDate = date("d-m-Y", strtotime($solicitud['fecha']));
                                                                                                echo $newDate  ?></p>

                        </div>
                    </div>
                    <div style="width: 92%; font-family: Calibri Light; margin-left:30px;margin-right:30px;  ">
                        <?php if ($solicitud['tipo_solicitud'] != "HACER USO CONJUNTO DE FERIADO LEGAL") { ?>
                            <!--. I. Identificación del Funcionario/a Solicitante -->
                            <h3 style="margin-top: -500px; color:<?php echo $color ?>; font-size: 18px; "> I. Identificación del Funcionario/a Solicitante. </h3>

                            <hr style="margin-top: -10px;">
                            <table id="t2" style="color: #595959;">
                                <tbody>
                                    <tr>
                                        <td style="padding-bottom:  0px; padding-right:30px; color: #595959;">
                                            <label style="margin-right: 50px;">Apellidos :</label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 2px;">
                                            <p><?php echo $solicitud['apellido']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:  0px; padding-right:30px; color: #595959;">
                                            <label style="margin-right: 50px;">Nombres :</label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 2px;">
                                            <p><?php echo $solicitud['nombre']; ?></p>
                                        </td>
                                        <td style="padding-bottom:  0px; padding-right:30px; color: #595959;">
                                            <label>RUT :</label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 2px;">
                                            <p><?php echo $solicitud['rut_solicitante'] . "-" . $solicitud['dv']; ?></p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:  0px;padding-right:30px; color: #595959;">
                                            <label style="margin-right: 50px;">Cargo:</label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 2px;">
                                            <p><?php echo $solicitud['cargo']; ?></p>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="padding-bottom:  0px; padding-right:30px; color: #595959;">
                                            <label> Sub Unidad de Desempeño : </label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 2px;">
                                            <p><?php echo $solicitud['departamento']; ?> </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:  0px;padding-right:30px; color: #595959;">
                                            <label>Unidad de Desempeño : </label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 2px;">
                                            <p><?php echo $solicitud['direccion']; ?> </p>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <table id="t2" style="color: #595959;">
                                <tbody>

                                    <tr>
                                        <td style="padding-bottom:  0px;padding-right:25px; color: #595959;">
                                            <label style="margin-right: 50px;">Calidad Jurídica : </label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 25px;">
                                            <p><?php echo $solicitud['calidad_juridica']; ?> </p>
                                        </td>
                                        <td style="padding-bottom: 0px; padding-right:25px; color: #595959;">
                                            <label>Escalafón :</label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 25px;">
                                            <p><?php echo $solicitud['escalafon']; ?></p>
                                        </td>

                                        <td style="padding-bottom:  0px;padding-right:25px; color: #595959;">
                                            <label>Grado : </label>
                                        </td>
                                        <td style="padding-bottom:  0px;">
                                            <p><?php echo $solicitud['grado'] . "°"; ?> </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- II. Datos del permiso solicitado. -->
                            <h3 style="color:<?php echo $color ?>;font-size: 18px;"> II. Datos del permiso solicitado. </h3>
                            <hr style="margin-top: 0px;">
                            <!-- Fechas y Tiempo -->
                            <h3 style="color: #595959;"> A. Fechas y Tiempo </h3>
                            <table id="t2" style="color: #595959;">
                                <tbody>

                                    <tr>
                                        <td style="padding-bottom:  0px;padding-right:25px; color: #595959;">
                                            <label style="margin-right: 50px;">Fecha desde : </label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 70px;">
                                            <p><?php echo date("d-m-Y", strtotime($solicitud['fecha_inicio'])); ?> </p>
                                        </td>
                                        <td style="padding-bottom: 0px; padding-right:25px; color: #595959;">
                                            <label>Fecha hasta :</label>
                                        </td>
                                        <td style="padding-bottom:  0px;padding-right: 140px;">
                                            <p><?php echo date("d-m-Y", strtotime($solicitud['fecha_termino'])); ?> </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Formulario PERMISO CON GOCE DE REMUNERACIONES -->
                            <?php if ($solicitud['tipo_solicitud'] == "PERMISO CON GOCE DE REMUNERACIONES") { ?>
                                <table id="t2" style="color: #595959;">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Total de días : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['dias']; ?> </p>
                                            </td>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Medio día :</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['medio_dia']; ?> </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table id="t2" style="color: #595959;">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Motivo: </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['motivo']; ?> </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>

                            <!-- Formulario PERMISO SIN GOCE DE REMUNERACIONES -->
                            <?php if ($solicitud['tipo_solicitud'] == "PERMISO SIN GOCE DE REMUNERACIONES") { ?>

                                <table id="t2" style="color: #595959;">

                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Total de Tiempo solicitado : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Meses : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 15px;">
                                                <p><?php echo $solicitud['meses_pedidos']; ?> </p>
                                            </td>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Días: :</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['dias']; ?> </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table id="t2" style="color: #595959;">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Motivo: </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['motivo']; ?> </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <!-- Formulario PERMISO POSTNATAL PARENTAL -->
                            <?php if ($solicitud['tipo_solicitud'] == "PERMISO POSTNATAL PARENTAL") { ?>
                                <table id="t2" style="color: #595959;">

                                    <tbody>

                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <p>Tiempo Total Efectivo del Permiso Postnatal Parental </p>
                                            </td>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Semanas :</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['semanas_pedidas']; ?></p>
                                            </td>

                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Días : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['dias']; ?> </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="t2" style="color: #595959;">
                                    <tbody>

                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Beneficiario del Permiso Postnatal Parental:</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['beneficiario']; ?> </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>¿Con reintegro laboral de media jornada?:</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['reintegro']; ?> </p>
                                            </td>


                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <!-- Formulario PERMISO GREMIAL -->
                            <?php if ($solicitud['tipo_solicitud'] == "PERMISO GREMIAL") { ?>
                                <h3 style="color: #595959;"> B. Tiempo Total Efectivo de Permiso Gremial </h3>
                                <table id="t2" style="color: #595959;">

                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Hora Desde:</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['hora_desde']; ?> </p>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Hora Hasta:</label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['hora_hasta']; ?> </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Meses :</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['meses_pedidos']; ?></p>
                                            </td>

                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Días : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['dias']; ?> </p>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Horas : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['horas']; ?> </p>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Minutos : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['minutos']; ?> </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <!-- Formulario DESCANSO COMPLEMENTARIO -->
                            <?php if ($solicitud['tipo_solicitud'] == "DESCANSO COMPLEMENTARIO") { ?>
                                <table id="t2" style="color: #595959;">

                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Hora Desde:</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['hora_desde']; ?> </p>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Hora Hasta:</label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['hora_hasta']; ?> </p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 10px; padding-right:25px; color: #595959;">
                                                <label>Días : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['dias'] + 0; ?> </p>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Horas : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['horas']; ?> </p>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Minutos : </label>
                                            </td>
                                            <td style="padding-bottom:  10px;">
                                                <p><?php echo $solicitud['minutos']; ?> </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table id="t2" style="color: #595959;">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label style="margin-right: 50px;">Motivo: </label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 70px;">
                                                <p><?php echo $solicitud['motivo']; ?> </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <!-- Formulario FERIADO LEGAL -->
                            <?php if ($solicitud['tipo_solicitud'] == "FERIADO LEGAL") { ?>
                                <table id="t2" style="color: #595959;">

                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:  10px;padding-right:25px; color: #595959;">
                                                <label>Total de días: :</label>
                                            </td>
                                            <td style="padding-bottom:  10px;padding-right: 15px;">
                                                <p><?php echo $solicitud['dias']; ?> </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table id="t2">
                                    <tbody>
                                        <td  style="border-image: initial; border: 1px solid black; padding: 0 0 0 0; margin: 0 0 0 0;">
                                            <table>
                                                <td>
                                                    <input type="checkbox" style="cursor: pointer; margin: 30 0 0 0;">
                                                </td>
                                                <td>
                                                    <p style="margin: 0 0 0 0;"><u>DECLARO CONOCER QUE:</u><br> Cuando las necesidades del servicio así lo aconsejen, el Alcalde podrá ANTICIPAR o POSTERGAR la época del feriado legal –que por esta vía formalmente solicito–, a condición de que este quede comprendido dentro del año respectivo; salvo que en ese caso, yo pidiere expresamente hacer uso conjunto de mi feriado legal con el que corresponda al año siguiente, en cuyo caso, lo manifestaré oportunamente; de conformidad a lo dispuesto en el artículo 103 de la ley N° 18.883, Aprueba Estatuto Administrativo para Funcionarios Municipales.</p>
                                                </td>
                                            </table>
                                        </td>

                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>

                        <?php } else {  ?>
                            </br>
                            <div style="font-family: Cambria;color: #595959;margin-top: 10px;">
                                Yo, <b><?php echo $solicitud['nombre'] . ' ' . $solicitud['apellido']; ?></b>, RUT <?php echo $solicitud['rut_solicitante']; ?>,
                                funcionario/a <b><?php echo $solicitud['calidad_juridica']; ?></b>, del escalafón <b><?php echo $solicitud['escalafon']; ?></b>, y grado <b><?php echo $solicitud['grado'] . "°"; ?> </b>
                                , que me desempeño en el cargo de <b><?php echo $solicitud['cargo']; ?></b>, en <b><?php echo $solicitud['departamento']; ?> </b>
                            </div>
                            </br>
                            <div style="font-family: Cambria;color: #595959; text-align: left;margin-bottom:25px;">
                                <p><b><u>DECLARO QUE:</u></b></p>
                                <div style="margin-left:25px;margin-right:25px;">
                                    <p>
                                        Con fecha <b><?php echo $newDate ?></b>, he presentado oportunamente ante la Dirección de Recursos Humanos mi Solicitud de Feriado Legal,
                                        solicitando como tal el período comprendido entre:
                                        Fecha desde: <b><?php echo date("d-m-Y", strtotime($solicitud['fecha_inicio'])); ?></b>;
                                        Fecha Hasta: <b><?php echo date("d-m-Y", strtotime($solicitud['fecha_termino'])); ?></b>;
                                        por un total de <b><?php echo $solicitud['dias']; ?></b> Días.
                                    </p>
                                    <p>
                                        No me es posible tomar la época del feriado legal propuesta por el Alcalde, comprendida entre el <b><?php echo $solicitud['desde_alcalde'] ?></b>
                                        y el <b><?php echo $solicitud['hasta_alcalde'] ?></b>; que <b><?php echo $solicitud['accion_alcalde'] ?></b> la época de feriado la fecha que yo solicité inicialmente.
                                    </p>
                                </div>
                                <p>En virtud de lo expuesto anteriormente, <b><u>EXPRESAMENTE SOLICITO:</u></b></p>
                                <div style="margin-left:25px;margin-right:25px;">
                                    <p>
                                        HACER USO CONJUNTO DE MI FERIADO LEGAL CON EL QUE CORRESPONDA AL AÑO SIGUIENTE, esto es, <b><?php echo $solicitud['year'] ?></b>; de conformidad a
                                        lo dispuesto en el artículo 103, inciso segundo, de la ley N° 18.883, Aprueba Estatuto Administrativo para Funcionarios Municipales.

                                    </p>
                                </div>
                            </div>

                        <?php } ?>
                        </br>
                        <table style="color: #595959; margin-left:60px;margin-right:60px;">
                            <tbody>
                                <tr style="padding-bottom: -100px;">
                                    <td style="text-align: center;padding-right:100px;">

                                        <img class="center" src="http://sistemas.santodomingo.cl/solicitud/firmas/<?php echo $solicitud['rut_solicitante'] ?>.jpg" height="150" width="200">
                                        <br>
                                        <small>Funcionario/a Solicitante</small>
                                    </td>

                                    <td style="text-align: center;<?php if ($solicitud['firma_subrogante'] == null) {
                                                                        echo "padding-top:12%;";
                                                                    } ?> padding-right: 20px; ">
                                        <?php if ($solicitud['firma_subrogante'] != null) { ?>
                                            <img class="center" src="http://sistemas.santodomingo.cl/solicitud/firmas/<?php echo $solicitud['rut_subrogante'] ?>.jpg" height="150" width="200">
                                        <?php } else {
                                            echo "__________________________________";
                                        } ?>
                                        <br>
                                        <small>Funcionario/a que Subrogará</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;padding-right:100px;" <?php if ($solicitud['rut_firma'] == null) {
                                                                                            echo "padding-top:12%;";
                                                                                        } ?>>
                                        <?php if ($solicitud['rut_firma'] != null) { ?>
                                            <img class="center" src="http://sistemas.santodomingo.cl/solicitud/firmas/<?php echo $solicitud['rut_firma'] ?>.jpg" height="150" width="200">
                                        <?php } else {
                                            echo "__________________________________";
                                        } ?>
                                        <br>
                                        <small>V.° B.° de la Jefatura Directa</small>
                                    </td>

                                    <td style="text-align: center;">
                                        <?php if ($solicitud['estado'] == "Timbrada por RRHH") { ?>
                                            <img class="center" src="http://sistemas.santodomingo.cl/solicitud/firmas/<?php echo $solicitud['firma_rrhh'] ?>.jpg" height="150" width="200">
                                        <?php } else {
                                            echo "__________________________________";
                                        } ?>
                                        <br>
                                        <small>Recepción Dirección de Recursos Humanos</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            
        </body>
<?php else : ?>
    <p>No se encontraron solicitudes para mostrar.</p>
<?php endif; ?>

</html>
