<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_empleados_edita.css">

        <title>Formularios</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            
            function validar() {
                var nombre      = $('#nombre').val();
                var apellidos   = $('#apellidos').val();
                var correo      = $('#correo').val();
                var pass        = $('#pass').val();
                var rol         = $('#rol').val();
                var archivo     = $('#archivo').val();
                
                if (nombre == '' || apellidos == '' || correo == '' || pass == '' || rol == "0" || archivo == '') {
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('');",5000);
                }
                else {
                    document.Forma01.submit();
                }
            }

            function sale() {
                
                var correo = $('#correo').val();

                if (correo != '') {                  
                    $.ajax({
                        url     : 'valida_correo.php',
                        type    : 'post',
                        dataType: 'text',
                        data    : 'correo='+correo,
                        success : function(res) {
                        //Recibe respuesta (res)
                            if (res != 0) {
                                $('#mensaje_correo').html('El correo '+correo+' ya existe.');
                                $('#correo').val('');
                                setTimeout("$('#mensaje_correo').html('');",5000);
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
        <?php 
            include('menu.php');         
        ?>
        
        <h1>Alta de empleados</h1>

        <div class="regresar">
            <a href="empleados_lista.php">← Regresar al listado</a>
        </div>
        
        <div class="form-container">
            <div class="form-card">
                <div id="mensaje"></div>
                <form name="Forma01" method="post" action="empleados_salva.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" />
                    </div>

                    <div class="form-group">
                        <label>Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" />
                    </div>

                    <div class="form-group">
                        <label>Correo:</label>
                        <input type="text" name="correo" id="correo" placeholder="Correo" onBlur="sale();"/>
                        <div id="mensaje_correo"></div>
                    </div>

                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" />
                    </div>

                    <div class="form-group">
                        <label>Rol:</label>
                        <select name="rol" id="rol">
                            <option value="0">Selecciona</option>
                            <option value="1">Gerente</option>
                            <option value="2">Ejecutivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Imagen de perfil:</label>
                        <input type="file" id="archivo" name="archivo"><br>
                        <!-- <input type="submit" value="Subir archivo" name="submit"> -->
                    </div>

                    <input onclick="validar(); return false;" type="submit" value="Crear nuevo empleado" class="btn-submit" />

                </form>
            </div>
        </div>

        
    </body>
</html>