<html>
    <head>
        <title>Formularios</title>
        <style>
            #mensaje {
                font-size: 15px;
                color: red;
            }
        </style>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function validar() {
                var correo = $('#correo').val();
                // var correo = document.Forma01.correo.value;
                //console.log(correo);

                var pass = $('#pass').val();
                // var pass = document.Forma01.pass.value;
                //console.log(pass);

                if (correo == '' || pass == '') {
                    $('#mensaje').html('Faltan campos por llenar');
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
                                // $('#mensaje').html('Si jala');
                            } else {
                                $('#mensaje').html('Datos incorrectos');
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

        <form name="Forma01">

            <input type="text" name="correo" id="correo" placeholder="Escribe tu correo" /><br>
            <input type="text" name="pass" id="pass" placeholder="Escribe tu contraseña" /><br>
            <input onclick="validar(); return false;" type="submit" value="Enviar" />
        </form>

        <div id="mensaje"></dvi>
    </body>
</html>