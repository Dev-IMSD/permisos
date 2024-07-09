document.addEventListener('DOMContentLoaded', function () {
    
    let titulo;
    titulo = document.getElementById("titulo")

    titulo.innerHTML = `Ingresar Solicitud `;

    // Funcion del select de los formularios 
    async function mostrar_formulario() {

        let select = document.getElementById('tipo_solicitud');

        try {
            document.getElementById('fechaF').style.display = 'none';

            let diasPedidos = 0;
            let desde = "";
            let hasta = "";

            const baseURL = `${window.location.protocol}//${window.location.host}`;


            if (select.value == "PERMISO CON GOCE DE REMUNERACIONES") {
                let response = await fetch(`${baseURL}/formulario_F40201`)
                let data = await response.json();
                // se muestran los campos correpondientes al formulario 
                document.getElementById('fechaF').style.display = '';
                document.getElementById('dias_disponibles_ad').style.display = '';
                document.getElementById('dias_F40201').style.display = '';
                document.getElementById('dias_ad').style.display = 'block';
                document.getElementById('dias_ocupados').style.display = 'block';
                // Se guardan los datos vienen del controlador en varibles
                document.getElementById('dias_ad').value = data.diasDisponibleAd;
                document.getElementById('dias_ocupados').value = data.diasF40201;

                opcion_subrogantes(data.subrogantes);
            } else {
                document.getElementById('F40201').style.display = 'none';
                document.getElementById('dias_disponibles_ad').style.display = 'none';
                document.getElementById('dias_F40201').style.display = 'none';
                document.getElementById('motivo_1').style.display = 'none';
            }

            if (select.value == "PERMISO SIN GOCE DE REMUNERACIONES") {
                let response = await fetch(`${baseURL}/formulario_F40202`);
                let data = await response.json();

                // se muestran los campos correpondientes al formulario
                document.getElementById('fechaF').style.display = '';
                document.getElementById('F40202').style.display = 'block';
                document.getElementById('enviar').style.display = 'block';
                document.getElementById('meses').style.display = 'block';
                document.getElementById('div_motivo').style.display = 'block';
                document.getElementById('motivo_2').style.display = 'block';
                document.getElementById('dias_F40202').style.display = '';

                // Se guardan los datos vienen del controlador en varibles
                document.getElementById('dias_ocupados1').value = data.diasF40202;

                opcion_subrogantes(data.subrogantes);


            } else {
                document.getElementById('F40202').style.display = 'none';
                document.getElementById('meses').style.display = 'none';
                document.getElementById('dias_F40202').style.display = 'none';
                document.getElementById('motivo_2').style.display = 'none';
            }

            if (select.value == "PERMISO POSTNATAL PARENTAL") {
                let response = await fetch(`${baseURL}/formulario_F40203`);
                let data = await response.json();

                // se muestran los campos correpondientes al formulario
                document.getElementById('fechaF').style.display = '';
                document.getElementById('F40203').style.display = 'block';
                document.getElementById('enviar').style.display = 'block';
                document.getElementById('semanas').style.display = 'block';
                document.getElementById('div_motivo').style.display = 'none';
                document.getElementById('dias_F40203').style.display = '';

                // Se guardan los datos vienen del controlador en varibles
                document.getElementById('dias_ocupados2').value = data.diasF40203;

                opcion_subrogantes(data.subrogantes);
            } else {
                document.getElementById('F40203').style.display = 'none';
                document.getElementById('semanas').style.display = 'none';
                document.getElementById('dias_F40203').style.display = 'none';
            }

            if (select.value == "PERMISO GREMIAL" || select.value == "DESCANSO COMPLEMENTARIO") {
                let response = await fetch(`${baseURL}/formulario_F40204_F40205`);
                let data = await response.json();
                // se muestran los campos correpondientes al formulario

                document.getElementById('F40205').style.display = 'block';
                document.getElementById('enviar').style.display = 'block';
                if (select.value == "PERMISO GREMIAL") {
                    document.getElementById('fechaF').style.display = '';
                    document.getElementById('div_motivo').style.display = 'none';
                    document.getElementById('motivo_3').style.display = 'none';
                    document.getElementById('dias_F40204').style.display = '';

                    // Se guardan los datos vienen del controlador en varibles
                    document.getElementById('dias_ad').value = data.diasDisponibleAd;
                    document.getElementById('dias_ocupados3').value = data.diasF40204;

                    opcion_subrogantes(data.subrogantes);
                } else {
                    document.getElementById('fechaF').style.display = '';
                    document.getElementById('dias_F40205').style.display = '';
                    document.getElementById('div_motivo').style.display = 'block';
                    document.getElementById('motivo_3').style.display = 'block';

                    // Se guardan los datos vienen del controlador en varibles
                    document.getElementById('dias_ad').value = data.diasDisponibleAd;
                    document.getElementById('dias_ocupados4').value = data.diasF40205;

                    opcion_subrogantes(data.subrogantes);
                }
            } else {
                document.getElementById('F40205').style.display = 'none';
                document.getElementById('dias_F40205').style.display = 'none';
                document.getElementById('dias_F40204').style.display = 'none';
            }

            if (select.value == "FERIADO LEGAL") {
                let response = await fetch(`${baseURL}/formulario_F40206`);
                let data = await response.json();

                document.getElementById('fechaF').style.display = '';
                document.getElementById('F40206').style.display = 'block';
                document.getElementById('enviar').style.display = 'block';
                document.getElementById('div_motivo').style.display = 'none';
                document.getElementById('dias_disponibles').style.display = '';
                document.getElementById('dias_F40206').style.display = '';

                // Se guardan los datos vienen del controlador en varibles
                document.getElementById('dias_fl').value = data.diasDisponibleFl;
                document.getElementById('dias_ocupados5').value = data.diasOcupadosFl;

                opcion_subrogantes(data.subrogantes);
            } else {
                document.getElementById('F40206').style.display = 'none';
                document.getElementById('dias_disponibles').style.display = 'none';
                document.getElementById('dias_F40206').style.display = 'none';
            }

            if (select.value == "HACER USO CONJUNTO DE FERIADO LEGAL") {
                let response = await fetch(`${baseURL}/formulario_F40207`);
                let data = await response.json();
                document.getElementById('fechaF').style.display = 'none';
                document.getElementById('F40207').style.display = 'block';
                document.getElementById('enviar').style.display = 'block';
                document.getElementById('declaro').style.display = 'block';
                document.getElementById('div_motivo').style.display = 'none';

                opcion_subrogantes(data.subrogantes);
            } else {
                document.getElementById('F40207').style.display = 'none';
                document.getElementById('declaro').style.display = 'none';
            }
        } catch (error) {
            console.error('Error al obtener datos:', error);
        }

    }


    // Calculo de los dias y horas 
    let diasPedidos = 0;
    let desde = "";
    let hasta = "";

    function calcular_dias_pedidos() {
        let desde = new Date(document.getElementById("desde").value);
        let hasta = new Date(document.getElementById("hasta").value);
        let dias;

        select = document.getElementById("tipo_solicitud").value;
        if (select == "FERIADO LEGAL") {
            dias = parseInt(document.getElementById("dias_fl").value, 10);
        } else if (select == "PERMISO CON GOCE DE REMUNERACIONES") {
            dias = parseInt(document.getElementById("dias_ad").value, 10);
        } else {
            dias = 1000;
        }

        const diffTime = Math.abs(hasta - desde);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        let days = 0;
        let tempDate = new Date(desde); // Crear una copia de la fecha 'desde' para no modificar el original

        while (tempDate <= hasta) {
            tempDate.setDate(tempDate.getDate() + 1);
            // Si el día no es domingo (0) ni sábado (6), se suma a los días hábiles
            if (tempDate.getDay() != 0 && tempDate.getDay() != 6) {
                ++days;
            }

        }
        diasPedidos = days; // Almacenar los días

        if (diasPedidos > dias) {

            if (select == "FERIADO LEGAL" || select == "PERMISO CON GOCE DE REMUNERACIONES") {
                Swal.fire({
                    position: "center",
                    icon: "info",
                    title: "Los dias solicitados no pueden ser superior a los disponibles",
                    showConfirmButton: true,
                });
                document.getElementById("desde").value = "";
                document.getElementById("hasta").value = "";
                console.log(diasPedidos)
                console.log(dias)

                document.getElementById('F40201').style.display = 'none';
                document.getElementById('tr_medio_dia').style.display = 'none';


                if (diasPedidos >= 0) {
                    document.getElementById("diasPedidos").value = diasPedidos;
                }


                document.getElementById('enviar').style.display = 'none';
                document.getElementById('div_motivo').style.display = 'none';
                document.getElementById('motivo_1').style.display = 'none';

                // }elseif ( select=="PERMISO SIN GOCE DE REMUNERACIONES"){
            }
        } else {

            if (select == "PERMISO CON GOCE DE REMUNERACIONES") {
                document.getElementById('F40201').style.display = 'none';
                document.getElementById('tr_medio_dia').style.display = 'none';
                if (diasPedidos != 0 || (diasPedidos = "")) {
                    document.getElementById('F40201').style.display = 'block';
                    document.getElementById('tr_medio_dia').style.display = 'block';

                    let medio_dia = document.querySelector('input[name="medio_dia"]:checked').value;

                    if (medio_dia == "Mañana" || medio_dia == "Tarde") {
                        if (diasPedidos >= 0) {
                            diasPedidos = diasPedidos / 2;

                            document.getElementById('div_motivo').style.display = 'block';
                            document.getElementById('motivo_1').style.display = 'block';
                            document.getElementById('enviar').style.display = 'block';



                        }
                    }
                }


            }


            if (diasPedidos >= 0) {
                document.getElementById("diasPedidos").value = diasPedidos;
            }

            if (diasPedidos == 0) {
                document.getElementById('div_subrogante').style.display = 'none';
            }

            if (diasPedidos >= 2) {
                document.getElementById('div_subrogante').style.display = 'block';
            } else {

                document.getElementById('div_subrogante').style.display = 'none';
            }
            if (diasPedidos >= 30) {
                document.getElementById("meses_pedidos").value = Math.trunc(diasPedidos / 30);
            } else {
                document.getElementById("meses_pedidos").value = "";
            }
            if (diasPedidos >= 5) {
                document.getElementById("semanas_pedidas").value = Math.trunc(diasPedidos / 5);
            } else {
                document.getElementById("semanas_pedidas").value = "";
            }
        }
    }

    window.addEventListener('click', function (e) {

        if (!document.getElementById('hora_hasta').contains(e.target)) {
            let horadesde = document.getElementById("hora_desde").value;
            let horahasta = document.getElementById("hora_hasta").value;

            let hours_desde = horadesde.split(":")[0];
            let minutes_desde = horadesde.split(":")[1];
            let hours_hasta = horahasta.split(":")[0];
            let minutes_hasta = horahasta.split(":")[1];



            totalhoras = (hours_hasta - hours_desde) * diasPedidos;
            totalmin = (minutes_hasta - minutes_desde) * diasPedidos;


            if (totalmin >= 60) {
                totalhoras += Math.floor(totalmin / 60);
                totalmin = totalmin % 60;
            }




            if (minutes_hasta) {
                document.getElementById("horas").value = totalhoras;
                document.getElementById("minutos").value = totalmin;
            }

        }
    })

    // parte de seleccion de subrogante si supera mas de 2 dias los feriados  
    function mostrar_funcionarios() {
        if (document.getElementById("desde").value != "" && document.getElementById("hasta").value != "")
            if (document.getElementById('subrogante_si').checked) {
                document.getElementById('div_subrogante_select').style.display = 'block';
            } else {
                document.getElementById('div_subrogante_select').style.display = 'none';
            }
        else {
            document.getElementById('div_subrogante').style.display = 'none'
        }
    }


    function opcion_subrogantes(subrogantes) {
        let subroganteSelect = document.getElementById('rut_subrogante');
        //Agrega en el HTML crea un select
        subroganteSelect.innerHTML = '<option value="">Seleccione...</option>';
        subrogantes.forEach(function (subrogante) {

            // Crea las opciones del select 
            let option = document.createElement('option');
            option.value = subrogante.rut;
            option.textContent = subrogante.nombre + ' ' + subrogante.apellido;
            subroganteSelect.appendChild(option);
        });
    }

    // Seleccion del motivo otro, se despliega un cuado para ingresar las razones 
    function otro(select) {

        if (select.value == "OTRO") {
            document.getElementById('motivo_otro').style.display = 'block';
        } else {
            document.getElementById('motivo_otro').style.display = 'none';
        }
    }


    //obtener el solicitud y los coloca en la pagina
    async function cargarDatosSfl(id_solicitud) {
        const baseURL = `${window.location.protocol}//${window.location.host}`;
        try {
            const response = await fetch(`${baseURL}/obtenerSfl/${id_solicitud}`);
            const data = await response.json();
            // Comparacion para que la solicitud consultada si exista
            if (data.solicitud != undefined) {

                // Modifica el titulo 
                titulo.innerHTML = `Editar Solicitud ${id_solicitud}`;

                let select = document.getElementById('tipo_solicitud')
                //Guarda la variable para que sea mas simple de utilizar
                //Ademas el select.value selecciona valor del tipo de solicitud
                let tipoSolicitud = select.value = data.solicitud.tipo_solicitud;
                document.getElementById('tipo_solicitud').setAttribute('readonly', true);

                document.getElementById('fechaF').style.display = 'block';
                
                //Segun el tipo de solicitud muestra la informarcion necesaria 

                if ((tipoSolicitud) == "PERMISO CON GOCE DE REMUNERACIONES") {
                    document.querySelector(`input[name="medio_dia"][value="${data.solicitud.medio_dia}"]`).checked = true;
                    document.getElementById('motivo_1').style.display = 'block';
                    document.getElementById("motivo_1").value = data.solicitud.motivo;
                    

                }
                if ((tipoSolicitud) == "PERMISO SIN GOCE DE REMUNERACIONES") {
                    document.getElementById('motivo_2').style.display = 'block';
                    document.getElementById("motivo_2").value = data.solicitud.motivo;
                    data.solicitud.motivo

                }
                if ((tipoSolicitud) == "DESCANSO COMPLEMENTARIO") {
                    document.getElementById('tiempo').value = data.solicitud.tiempo;
                    document.getElementById('hora_desde').value = data.solicitud.hora_desde;
                    document.getElementById('hora_hasta').value = data.solicitud.hora_hasta;
                    document.getElementById('horas').value = data.solicitud.horas;
                    document.getElementById('minutos').value = data.solicitud.minutos;
                    document.getElementById('motivo_3').style.display = 'block';
                    document.getElementById("motivo_3").value = data.solicitud.motivo;
                    
                }

                if ((tipoSolicitud) == "PERMISO POSTNATAL PARENTAL") {
                    document.getElementById('semanas_pedidas').value = data.solicitud.semanas_pedidas;
                    document.querySelector(`input[name="beneficiario"][value="${data.solicitud.beneficiario}"]`).checked = true;
                    document.querySelector(`input[name="reintegro"][value="${data.solicitud.reintegro}"]`).checked = true;
                }

                if ((tipoSolicitud) == "PERMISO GREMIAL") {
                    document.getElementById('tiempo').value = data.solicitud.tiempo;
                    document.getElementById('hora_desde').value = data.solicitud.hora_desde;
                    document.getElementById('hora_hasta').value = data.solicitud.hora_hasta;
                    document.getElementById('horas').value = data.solicitud.horas;
                    document.getElementById('minutos').value = data.solicitud.minutos;
                    document.getElementById('meses_pedidos').value = data.solicitud.meses_pedidos;
                    document.getElementById('semanas_pedidas').value = data.solicitud.semanas_pedidas;
                }

                if ((tipoSolicitud) == "HACER USO CONJUNTO DE FERIADO LEGAL") {
                    document.getElementById('desde_alcalde').value = data.solicitud.desde_alcalde;
                    document.getElementById('hasta_alcalde').value = data.solicitud.hasta_alcalde;
                    document.getElementById('accion_alcalde').value = data.solicitud.accion_alcalde;
                    document.getElementById('year_alcalde').value = data.solicitud.year;

                }


                document.getElementById('desde').value = data.solicitud.fecha_inicio;
                document.getElementById('hasta').value = data.solicitud.fecha_termino;

                document.getElementById('rut_subrogante').value = data.solicitud.rut_subrogante;

                document.getElementById('diasPedidos').value = data.dias;
                calcular_dias_pedidos();
                document.getElementById("diasPedidos").value = diasPedidos;

                // Lo muestra en el formulario
                mostrar_formulario();


            } else {
                swal.fire({
                    title: "No existe la solicitud buscada",
                    icon: "error"
                });

            }

        } catch (error) {
            console.error('Error al cargar datos de la solicitud:', error);

        }

    }

    //obtiene la varible de la sessionStorage
    function obtenerIdSolicitud() {
        return sessionStorage.getItem('id_solicitud');
    }

    
    // Obtener el ID de solicitud desde sessionStorage
    const id_solicitud = obtenerIdSolicitud();
    if (id_solicitud) {
        cargarDatosSfl(id_solicitud);
    } else {
        swal.fire({
            title: "No se encontró ID de solicitud en sessionStorage",
            icon: "error"
        });
    }
    
    // parte del enviado post de informacion 

    document.getElementById('formSolicitud').addEventListener('submit', async function (e) {
        e.preventDefault();
        async function guardarInformacion() {
            Swal.fire({
                title: "Quieres realizar la solicitud?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Si, estoy seguro",
                denyButtonText: `No, no estoy seguro`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Guardado la informacion!", "", "success");
                    enviarSolicitud(); // Llama a la función para enviar los datos
                } else if (result.isDenied) {
                    Swal.fire("La información no se ha guardado", "", "info");
                }
            });
        }
        guardarInformacion();
    });

    async function enviarSolicitud() {
        const form = document.getElementById('formSolicitud');
        const formData = new FormData(form);

        const baseURL = `${window.location.protocol}//${window.location.host}`;

        // Si es nuevo lo envia por solicitar
        let url = `${baseURL}/solicitar`;
        let method = 'POST'
        const id_solicitud = obtenerIdSolicitud();
        console.log(id_solicitud)

        // Si edita uno exitente lo envia editarSolicitud
        if (id_solicitud) {
            const id_solicitud = obtenerIdSolicitud();
            url = `${baseURL}/editarSolicitud/${id_solicitud}`
            method = 'POST'
            
        }

        try {
            const response = await fetch(url, {
                method: method,
                body: formData
            });

            const result = await response.json();
            if (response.ok) {
                Swal.fire(result.message, "", "success");
                sessionStorage.removeItem('id_solicitud');
                window.location.href = `${baseURL}/`;
            } else {
                Swal.fire("Error", result.message, "error");
            }
        } catch (error) {
            console.log(error)
            Swal.fire("Error", "Error al enviar la solicitud", "error");
        }
    }



    window.mostrar_formulario = mostrar_formulario;
    window.calcular_dias_pedidos = calcular_dias_pedidos;
    window.mostrar_funcionarios = mostrar_funcionarios;
    window.otro = otro;


});