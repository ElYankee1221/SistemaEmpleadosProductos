<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <style>
            #mensaje {
                color: #F00;
                font-size: 16px:
            }
        </style>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            function enviaAjax() {
                var valor = $('#valor').val();
                if (valor && valor > 0) {
                    // $('#mensaje').html('Campo lleno');
                    // setTimeout("$('#mensaje').html('');", 5000);
                
                    $.ajax({
                        url     : 'respuesta.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : 'valor='+valor,
                        success : function(res) {
                            //Recibe respuesta (res)
                            if (res == 0) {
                                $('#mensaje').html('REPROBADO');
                            } else {
                                $('#mensaje').html('APROBADO');
                            }

                        },error: function() {
                            alert('Error archivo no encontrado...');
                        }
                    });

                } else {
                    $('#mensaje').html('Faltan campos por llenar');
                    setTimeout("$('#mensaje').html('');",5000);
                }

            }

        </script>
    </heado>
    <body>
        <input type="text" name="valor" id="valor" placeholder="Escribe un numero" />
        <br>
        <a href="javascript:void(0);" onClick="enviaAjax();">
            Enviar con ajax
        </a>
        <br>
        <div id="mensaje"></div>
    </body>

</html>