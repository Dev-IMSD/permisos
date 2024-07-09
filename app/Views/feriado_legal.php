<!DOCTYPE html>
<html>

<head>
  <?php if ($funcion == "solicitar") { ?>
    <title>Crear Solicitud</title>
  <?php } ?>
  <?php if ($funcion == "corregir") { ?>
    <title>Modificar Solicitud</title>
  <?php } ?>

  <!-- Responsivo !-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon !-->
  <link href="../../loguito.png" rel="shortcut icon" type="image/png">
  <!-- Bootstrap !-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <!-- Iconos !-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Estilos !-->
  <style type="text/css">
    body {
      background-color: #2bbea1;
      /* font-family: Arial; */
    }

    h2 {
      color: #ecf0f1;
      font-size: 38px;
      margin-top: 10px;
    }

    #tutilo {
      color: #ecf0f1;
      margin-top: 5px;
      margin-left: 20px;

    }

    hr {
      margin-top: 20px;
      margin-bottom: 20px;
      margin-right: 70px;
      margin-left: 70px;
      border: 0;
      border-top-color: currentcolor;
      border-top-style: none;
      border-top-width: 0px;
      border-top: 1px solid #eee;
    }

    @media only screen and (min-width: 1578px) {

      #divpagina {
        width: 100%;

        max-width: 1260px;
      }
    }

    @media only screen and (min-width: 400px) {
      #cerrarsesion {
        margin-right: 13px;

      }

      #agregarfuncionario {
        margin-right: 13px;

      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <img src="https://sistemas.santodomingo.cl/solicitud/Logoo.png" height="100" width="100" style="float: left;margin-top: 20px;margin-right: 10px;">
      <div class="form-group">
        <br>
        <?php if ($funcion == "solicitar") { ?>
          <h2>Ingresar Solicitud</h2>
        <?php } ?>
        <?php if ($funcion == "corregir") { ?>
          <h2>Modificar Solicitud</h2>
        <?php } ?>


        <!-- <h6 style="color: #ecf0f1;"  >Usuario: <?php //echo $user->nombres.' '.$user->apellido_paterno.' '.$user->apellido_materno; 
                                                    ?></h6> -->
        <!-- <h6 style="color: #ecf0f1;"  >UTM: <?php //echo $utm; 
                                                ?></h6> -->
        <h5 style="color: #ecf0f1;">Usuario: <?php echo $user->nombre . ' ' . $user->apellido . '  <a href="' . base_url('index.php/permisos/logout') . '"><i class="fa fa-sign-out" style="font-size:100%"></i></a>'; ?></h5>

      </div>
    </div>
  </div>
  <hr />
  <div class="container">
    <div class="card bg-light text-secondary card-body btn-group btn-group-justified" style="width: 60%">
      <legend>
        <!-- <a id="cerrarsesion" href="<?php echo base_url('index.php/permisos/logout'); ?>" class="btn btn-danger">Cerrar Sesión</a> -->
        <a id="agregarfuncionario" href="<?php echo base_url('index.php/permisos/administracion'); ?>" class="btn btn-info" <?php $nivel = $this->session->userdata('nivel');
                                                                                                                            if ($nivel != 4) {
                                                                                                                              echo "hidden";
                                                                                                                            } ?>>Página Principal</a>


        <a id="agregarfuncionario" href="<?php echo base_url('index.php/permisos/mis_solicitudes'); ?>" class="btn btn-primary">Mis solicitudes</a>
      </legend>
    </div>
    <!-- ********** Mensajes ******** -->
    <div style="width: 100%">
      <br>
      <?php
      if ($this->session->flashdata('add_msg')) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $this->session->flashdata('add_msg'); ?>
        </div>
      <?php
      }
      ?>

      <?php
      if ($this->session->flashdata('success_msg')) {
      ?>
        <div class="alert alert-info alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      <?php
      }
      ?>


      <?php
      if ($this->session->flashdata('error_msg')) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <!-- ********** Fomrulario *********** -->
  <script type="text/javascript">
    $(document).ready(function() {
      var funcion = "<?php echo $funcion ?>";
      <?php if ($solicitud != null) { ?>
        if (funcion == "corregir") {

          document.getElementById("id_s").value = <?php echo $solicitud->id ?>;
          // Mostrar el formulario segun tipo 
          document.getElementById("tipo_solicitud").value = "<?php echo $solicitud->tipo_solicitud ?>";
          mostrar_formulario();
          // Mostrar fechas y calcular dias pedidos 
          var d1 = new Date("<?php echo $solicitud->fecha_inicio; ?>");
          console.log(d1);
          d1.setMinutes(d1.getMinutes() - d1.getTimezoneOffset());
          d1 = d1.toJSON().slice(0, 10);
          document.getElementById("desde").value = d1;

          var d2 = new Date("<?php echo $solicitud->fecha_termino; ?>");
          console.log(d2);
          d2.setMinutes(d2.getMinutes() - d2.getTimezoneOffset());
          d2 = d2.toJSON().slice(0, 10);
          document.getElementById("hasta").value = d2;

          // console.log("fecha inicio "+ document.getElementById("desde").value);        
          // console.log("fecha termimo "+ document.getElementById("hasta").value);        
          calcular_dias_pedidos();
          // completar fomulario segun tipo
          var tipo = "<?php echo $solicitud->tipo_solicitud ?>";
          if (tipo == "PERMISO CON GOCE DE REMUNERACIONES") {
            $("input[name=medio_dia][value='<?php echo $solicitud->medio_dia ?>']").prop("checked", true);
            document.getElementById("motivo_1").value = '<?php echo $solicitud->motivo; ?>';
            otro(document.getElementById("motivo_1"));
          }
          if (tipo == "PERMISO SIN GOCE DE REMUNERACIONES") {
            document.getElementById("motivo_2").value = '<?php echo $solicitud->motivo; ?>';
            otro(document.getElementById("motivo_2"));
          }
          if (tipo == "PERMISO POSTNATAL PARENTAL") {
            document.getElementById("semanas_pedidas").value = "<?php echo $solicitud->semanas_pedidas ?>";
            $("input[name=beneficiario][value='<?php echo $solicitud->beneficiario ?>']").prop("checked", true);
            $("input[name=reintegro][value='<?php echo $solicitud->reintegro ?>']").prop("checked", true);
          }
          if (tipo == "PERMISO GREMIAL" || tipo == "DESCANSO COMPLEMENTARIO") {
            // document.getElementById("tiempo").value = "<?php echo $solicitud->tiempo ?>";
            document.getElementById("hora_desde").value = "<?php echo $solicitud->hora_desde ?>";
            document.getElementById("hora_hasta").value = "<?php echo $solicitud->hora_hasta ?>";
            document.getElementById("meses_pedidos").value = "<?php echo $solicitud->meses_pedidos ?>";
            document.getElementById("horas").value = "<?php echo $solicitud->horas ?>";
            document.getElementById("minutos").value = "<?php echo $solicitud->minutos ?>";
            if ("<?php echo $solicitud->motivo; ?>" != "") {
              document.getElementById("motivo_3").value = '<?php echo $solicitud->motivo; ?>';
              otro(document.getElementById("motivo_3"));
            }
          }
          if (tipo == "HACER USO CONJUNTO DE FERIADO LEGAL") {
            var d3 = new Date("<?php echo $solicitud->desde_alcalde; ?>");
            d3.setMinutes(d3.getMinutes() - d3.getTimezoneOffset());
            d3 = d3.toJSON().slice(0, 10);
            document.getElementById("desde_alcalde").value = d3;
            var d4 = new Date("<?php echo $solicitud->hasta_alcalde; ?>");
            d4.setMinutes(d4.getMinutes() - d4.getTimezoneOffset());
            d4 = d4.toJSON().slice(0, 10);

            document.getElementById("hasta_alcalde").value = d4;
            document.getElementById("accion_alcalde").value = "<?php echo $solicitud->accion_alcalde; ?>";

            document.getElementById("year_alcalde").value = <?php echo $solicitud->year ?>;
            //  document.getElementById("txt_validacion").checked = true;
            $("#txt_validacion").prop("checked", true);
          }
          if (<?php echo $solicitud->rut_subrogante; ?> != 0) {
            console.log("rut_subrogante " + "<?php echo $solicitud->rut_subrogante; ?>");

            document.getElementById("rut_subrogante").value = "<?php echo $solicitud->rut_subrogante ?>";
            $("input[name=subrogante][value='si']").prop("checked", true);
            mostrar_funcionarios();
          }
          // if ("<?php echo $solicitud->motivo; ?>" != "" 	) { 
          //   console.log("motivo "+ "<?php echo $solicitud->motivo; ?>"); 
          //   // $("input[name=motivo_1][value='<?php echo $solicitud->motivo; ?>']").prop("selected",true);  
          //   document.getElementById("motivo_1").value = '<?php echo $solicitud->motivo; ?>';
          //   otro(document.getElementById("motivo_1")) ;
          // }
          // document.getElementById("tipo_solicitud").value = "<?php echo $solicitud->tipo_solicitud ?>";
        }
      <?php  } ?>

    });
  </script>
  <div id="containerForm" class="container">
    <div id="accordion">
      <div class="card">

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card bg-light text-dark" stycle="width: 100%">
            <div class="card-body">
              <div class="btn-group btn-group-justified" style="width: 100%">
                <div class="container">
                  <form action="" method="post">
                    <!-- Tipo de solicitud -->

                    <input id="id_s" name="id_s" hidden="" />
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-group">
                              <label for="sel1">Tipo de Solicitud</label>
                              <script type="text/javascript">
                                function mostrar_formulario() {
                                  select = document.getElementById('tipo_solicitud');

                                  if (select.value == "PERMISO CON GOCE DE REMUNERACIONES") {
                                    document.getElementById('F40201').style.display = 'block';
                                    document.getElementById('enviar').style.display = 'block';
                                    document.getElementById('div_motivo').style.display = 'block';
                                    document.getElementById('motivo_1').style.display = 'block';
                                    document.getElementById('dias_disponibles_ad').style.display = 'block';
                                    document.getElementById('dias_F40201').style.display = '';
                                  } else {
                                    document.getElementById('F40201').style.display = 'none';
                                    document.getElementById('dias_disponibles_ad').style.display = 'none';
                                    document.getElementById('dias_F40201').style.display = 'none';
                                    document.getElementById('motivo_1').style.display = 'none';
                                  }
                                  if (select.value == "PERMISO SIN GOCE DE REMUNERACIONES") {
                                    document.getElementById('F40202').style.display = 'block';
                                    document.getElementById('enviar').style.display = 'block';
                                    document.getElementById('meses').style.display = 'block';
                                    document.getElementById('div_motivo').style.display = 'block';
                                    document.getElementById('motivo_2').style.display = 'block';
                                    document.getElementById('dias_F40202').style.display = '';
                                  } else {
                                    document.getElementById('F40202').style.display = 'none';
                                    document.getElementById('meses').style.display = 'none';
                                    document.getElementById('dias_F40202').style.display = 'none';
                                    document.getElementById('motivo_2').style.display = 'none';
                                  }
                                  if (select.value == "PERMISO POSTNATAL PARENTAL") {
                                    document.getElementById('F40203').style.display = 'block';
                                    document.getElementById('enviar').style.display = 'block';
                                    document.getElementById('semanas').style.display = 'block';
                                    document.getElementById('div_motivo').style.display = 'none';
                                    document.getElementById('dias_F40203').style.display = '';
                                  } else {
                                    document.getElementById('F40203').style.display = 'none';
                                    document.getElementById('semanas').style.display = 'none';
                                    document.getElementById('dias_F40203').style.display = 'none';

                                  }
                                  // if (select.value=="PERMISO GREMIAL") {
                                  //   document.getElementById('F40205').style.display='block';     
                                  //   document.getElementById('enviar').style.display='block';                                    
                                  //   document.getElementById('div_motivo').style.display='none';  
                                  // }else{
                                  //   document.getElementById('F40205').style.display='none';   
                                  // }
                                  if (select.value == "PERMISO GREMIAL" || select.value == "DESCANSO COMPLEMENTARIO") {
                                    document.getElementById('F40205').style.display = 'block';
                                    document.getElementById('enviar').style.display = 'block';
                                    if (select.value == "PERMISO GREMIAL") {
                                      document.getElementById('div_motivo').style.display = 'none';
                                      document.getElementById('motivo_3').style.display = 'none';
                                      document.getElementById('dias_F40204').style.display = '';
                                    } else {
                                      document.getElementById('dias_F40205').style.display = '';
                                      document.getElementById('div_motivo').style.display = 'block';
                                      document.getElementById('motivo_3').style.display = 'block';

                                    }

                                  } else {
                                    document.getElementById('F40205').style.display = 'none';
                                    document.getElementById('dias_F40205').style.display = 'none';
                                    document.getElementById('dias_F40204').style.display = 'none';
                                  }
                                  if (select.value == "FERIADO LEGAL") {
                                    document.getElementById('F40206').style.display = 'block';
                                    document.getElementById('enviar').style.display = 'block';
                                    document.getElementById('dias_disponibles').style.display = 'block';
                                    document.getElementById('dias_F40206').style.display = '';
                                    document.getElementById('div_motivo').style.display = 'none';
                                  } else {
                                    document.getElementById('F40206').style.display = 'none';
                                    document.getElementById('dias_disponibles').style.display = 'none';
                                    document.getElementById('dias_F40206').style.display = 'none';
                                  }
                                  if (select.value == "HACER USO CONJUNTO DE FERIADO LEGAL") {
                                    document.getElementById('F40207').style.display = 'block';
                                    document.getElementById('enviar').style.display = 'block';
                                    document.getElementById('declaro').style.display = 'block';
                                    document.getElementById('div_motivo').style.display = 'none';
                                    // document.getElementById('dias_disponibles_ad').style.display='none';
                                  } else {
                                    document.getElementById('F40207').style.display = 'none';
                                    document.getElementById('declaro').style.display = 'none';
                                  }
                                }
                              </script>
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
                      <!-- <button class="btn collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> -->
                      <h5><strong>I. Identificación del Funcionario/a Solicitante.</strong></h5>
                      <!-- </button> -->
                    </h5>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-group">
                              <label>Nombre</label>
                              <input type="text" class="form-control" id="txt_nombresolicitante" name="txt_nombresolicitante" value="<?php echo $user->nombre . ' ' . $user->apellido; ?>" readonly>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label>Rut </label>
                              <input type="text" class="form-control" id="rut_solicitante" name="rut_solicitante" value="<?php echo $user->rut; ?>" readonly>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-group">
                              <label>Cargo solicitante</label>
                              <input type="text" class="form-control" id="txt_cargosolicitante" name="txt_cargosolicitante" value="<?php echo $user->cargo; ?>" readonly>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label>Teléfono de contacto </label>
                              <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" value="<?php echo $user->telefono; ?>" readonly>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-group">
                              <label>Departamento / Unidad </label>
                              <input type="text" class="form-control" id="txt_departamentosolicitante" name="txt_departamentosolicitante" value="<?php echo $user->departamento; ?>" readonly>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label>Direccion solicitante</label>
                              <input type="text" class="form-control" id="txt_direccionsolicitante" name="txt_direccionsolicitante" value="<?php echo $user->direccion; ?>" readonly>
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
                              <input type="text" class="form-control" id="calidad_juridica" name="calidad_juridica" value="<?php echo $user->calidad_juridica; ?>" readonly>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label>Grado</label>
                              <input type="text" class="form-control" id="grado" name="grado" value="<?php echo $user->grado . "°"; ?>" readonly>
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label>Escalafón</label>
                              <input type="text" class="form-control" id="escalafon" name="escalafon" value="<?php echo $user->escalafon; ?>" readonly>
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
                          <td id="dias_disponibles" style="display:none">
                            <div class="form-group">
                              <label>Dias Disponibles</label>
                              <input type="text" class="form-control" id="dias_fl" name="dias_fl" value="<?php echo $dias_fl + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_disponibles_ad" style="display:none">
                            <div class="form-group">
                              <label>Dias Administrativos Disponibles</label>
                              <input type="text" class="form-control" id="dias_ad" name="dias_ad" value="<?php echo $dias_ad + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_F40201" style="display:none;width:50%">
                            <div class="form-group">
                              <label>Dias solicitados para este formulario F40201</label>
                              <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" value="<?php echo $dias_F40201->dias_ocupados + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_F40202" style="display:none;width:50%">
                            <div class="form-group" style="width:50%">
                              <label>Dias solicitados para este formulario F40202</label>
                              <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" value="<?php echo $dias_F40202->dias_ocupados + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_F40203" style="display:none;width:50%">
                            <div class="form-group" style="width:50%">
                              <label>Dias solicitados para este formulario F40203</label>
                              <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" value="<?php echo $dias_F40203->dias_ocupados + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_F40204" style="display:none;width:50%">
                            <div class="form-group" style="width:50%">
                              <label>Dias solicitados para este formulario F40204</label>
                              <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" value="<?php echo $dias_F40204->dias_ocupados + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_F40205" style="display:none;width:50%">
                            <div class="form-group" style="width:50%">
                              <label>Dias solicitados para este formulario F40205</label>
                              <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" value="<?php echo $dias_F40205->dias_ocupados + 0; ?>" readonly>
                            </div>
                          </td>
                          <td id="dias_F40206" style="display:none;width:50%">
                            <div class="form-group">
                              <label>Dias solicitados para este formulario F40206</label>
                              <input type="text" class="form-control" id="dias_ocupados" name="dias_ocupados" value="<?php echo $dias_F40206 + 0; ?>" readonly>
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
                              <label>Fecha de inicio </label>
                              <input class="form-control" type="date" id="desde" name="desde" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'))) ?>">
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label>Fecha de término </label>
                              <input class="form-control" type="date" onchange="calcular_dias_pedidos();" id="hasta" name="hasta" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d'))) ?>">
                            </div>
                          </td>
                          <script>
                            function calcular_dias_pedidos() {
                              desde = new Date(document.getElementById("desde").value);
                              hasta = new Date(document.getElementById("hasta").value);
                              console.log("fecha inicio " + document.getElementById("desde").value);
                              select = document.getElementById("tipo_solicitud").value;
                              if (select == "FERIADO LEGAL") {
                                dias = document.getElementById("dias_fl").value
                              } else if (select == "PERMISO CON GOCE DE REMUNERACIONES") {
                                dias = document.getElementById("dias_ad").value
                              } else {
                                dias = 1000
                              }
                              const diffTime = Math.abs(hasta - desde);
                              const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                              // dias_pedidos = (diffDays +1);
                              var days = 0;
                              while (desde < hasta) {
                                desde.setDate(desde.getDate() + 1)
                                // If day isn't a Sunday or Saturday, add to business days
                                if (desde.getDay() != 0 && desde.getDay() != 6) {
                                  ++days;
                                }
                              }
                              dias_pedidos = (days + 1);
                              console.log("Dias hábiles " + (days + 1));
                              console.log("Dias pedidos : " + dias_pedidos);

                              console.log("Dias disponibles : " + dias);
                              medio_dia = document.querySelector('input[name="medio_dia"]:checked').value;
                              console.log("Medio dia  : " + medio_dia);
                              if (medio_dia == "Mañana" || medio_dia == "Tarde") {
                                if (dias_pedidos >= 0) {
                                  dias_pedidos = dias_pedidos / 2;
                                }
                              }

                              if (dias_pedidos > dias) {
                                if (select == "FERIADO LEGAL" || select == "PERMISO CON GOCE DE REMUNERACIONES") {
                                  alert("Los dias solicitados no pueden ser superior a los disponibles");
                                  if (dias_pedidos >= 0) {
                                    document.getElementById("dias_pedidos").value = dias_pedidos;
                                  }
                                  document.getElementById('enviar').style.display = 'none';
                                  document.getElementById('div_motivo').style.display = 'none';

                                  // }elseif ( select=="PERMISO SIN GOCE DE REMUNERACIONES"){
                                }
                              } else {
                                document.getElementById('enviar').style.display = 'block';
                                // if (select!="FERIADO LEGAL") {           
                                // document.getElementById('div_motivo').style.display='block';    
                                // }
                                if (dias_pedidos >= 0) {
                                  document.getElementById("dias_pedidos").value = dias_pedidos;
                                }


                                if (dias_pedidos >= 2) {
                                  document.getElementById('div_subrogante').style.display = 'block';
                                } else {
                                  document.getElementById('div_subrogante').style.display = 'none';
                                }
                                if (dias_pedidos >= 30) {
                                  document.getElementById("meses_pedidos").value = Math.trunc(dias_pedidos / 30);
                                } else {
                                  document.getElementById("meses_pedidos").value = "";
                                }
                                if (dias_pedidos >= 5) {
                                  document.getElementById("semanas_pedidas").value = Math.trunc(dias_pedidos / 5);
                                } else {
                                  document.getElementById("semanas_pedidas").value = "";
                                }
                              }
                            }
                          </script>
                          <td>
                            <div class="form-group">
                              <label>Dias Solicitados</label>
                              <input type="text" class="form-control" id="dias_pedidos" name="dias_pedidos" readonly>
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
                          <tr>
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
                            <!-- <td>
                                <div class="form-group">
                                  <label>Motivo</label>                                 
                                  <textarea class="form-control" id="motivo" name="motivo" rows="2" ></textarea>
                                </div> 
                              </td> -->
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
                                    <!-- <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si" >
                                      Declaro conocer que: <br> -->
                                    Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                    (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                  </label>
                                </div>
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- Formulario PERMISO SIN GOCE DE REMUNERACIONES -->
                    <div id="F40202" style="display:none">
                      <!-- Form -->
                      <!-- <table class="table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="form-group">
                                  <label>Motivo</label>                                 
                                  <textarea class="form-control" id="motivo" name="motivo" rows="2" ></textarea>
                                </div> 
                              </td>
                            </tr>
                          </tbody>                          
                        </table> -->
                      <!-- declaracion -->
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-group">
                                <div class="form-check">
                                  <label class="form-check-label" style="background-color: #deeaf6;border-style: solid;border-color: #0064ac;">
                                    <!-- <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si" >
                                      Declaro conocer que: <br> -->
                                    Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                    (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                  </label>
                                </div>
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
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
                                    <!-- <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si" >
                                      Declaro conocer que: <br> -->
                                    Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                    (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                    En caso de ser necesaria la contratación de un suplente, el directivo de la unidad de desempeño deberá comunicarlo expresamente y por escrito a la Dirección de Recursos Humanos, previa validación del ítem presupuestario respectivo.
                                  </label>
                                </div>
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
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
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
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
                              window.addEventListener('click', function(e) {

                                if (!document.getElementById('hora_hasta').contains(e.target)) {
                                  desde = new Date(document.getElementById("desde").value);
                                  hasta = new Date(document.getElementById("hasta").value);


                                  const diffTime = Math.abs(hasta - desde);
                                  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                  // console.log("Dias pedidos : " + (diffDays +1))


                                  horadesde = document.getElementById("hora_desde").value;
                                  horahasta = document.getElementById("hora_hasta").value;


                                  var hours_desde = horadesde.split(":")[0];
                                  var minutes_desde = horadesde.split(":")[1];
                                  var hours_hasta = horahasta.split(":")[0];
                                  var minutes_hasta = horahasta.split(":")[1];



                                  totalhoras = (hours_hasta - hours_desde) * (diffDays + 1);
                                  totalmin = (minutes_hasta - minutes_desde) * (diffDays + 1);

                                  var total_minutos = (totalhoras * 60) + totalmin;
                                  var total = total_minutos / 60;

                                  console.log("*******************");
                                  console.log("Horas en total : " + Math.trunc(total));

                                  console.log("Minutos en total : " + (total_minutos - (Math.trunc(total) * 60)));
                                  // console.log("Hora Desde : " + totalhoras);
                                  // console.log("minutes_hasta : " + minutes_hasta);
                                  if (minutes_hasta) {
                                    document.getElementById("horas").value = totalhoras;
                                    document.getElementById("minutos").value = totalmin;
                                  }

                                }
                              })
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
                          <!-- <tr>
                              <td>
                                <div class="form-group">
                                  <label>Motivo</label>                                 
                                  <textarea class="form-control" id="motivo" name="motivo" rows="2" ></textarea>
                                </div> 
                              </td>
                            </tr> -->
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
                                    <!-- <input type="checkbox" id="txt_validacion" class="form-check-input" value="Si" >
                                      Declaro conocer que: <br> -->
                                    Si el permiso, que por esta vía Ud. formalmente solicita, supera un (1) día, deberá indicar el nombre, apellidos y RUT del funcionario/a que le subrogará durante su ausencia, de conformidad al Principio de Continuidad de la Función Pública.
                                    (Art. 3°, inciso primero, de la ley N° 18.575, Orgánica Constitucional de Bases Generales de la Administración del Estado).
                                  </label>
                                </div>
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
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
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
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
                                  <option value="POSTERGA">ANTICIPA</option>
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
                                      <option value="2021">2021</option>
                                      <option value="2022">2022</option>
                                    </select>
                                    ; de conformidad a lo dispuesto en el artículo 103, inciso segundo, de la ley N° 18.883, Aprueba Estatuto Administrativo para Funcionarios Municipales. </label>
                                </div>
                                <span class="text-danger"><?php echo form_error('txt_validacion'); ?></span>
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
                                    <input type="radio" id="subrogante" name="subrogante" value="si" onclick="mostrar_funcionarios();"> Si
                                  </label>
                                  <label style="padding-right: 20px">
                                    <input type="radio" id="subrogante" name="subrogante" value="no" checked onclick="mostrar_funcionarios();"> No
                                  </label>
                                </div>
                              </div>
                              <script type="text/javascript">
                                function mostrar_funcionarios() {
                                  console.log(document.getElementById('subrogante').checked);
                                  if (document.getElementById('subrogante').checked == true) {
                                    document.getElementById('div_subrogante_select').style.display = 'block';
                                  } else {
                                    document.getElementById('div_subrogante_select').style.display = 'none';
                                  }


                                }
                              </script>
                            </td>

                            <td>
                              <div class="form-group" id="div_subrogante_select" style="display:none">
                                <label for="sel1">Funcionario/a que Subrogará</label>
                                <select class="form-control" name="rut_subrogante" id="rut_subrogante">
                                  <option value="">Seleccione...</option>
                                  <?php
                                  foreach ($subrogantes as $subrogante) {

                                  ?>
                                    <option value="<?php echo $subrogante->rut; ?>"><?php echo $subrogante->nombre . ' ' . $subrogante->apellido; ?></option>

                                  <?php
                                  }
                                  ?>
                                </select>

                              </div>
                            </td>
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
                              <script type="text/javascript">
                                function otro(select) {
                                  console.log(select.value);
                                  if (select.value == "OTRO") {
                                    document.getElementById('motivo_otro').style.display = 'block';
                                  } else {
                                    document.getElementById('motivo_otro').style.display = 'none';
                                  }
                                }
                              </script>
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
                    <div id="enviar" style="display:none">
                      <button type="submit" style="width: 40%;float: left;" onclick="return confirm('Guardar datos?');" class="btn btn-info btn-block">Enviar</button>
                      <!-- <button type="submit"  id="botonEnviar" class="btn btn-secondary btn-block" formaction="<?php echo base_url('index.php/permisos/guardarborrador') ?>">Guardar Borrador</button>  -->
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
</body>

</html>