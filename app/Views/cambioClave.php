<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Logoo.png" rel="shortcut icon" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/icon.css">
    <title>Cambio Contraseña</title>
</head>

<body> 
    <div class="container">
        <div class="d-flex flex-md-row justify-content-center">
            <div class="form-group">
                <img src="/Logoo.png" height="100" width="100"> 
                <h2 class="d-flex">Sistema de Solicitud de Bienes y Servicios</h2>
                <h4 class="d-flex">Cambio de Contraseña</h4>
            </div>
        </div>

    </div>
    <hr>
    <div class="container" id="containerlogin">
        <div class="card shadow-lg form-signin" id="row">
            <div class="card-body p-3">
                <h1 class="fs-4 card-title fw-bold mb-4 text-center" id="titulo">Cambio de Contraseña</h1>
                <form id="cambioClaveForm" autocomplete="off">
                    <div>
                        <div>
                            <label for="texto">
                            <b>
                                Requisitos:<br>
                                La contraseña debe tener al menos 8 caracteres<br>
                                La contraseña debe contener al menos una letra mayúscula<br>
                                La contraseña debe contener al menos una letra minúscula<br>
                                La contraseña debe contener al menos un número<br>
                                La contraseña debe contener al menos un carácter especial<br><br>

                            </b>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="mb-2" for="password1">Nueva Contraseña</label>
                            <input type="password" class="form-control" name="password1" id="password1" required>
                            <i class="bx bx-show-alt" id="icon1"></i>
                        </div>
                        <div class="mb-2">
                            <label for="password2">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="password2" id="password2" required>
                            <i class='bx bx-show-alt' id="icon2"></i>
                        </div>
                        <div class="d-flex mb-3 justify-content-center">
                            <button type="submit" class="btn position-fixed" style="background-color: #63d245; color:#ecf0f1; ">
                                Actualizar
                            </button>
                        </div>
                    </div> 
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="public/javaScript/cambioClave.js"></script> 
</body>
</html>