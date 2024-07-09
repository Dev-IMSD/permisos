<?php
$session = session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="/Logoo.png" rel="shortcut icon" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <!-- ICONOS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <title>Inicio</title>
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="form-group">
                <img src="https://sistemas.santodomingo.cl/solicitud/Logoo.png" height="100" width="100" class="d-flex">

                <h2 class="d-flex">Sistema de Solicitud de Bienes y Servicios</h2>

                <h5 class="d-flex" style="color: #ecf0f1;">Usuario: <?= $session->nombre .  '  <a href="' . base_url('/logout') . '"><i class="fa fa-sign-out" style="font-size:100%"></i></a>'; ?></h5>



            </div>
        </div>
    </div>
    <br>
    <div class="container">

        <nav class="navbar navbar-expand-lg bg-body-tertiary  rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/feriadoLegal'); ?>">Nueva Solicitud</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""></a>
                        </li>

                    </ul>
                    <form role="search">
                        <input class="form-control buscar" id="buscar" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
            </div>
        </nav>



    </div>
    <div class="container">
        <table  id="listaSolicitudes" class="table table-hover table-bordered my-3" aria-describedby="titulo">
            <thead class="table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Solicitud</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha de Solicitud</th>
                    <th scope="col">Solicitado por</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Dias Solicitados</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ver</th>

                </tr>
            </thead>

            <tbody>
                <?php if (!empty($solicitudes)) : ?>
                    <?php foreach ($solicitudes as $solicitud) : ?>
                        <tr>

                            <td><?= $solicitud['id']; ?></td>
                            <td><?= $solicitud['id_solicitud']; ?></a></td>
                            <td><?= $solicitud['tipo_solicitud']; ?></td>
                            <td><?= $solicitud['fecha']; ?></td>
                            <td><?= $solicitud['nombre']; ?></td>
                            <td><?= $solicitud['departamento']; ?></td>
                            <td><?= $solicitud['dias']; ?></td>
                            <td><?= $solicitud['motivo']; ?></td>
                            <td><?= $solicitud['estado']; ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="editar-solicitud btn" data-id="<?= $solicitud['id_solicitud']; ?>">
                                        <i class='bx bx-edit'></i>
                                    </button>
                                    <button class="ver-pdf btn" data-id="<?= $solicitud['id_solicitud']; ?>">
                                        <i class="bx bx-show-alt" id="icon3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9">No hay solicitudes disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="public/javaScript/home.js"></script>               
</body>

</html>