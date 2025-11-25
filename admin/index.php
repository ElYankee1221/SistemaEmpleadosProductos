<?php
    session_start();

    if (isset($_SESSION['userName'])) {
        header("Location: bienvenido.php");
        exit;
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_index.css">
        <title>Formularios</title>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function validar() {

                var correo = $('#correo').val();
                var pass = $('#pass').val();

                if (correo == '' || pass == '') {
                    $('#mensaje').html('Faltan campos por llenar');
                    setTimeout("$('#mensaje').html('');",5000);
                }
                else {
                    $.ajax({
                        url     : 'valida_usuario.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : 'correo='+correo+'&pass='+pass,
                        success : function(res) {
                        //Recibe respuesta (res)
                            if(res == 1) {
                                window.location.href = "bienvenido.php";
                            } else {
                                $('#mensaje').html('Datos incorrectos');
                                setTimeout("$('#mensaje').html('');",5000);
                            }
                        },error: function() {
                            alert('Error archivo no encontrado...');
                        }
                    });
                }
            }

        </script>
    </head>
    <body>
        <h1>Login</h1>

        <div class="form-container">
            <div class="form-card">

                <form name="Forma01">

                    <div class="form-group">
                        <label for="nombre">Correo:</label>
                        <input type="text" name="correo" id="correo" placeholder="Escribe tu correo" /><br>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Contraseña:</label>
                        <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña" /><br>
                    </div>

                    <input onclick="validar(); return false;" type="submit" value="Enviar" class="btn-submit"/>
                </form>
        
                <div id="mensaje"></div>
            </div>
        </div>
    </body>
</html>