<?php
//valida_usuario.php

        session_start();

        require "funciones/conecta.php";
        $con = conecta();
        $correo = $_REQUEST['correo'];
        $pass   = $_REQUEST['pass'];
        $passEnc= md5 ($pass);

        $sql = "SELECT *
                FROM empleados 
                WHERE eliminado = 0 AND correo = '$correo' AND pass = '$passEnc'";

        $res = $con->query($sql);
        $num = $res->num_rows;

        if ($num == 1) {
                $row = $res->fetch_array();
                $id = $row["id"];
                $nombre = $row["nombre"].' '.$row["apellidos"];
                $correo = $row["correo"];

                $_SESSION['userId'] = $id;
                $_SESSION['userName'] = $nombre;
                $_SESSION['userEmail'] = $correo;
        }

        echo $num;
?>