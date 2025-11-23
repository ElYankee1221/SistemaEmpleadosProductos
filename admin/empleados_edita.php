<?php
//empleados_edita.php

    require "funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT *
            FROM empleados
            WHERE eliminado = 0 AND id = $id";

    $res = $con->query($sql);

    $row = $res->fetch_array();
	$id         = $row["id"];
	$nombre     = $row["nombre"];
	$apellidos  = $row["apellidos"];
	$correo	    = $row["correo"];
	$numerorol  = $row["rol"];

?>

<html>
    <head>

        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/style_empleados_edita.css">

        <title>Editar empleados</title>
        <style>
            #mensaje {
                font-size: 15px;
                color: red;
            }
        </style>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            
            function validar() {
                var nombre = $('#nombre').val();

                var apellidos = $('#apellidos').val();

                var correo = $('#correo').val();

                var pass = $('#pass').val();

                var rol = $('#rol').val();

                if (nombre == '' || apellidos == ''|| correo == '' || rol == "0") {
                    $('#mensaje').html('Faltan campos por llenar.');
                    setTimeout("$('#mensaje').html('');", 5000);
                }
                else {
                    document.Forma01.submit();
                }
            }
            
            function sale() {
                // $('#mensaje').html('Salio del campo');

                var correoId = '<?php echo $correo; ?>';
                var correo = $('#correo').val();

                if (correo != correoId) {                   
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
                                setTimeout("$('#mensaje_correo').html('');", 5000);
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
        
        <h1>Editar empleados</h1>
        
        <a href="empleados_lista.php" class="regresar">← Regresar al listado</a>

        <div class="form-container">
            
            <div class="form-card">
                <div id="mensaje"></div>
                <form name="Forma01" method="post" action="empleados_actualiza.php" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
                    
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?php echo $apellidos ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="text" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo ?>" onBlur="sale();"/>
                        <div id="mensaje_correo"></div>
                    </div>

                    <div class="form-group">
                        <label for="pass">Nueva Contraseña:</label>
                        <input type="password" name="pass" id="pass" placeholder="Dejar en blanco para no cambiar"/>
                    </div>

                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <select name="rol" id="rol">
                            <option value="0">Selecciona</option>
                            <option value="1" <?php echo ($numerorol == 1) ? 'selected' : ''?>>Gerente</option>
                            <option value="2" <?php echo ($numerorol == 2) ? 'selected' : ''?>>Ejecutivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="archivo">Foto de perfil (Opcional):</label>
                        <input type="file" id="archivo" name="archivo">
                    </div>

                    <input onclick="validar(); return false;" type="submit" value="Actualizar Empleado" class="btn-submit" />
                    
                    

                </form>
            </div>
        </div>
    </body>
</html>