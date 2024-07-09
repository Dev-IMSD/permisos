<?php
$session = session();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Responsivo !-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon !-->
    <link href="/Logoo.png" rel="shortcut icon" type="image/png">
    <!-- Bootstrap !-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- Iconos !-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/feriadoLegal.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <img src="https://sistemas.santodomingo.cl/solicitud/Logoo.png" height="100" width="100" style="float: left;margin-top: 20px;margin-right: 10px;">
            <div class="form-group">
                <br>
                <h2 id= titulo ></h2>
                <h5 style="color: #ecf0f1;">Usuario: <?= $session->nombre . '  <a href="' . base_url('/logout') . '"><i class="fa fa-sign-out" style="font-size:100%"></i></a>'; ?></h5>
            </div>
        </div>
    </div>
    <div id="containerForm" class="container">
        <div id="accordion">
            <div class="card">
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card bg-light text-dark" stycle="width: 100%">
                        <div class="card-body">
                            <div class="btn-group btn-group-justified" style="width: 100%">
                                <div class="container">
                                    <form id="formSolicitud" autocomplete="off">
                                        <!-- Tipo de solicitud --> 
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="sel1">Tipo de Solicitud</label>
                                                            <select class="form-control" name="tipo_solicitud" id="tipo_solicitud" onchange="mostrar_formulario();">
                                                                <option>Seleccione...</option>
                                                                <option value="PERMISO CON GOCE DE REMUNERACIONES">PERMISO CON GOCE DE REMUNERACIONES</option>
                                                                <option value="PERMISO SIN GOCE DE REMUNERACIONES">PERMISO SIN GOCE DE REMUNERACIONES</option>
                                                                <option value="PERMISO POSTNATAL PARENTAL"> PERMISO POSTNATAL PARENTAL</option>
                                                                <option value="PERMISO GREMIAL"> PERMISO GREMIAL</option>
                                                                <option value="DESCANSO COMPLEMENTARIO"> DESCANSO COMPLEMENTARIO</option>
                                                                <option value="FERIADO LEGAL">FERIADO LEGAL</option>
                                                                <option value="HACER USO CONJUNTO DE FERIADO LEGAL"> HACER USO CONJUNTO DE FERIADO LEGAL</option>
                                                            </select>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- I.	Identificación del Funcionario/a Solicitante.< -->
                                        <h5 class="mb-0">
                                            <h5><strong>I. Identificación del Funcionario/a Solicitante.</strong></h5>
                                            <!-- </button> -->
                                        </h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Nombre</label>
                                                            <input type="text" class="form-control" id="txt_nombresolicitante" name="txt_nombresolicitante" value="<?= $session->nombre; ?>" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Rut </label>
                                                            <input type="text" class="form-control" id="rut_solicitante" name="rut_solicitante" value="<?= $session->rut . "-" . $session->dv; ?>" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Cargo solicitante</label>
                                                            <input type="text" class="form-control" id="txt_cargosolicitante" name="txt_cargosolicitante" value="<?= $session->cargo; ?>" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Teléfono de contacto </label>
                                                            <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" value="<?= $session->telefono; ?>" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Departamento / Unidad </label>
                                                            <input type="text" class="form-control" id="txt_departamentosolicitante" name="txt_departamentosolicitante" value="<?= $session->depto; ?>" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Direccion solicitante</label>
                                                            <input type="text" class="form-control" id="txt_direccionsolicitante" name="txt_direccionsolicitante" value="<?= $session->direccion; ?>" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Calidad Juridica</label>
                                                            <input type="text" class="form-control" id="calidad_juridica" name="calidad_juridica" value="<?= $session->calidad_juridica; ?>" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Grado</label>
                                                            <input type="text" class="form-control" id="grado" name="grado" value="<?= $session->grado . "°"; ?>" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Escalafón</label>
                                                            <input type="text" class="form-control" id="escalafon" name="escalafon" value="<?= $session->escalafon; ?>" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- ***FORM****. -->
                                        <h5 class="mb-0">
                                            <h5><strong>II. Datos del permiso solicitado.</strong></h5>
                                        </h5>
                                        <!-- Fechas -->
                                        <table class="table">
                                            <!-- <h5><strong>I. Datos del Funcionario.</strong></h5> -->
                                            <div id="declaro" style="display:none">
                                                </br>
                                                <h5><strong>Declaro que:</strong></h5>
                                                <h5> Con fecha , he presentado oportunamente ante la Dirección de Recursos Humanos mi Solicitud de Feriado Legal, solicitando como tal el período comprendido entre:</h5>
                                            </div>
                                            <tbody>
                                                <tr>
                                                    <td id="dias_disponibles" style="display:none; width:50%;">
                                                        <div class="form-group">
                                                            <label>Dias Disponibles</label>
                                                            <input type="text" class="form-control" id="dias_fl" name="dias_fl" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_disponibles_ad" style="display:none; width:50%;">
                                                        <div class="form-group">
                                                            <label>Dias Administrativos Disponibles</label>
                                                            <input type="text" class="form-control" id="dias_ad" name="dias_ad" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_F40201" style="display:none;width: 50%;">
                                                        <div class="form-group">
                                                            <label>Dias solicitados para este formulario F40201</label>
                                                            <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_F40202" style="display:none;width:50%">
                                                        <div class="form-group" style="width:50%">
                                                            <label>Dias solicitados para este formulario F40202</label>
                                                            <input type="text" class="form-control" id="dias_ocupados1" name="dias_ocupados1" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_F40203" style="display:none;width:50%">
                                                        <div class="form-group" style="width:50%">
                                                            <label>Dias solicitados para este formulario F40203</label>
                                                            <input type="text" class="form-control" id="dias_ocupados2" name="dias_ocupados2" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_F40204" style="display:none;width:50%">
                                                        <div class="form-group" style="width:50%">
                                                            <label>Dias solicitados para este formulario F40204</label>
                                                            <input type="text" class="form-control" id="dias_ocupados3" name="dias_ocupados3" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_F40205" style="display:none;width:50%">
                                                        <div class="form-group" style="width:50%">
                                                            <label>Dias solicitados para este formulario F40205</label>
                                                            <input type="text" class="form-control" id="dias_ocupados4" name="dias_ocupados4" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="dias_F40206" style="display:none;width:50%">
                                                        <div class="form-group">
                                                            <label>Dias solicitados para este formulario F40206</label>
                                                            <input type="text" class="form-control" id="dias_ocupados5" name="dias_ocupados5" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table" id="fechaF" style="display:none">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Fecha de inicio </label>
                                                            <input class="form-control" type="date" id="desde" name="desde" min="<?= date('Y-m-d', strtotime(date('Y-m-d'))) ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Fecha de término </label>
                                                            <input class="form-control" type="date" onchange="calcular_dias_pedidos();" id="hasta" name="hasta" min="<?= date('Y-m-d', strtotime(date('Y-m-d'))) ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Dias Solicitados</label>
                                                            <input type="text" class="form-control" id="diasPedidos" name="diasPedidos" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="meses" style="display:none">
                                                        <div class="form-group">
                                                            <label>Meses Solicitados</label>
                                                            <input type="text" class="form-control" id="meses_pedidos" name="meses_pedidos" readonly>
                                                        </div>
                                                    </td>
                                                    <td id="semanas" style="display:none">
                                                        <div class="form-group">
                                                            <label>Semanas Solicitadas</label>
                                                            <input type="text" class="form-control" id="semanas_pedidas" name="semanas_pedidas" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Formulario PERMISO CON GOCE DE REMUNERACIONES -->
                                        <div id="F40201" style="display:none">
                                            <!-- Form -->
                                            <table class="table">
                                                <tbody>
                                                    <tr id='tr_medio_dia'>
                                                        <td style="width: 30%;">

                                                            <div class="form-group">
                                                                <label>Medio dia</label>
                                                                <div class="radio">
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="medio_dia" name="medio_dia" value="Mañana" onclick="calcular_dias_pedidos();"> Mañana
                                                                    </label>
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="medio_dia" name="medio_dia" value="Tarde" onclick="calcular_dias_pedidos();"> Tarde
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" id="medio_dia" name="medio_dia" value="No aplica" onclick="calcular_dias_pedidos();" checked> No aplica
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">
                                                                    <!-- <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si" > -->
                                                                    Declaro conocer que: <br>
                                                                    Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                                                    (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                                                </label>

                                                                <span class="text-danger">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Formulario PERMISO SIN GOCE DE REMUNERACIONES -->
                                        <div id="F40202" style="display:none">
                                            <!-- Form -->

                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">

                                                                        Declaro conocer que: <br>
                                                                        Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                                                        (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                                                    </label>
                                                                </div>
                                                                <span class="text-danger">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Formulario PERMISO POSTNATAL PARENTAL -->
                                        <div id="F40203" style="display:none">
                                            <!-- Form -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Beneficiario del Permiso Postnatal Parental</label>
                                                                <div class="radio">
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="beneficiario" name="beneficiario" value="Madre"> Madre
                                                                    </label>
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="beneficiario" name="beneficiario" value="Padre"> Padre
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <label>¿Con reintegro laboral de media jornada?</label>
                                                                <div class="radio">
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="reintegro" name="reintegro" value="Si"> Si
                                                                    </label>
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="reintegro" name="reintegro" value="No"> No
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">

                                                                        Declaro conocer que: <br>
                                                                        Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                                                        (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                                                        En caso de ser necesaria la contratación de un suplente, el directivo de la unidad de desempeño deberá comunicarlo expresamente y por escrito a la Dirección de Recursos Humanos, previa validación del ítem presupuestario respectivo.
                                                                    </label>
                                                                </div>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Formulario PERMISO GREMIAL -->
                                        <div id="F40204" style="display:none">
                                            <!-- Form -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group" style="width:10%">
                                                                <label>Tiempo</label>
                                                                <input type="time" class="form-control" id="tiempo" name="tiempo">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">
                                                                        Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                                                        (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                                                    </label>
                                                                </div>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Formulario DESCANSO COMPLEMENTARIO -->
                                        <div id="F40205" style="display:none">
                                            <!-- Form -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:15%">
                                                            <div class="form-group">
                                                                <label>Hora Desde:</label>
                                                                <input type="time" class="form-control" id="hora_desde" name="hora_desde">
                                                            </div>
                                                        </td>
                                                        <td style="width:15%">
                                                            <div class="form-group">
                                                                <label>Hora Hasta:</label>
                                                                <input type="time" class="form-control" id="hora_hasta" name="hora_hasta">
                                                            </div>
                                                        </td>
                                                        <script>

                                                        </script>
                                                        <td style="width:15%">
                                                            <div class="form-group">
                                                                <label>Total de Horas </label>
                                                                <input type="text" class="form-control" id="horas" name="horas" readonly>
                                                            </div>
                                                        </td>
                                                        <td style="width:15%">
                                                            <div class="form-group">
                                                                <label>Total de Minutos</label>
                                                                <input type="text" class="form-control" id="minutos" name="minutos" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">

                                                                        Declaro conocer que: <br>
                                                                        Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                                                        (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                                                    </label>
                                                                </div>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Formulario FERIADO LEGAL -->
                                        <div id="F40206" style="display:none">
                                            <!-- Form -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si">
                                                                        Declaro conocer que: <br>
                                                                        Cuando las necesidades del servicio así lo aconsejen, el Alcalde podrá ANTICIPAR o POSTERGAR la época del feriado legal –que por esta vía formalmente solicito–, a condición de que este quede comprendido dentro del año respectivo; salvo que en ese caso, yo pidiere expresamente hacer uso conjunto de mi feriado legal con el que corresponda al año siguiente, en cuyo caso, lo manifestaré oportunamente; de conformidad a lo dispuesto en el artículo 103 de la ley N° 18.883, Aprueba Estatuto Administrativo para Funcionarios Municipales.
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                </tbody>
                                            </table>
                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">
                                                                        Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                                                        (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                                                    </label>
                                                                </div>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Formulario HACER USO CONJUNTO DE FERIADO LEGAL -->
                                        <div id="F40207" style="display:none">
                                            <!-- Form -->

                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5> No me es posible tomar la época del feriado legal propuesta por el Alcalde, comprendida entre el
                                                                <input class="form-control" type="date" id="desde_alcalde" name="desde_alcalde" style="width:15%; display:inline">
                                                                y
                                                                <input style="width:15%; display:inline" class="form-control" type="date" id="hasta_alcalde" name="hasta_alcalde">
                                                                ; que
                                                                <select class="form-control" name="accion_alcalde" id="accion_alcalde" style="width:15%; display:inline">
                                                                    <option value="">Elija una opción</option>
                                                                    <option value="ANTICIPA">ANTICIPA</option>
                                                                    <option value="POSTERGA">POSTERGA</option>
                                                                </select> la época de feriado la fecha que yo solicité inicialmente.
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- declaracion -->
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si">
                                                                        En virtud de lo expuesto anteriormente, <strong>EXPRESAMENTE SOLICITO:</strong> <br>
                                                                        HACER USO CONJUNTO DE MI FERIADO LEGAL CON EL QUE CORRESPONDA AL AÑO SIGUIENTE, esto es,
                                                                        <select class="form-control" name="year_alcalde" id="year_alcalde" style="width:15%; display:inline">
                                                                            <option value="">Elija un año</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                        </select>
                                                                        ; de conformidad a lo dispuesto en el artículo 103, inciso segundo, de la ley N° 18.883, Aprueba Estatuto Administrativo para Funcionarios Municipales. </label>
                                                                </div>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Subrogante -->
                                        <div id="div_subrogante" style="display:none">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%;">
                                                            <div class="form-group">
                                                                <label>Agregar Funcionario Subrogante</label>
                                                                <div class="radio">
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="subrogante_si" name="subrogante" value="si" onclick="mostrar_funcionarios();"> Si
                                                                    </label>
                                                                    <label style="padding-right: 20px">
                                                                        <input type="radio" id="subrogante_no" name="subrogante" value="no" checked onclick="mostrar_funcionarios();"> No
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">

                                                            </script>

                                                        </td>
                                                        <td>
                                                            <div class="form-group" id="div_subrogante_select" style="display:none">
                                                                <label for="sel1">Funcionario/a que Subrogará</label>
                                                                <select class="form-control" name="rut_subrogante" id="rut_subrogante">
                                                                    <option value="">Seleccione...</option>
                                                                    <!-- Se crea la vista con el codigo javaScripts -->
                                                                </select>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Botón -->
                                        <div id="div_motivo" style="display:none">

                                            <label>Motivo del Permiso</label>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control" name="motivo_1" id="motivo_1" onchange="otro(this);" style="display:none">
                                                                    <option value=""> Seleccione...</option>
                                                                    <option value="TRÁMITES PERSONALES">TRÁMITES PERSONALES</option>
                                                                    <option value="TRÁMITES MÉDICOS">TRÁMITES MÉDICOS</option>
                                                                    <option value="TRÁMITES POR FALLECIMIENTO DE HIJO O CÓNYUGE">TRÁMITES POR FALLECIMIENTO DE HIJO O CÓNYUGE.</option>
                                                                    <option value="TRÁMITES POR FALLECIMIENTO DE HIJO EN GESTACIÓN O MUERTE DE PADRE O MADRE"> TRÁMITES POR FALLECIMIENTO DE HIJO EN GESTACIÓN O MUERTE DE PADRE O MADRE.</option>
                                                                    <option value="TRÁMITES POR MATRIMONIO"> TRÁMITES POR MATRIMONIO.</option>
                                                                    <option value="TRÁMITES POR NACIMIENTO DE HIJO O ADOPCIÓN">TRÁMITES POR NACIMIENTO DE HIJO O ADOPCIÓN.</option>
                                                                    <option value="TRÁMITES POR FAMILIAR ENFERMO">TRÁMITES POR FAMILIAR ENFERMO</option>
                                                                    <option value="INTERFERIADO">INTERFERIADO</option>
                                                                    <option value="POR MATRIMONIO (LEY N° 20.764)">POR MATRIMONIO (LEY N° 20.764)</option>
                                                                    <option value="OTRO">OTRO</option>
                                                                    <!-- <option value="" ></option>         -->
                                                                </select>
                                                                <select class="form-control" name="motivo_2" id="motivo_2" onchange="otro(this);" style="display:none">
                                                                    <option value=""> Seleccione...</option>
                                                                    <option value="POR MOTIVOS PARTICULARES">POR MOTIVOS PARTICULARES</option>
                                                                    <option value="POR PERMANENCIA EN EL EXTRANJERO">POR PERMANENCIA EN EL EXTRANJERO</option>
                                                                    <option value="BECAS">BECAS</option>
                                                                    <option value="OTRO">OTRO</option>
                                                                </select>
                                                                <select class="form-control" name="motivo_3" id="motivo_3" onchange="otro(this);" style="display:none">
                                                                    <option value=""> Seleccione...</option>
                                                                    <option value="POR TRABAJOS EXTRAORDINARIOS REALIZADOS A CONTINUACIÓN DE LA JORNADA LABORAL">POR TRABAJOS EXTRAORDINARIOS REALIZADOS A CONTINUACIÓN DE LA JORNADA LABORAL</option>
                                                                    <option value="POR TRABAJOS NOCTURNOS O EN DÍAS SÁBADO, DOMINGO Y FESTIVOS">POR TRABAJOS NOCTURNOS O EN DÍAS SÁBADO, DOMINGO Y FESTIVOS</option>
                                                                    <option value="POR ASISTENCIA A CURSOS DE CAPACITACIÓN OBLIGATORIOS FUERA DE LA JORNADA ORDINARIA DE TRABAJO">POR ASISTENCIA A CURSOS DE CAPACITACIÓN OBLIGATORIOS FUERA DE LA JORNADA ORDINARIA DE TRABAJO</option>
                                                                </select>

                                                                </br>
                                                                <textarea class="form-control" id="motivo_otro" name="motivo_otro" rows="2" style="display:none"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        </br></br>
                                        <div id="enviar" style="display:none ;">
                                            <button type="submit" style="width: 60%; " class="mi-boton shadow-effect"><b>Enviar</b></button>

                                        </div>
                                        </br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br />

        </div>
    </div>
    </br>
    <script src="public/javaScript/feriadoLegal.js"></script>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</html>