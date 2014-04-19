$(document).ready(function() {
    login();
    cerrar_sesion();
    cargar_info();
});

function login() {
    $('#sesion_btn').click(function(e) {
        correo = $('#email').val().toLowerCase();
        password = $('#password').serialize();
        cadena = 'usuario_email=' + correo + '&' + password;
        $.post("/php/login.php",
                cadena,
                function(data) {

                    if (data.usuario_existe && data.usuario_pass && data.usuario_activado) {
                        if (data.usuario_pro == true) {
                            window.location.href = "/html/Pedido.html";
                        }
                        else {
                            window.location.href = "/html/Catalogo.php";
                        }

                    }
                    else {
                        alert("Datos erroneos");
                    }
                },
                'json');
        e.preventDefault();
    });
}

function loginFacebook() {
    FB.api('/me', function(response) {
        correo = response.correo;
        usuario_id = response.id;
        cadena = "usuario_facebook_id=" + usuario_id;
        $.post("/php/loginFacebook.php",
                cadena,
                function(data) {
                    if (data.usuario_existe) {
                        alert("El usuario existe");
                        if(data.usuario_pro){
                            window.location.href = "/html/Pedido.html";
                        }
                        else{
                            window.location.href = "/html/Catalogo.php";
                        }
                    }
                    else {
                        alert("El usuario no se ha registrado con facebook");
                    }
                }, 'json');
    });
}

function cerrar_sesion() {
    $('#nav_bar').on("click", "#cerrar_sesion", function(e) {
        $.ajaxSetup({async: false});
        $.post("/php/cierra_sesion.php");
        var delay = 1000; //Your delay in milliseconds
        setTimeout(function() {
            window.location.href = "../index.php";
        }, delay);
        e.preventDefault();
        $.ajaxSetup({async: true});
    });
}

function cargar_info() {
    $("#searchnav").load("../html/layouts/search_nav_layout.html");
    $("#infos").load("../html/layouts/infos.html");
    $("#footer").load("../html/layouts/pie_pagina.html");
}



