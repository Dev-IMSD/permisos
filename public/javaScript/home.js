document.addEventListener('DOMContentLoaded', function () {
    
    
    // Esta escuchando cuando presiona el boton 
    document.querySelectorAll('.editar-solicitud').forEach(function (button) {
        button.addEventListener('click', function () {
            //Guarda el data id de la solicitud presionada  en id_solicitud 
            let id_solicitud = this.getAttribute('data-id');
            //Guarda la variable en SessionStorage
            sessionStorage.setItem('id_solicitud', id_solicitud);
            window.location.href = '/feriadoLegal';
        });
    });

    //Esta escuchando cuando presiona el boton
    document.querySelectorAll('.ver-pdf').forEach(function (button) {
        button.addEventListener('click', function () {
            //Guarda el data id de la solicitud presionada  en id_solicitud 
            let id_solicitud = this.getAttribute('data-id');
            // Redirecciona hacia la pagina pdf con la variable
            window.location.href = `/pdf/${id_solicitud}`;
        });
    });

});