document.addEventListener('DOMContentLoaded', function () {

    const baseURL = `${window.location.protocol}//${window.location.host}`

    let pass1 = document.getElementById("password1");
    let icon1 = document.getElementById("icon1");
    let pass2 = document.getElementById("password2");
    let icon2 = document.getElementById("icon2");
    let username = sessionStorage.getItem("username");

    icon1.addEventListener("click", e => {
        if (pass1.type == "password") {
            pass1.type = "text";
            icon1.classList.remove('bx-show-alt')
            icon1.classList.add('bx-hide')
        } else {
            pass1.type = "password"
            icon1.classList.add('bx-show-alt')
            icon1.classList.remove('bx-hide')
        }
    })

    icon2.addEventListener("click", e => {
        if (pass2.type == "password") {
            pass2.type = "text";
            icon2.classList.remove('bx-show-alt')
            icon2.classList.add('bx-hide')
        } else {
            pass2.type = "password"
            icon2.classList.add('bx-show-alt')
            icon2.classList.remove('bx-hide')
        }

    })

    document.getElementById('cambioClaveForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        await verificarPasswords();

        

        async function verificarPasswords() {
            let pass1 = document.getElementById("password1");
            let pass2 = document.getElementById("password2");

            if (pass1.value !== pass2.value) {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "¡Tus contraseñas no coinciden 👀!",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                try {
                    const response = await fetch(`${baseURL}/actualizacionClave`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            username: username,
                            password: pass1.value
                        })
                    });
                    const data = await response.json();
                    if (data.status === 'success') {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "¡Se ha cambiado tu contraseña!",
                            text: "Porfavor ingrese nuevamente",
                            showConfirmButton: false,
                            timer: 2200
                        }).then(() => {
                            window.location.href = `${baseURL}/login`;
                        });

                    } else {
                        Swal.fire({
                            icon: data.status,
                            title: 'Ups!! , algo salió mal',
                            text: data.message
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al procesar la solicitud. :' + data
                    });
                }
            }
        }
    });



});