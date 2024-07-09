document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('DOMContentLoaded', (event) => {
        sessionStorage.clear()
    })
    document.getElementById('loginForm').addEventListener('submit', async function (e) {
        e.preventDefault();


        const baseURL = `${window.location.protocol}//${window.location.host}`


        // Capturar el evento de envío del formulario de inicio de sesión
        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;
        let cambioClave = document.getElementById('cambioClave').checked;
        sessionStorage.setItem('username', username)
        try {
            const response = await fetch(`${baseURL}/autentificar`, {
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
                            window.location.href = `${baseURL}/cambioClave`;
                        } else {
                            if (data.nivel == 4) {
                                window.location.href = `${baseURL}/`; // Admin
                            } else if (data.nivel == 3) {
                                window.location.href = `${baseURL}/`; // Feriado Legal
                            } else {
                                window.location.href = `${baseURL}/login`;
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
                            window.location.href = `${baseURL}/cambioClave`;


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

});