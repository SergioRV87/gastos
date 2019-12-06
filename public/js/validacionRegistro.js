$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var user = $('#user').val();
        var pass = $('#pass').val();
        var email = $('#email').val();
        if (nombre !== nombre.trim() || apellidos !== apellidos.trim() || user !== user.trim() || pass !== pass.trim() || email !== email.trim()) {
            alert('Por favor revisa los datos !');
        } else {
            $.ajax({
                url: "registro",
                type: "POST",
                data: {
                    _token: $("#csrf").val(),
                    type: 1,
                    nombre: nombre,
                    apellidos: apellidos,
                    user: user,
                    pass: pass,
                    email: email
                },
                cache: false,
                success: function (response) {
                    if (response === 'correcto') {
                        $('#myModal').modal('show');
                        setTimeout(function () {
                            $('#myModal').modal('hide');
                        }, 3000);
                        setTimeout(function () {
                            window.location = "index";
                        }, 1000);

                    } else {
                        $('#contenido p').remove();
                        $('#contenido').append('<p>' + response + '</p>');
                        $('#myModalWarning').modal('show');
                        setTimeout(function () {
                            $('#myModalWarning').modal('hide');
                        }, 2000);
                    }
                },
                statusCode: {
                    404: function () {
                        alert('web not found');
                    }
                },
                error: function (x, xs, xt) {
                    window.open(JSON.stringify(x));
                }
            });
        }
    });
});