$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        var user = $('#user').val();
        var pass = $('#pass').val();
        if (user !== user.trim() || pass !== pass.trim()) {
            alert('Por favor revisa los datos !');
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "login",
                type: "POST",
                data: {
                    user: user,
                    pass: pass
                },
                cache: false,
                success: function (response) {
                    if (response === 'correcto') {
                        window.location = "usuario_vista";
                    } else {
                        if (response === 'passIncorrecta') {
                            alert("contraseña incorrecta");
                        } else {
                            alert("no esta usted registrado");
                        }
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