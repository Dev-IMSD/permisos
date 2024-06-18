<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">
    <title>Inicio de Sesion</title>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-md-row justify-content-center">
            <div class="form-group">
                <img src="/Logoo.png" height="100" width="100" class="d-flex">
                <h2 class="d-flex">Sistema de Solicitud de Bienes y Servicios</h2>
                <h4 class="d-flex">Ingrese Sesión para entrar al sitio</h4>
            </div>
        </div>
    </div>
    <hr>
    <div class="container" id="containerlogin">
        <div class="card shadow-lg form-signin" id="row">

            <div class="card-body p-3">
                <h1 class="fs-4 card-title fw-bold mb-4 text-center" id="titulo">Iniciar sesión</h1>
                <form id="loginForm" autocomplete="off">
                    <div>
                        <div class="mb-3">
                            <label class="mb-2" for="username">Usuario</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="cambioClave">
                            <label class="form-check-label" for="cambioClave">
                                Cambiar contraseña al iniciar sesión
                            </label>
                        </div>

                        <div class="d-flex mb-3 justify-content-center">
                            <button type="submit" class="btn position-fixed " style="background-color: #63d245; color:#ecf0f1;">
                                Iniciar sesion
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    sessionStorage.clear()
                })
                document.getElementById('loginForm').addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Capturar el evento de envío del formulario de inicio de sesión
                    let username = document.getElementById('username').value;
                    let password = document.getElementById('password').value;
                    let cambioClave = document.getElementById('cambioClave').checked;
                    sessionStorage.setItem('username', username)
                    try {
                        const response = await fetch('<?= base_url('/autentificar') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                username: username,
                                password: password
                            })
                        });
                        const data = await response.json(); //.then(response => response.json())
                        if (data.status === 'success') {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Bienvenido',
                                    text: data.message
                                })
                                .then(() => {
                                    // 
                                    if (cambioClave) {
                                        window.location.href = '<?= base_url('/cambioClave') ?> ';
                                    } else {
                                        if (data.nivel == 4) {
                                            window.location.href = '<?= base_url('/') ?>'; // Admin
                                        } else if (data.nivel == 3) {
                                            window.location.href = '<?= base_url('/') ?>'; // Feriado Legal
                                        } else {
                                            window.location.href = '<?= base_url('/login') ?>';
                                        }
                                    }


                                })

                        } else {
                            if (data.status === 'info') {
                                Swal.fire({

                                        icon: 'info',
                                        title: 'info',
                                        text: data.message,
                                        showConfirmButton: true
                                    })
                                    .then(() => {
                                        window.location.href = '<?= base_url('/cambioClave') ?> ';


                                    })
                            } else {
                                Swal.fire({

                                    icon: data.status,
                                    title: 'Ups Algo salio mal',
                                    text: data.message
                                });
                            }


                        }

                    } catch (error) {
                        console.error('Error:', error)

                    };
                });
            </script>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>