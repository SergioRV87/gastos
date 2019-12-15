$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        var user = $('#user').val();
        var pass = $('#pass').val();
        if (user !== user.trim() || pass !== pass.trim()) {
            $('#contenido p').remove();
            $('#contenido').append('<p>¡Por favor revisa los espacios!</p>');
            $('#myModalWarning').modal('show');
            setTimeout(function () {
                $('#myModalWarning').modal('hide');
            }, 2000);
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
                success: function (response) {
                    if (response === 'correcto') {
                        window.location = "usuario_vista";
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