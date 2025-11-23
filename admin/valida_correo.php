<?php
//valida_correo.php

require "funciones/conecta.php";
$con = conecta();
$correo = $_REQUEST['correo'];

$sql = "SELECT *
        FROM empleados 
        WHERE eliminado = 0 AND correo = '$correo'";

$res = $con->query($sql);
$num = $res->num_rows;

echo $num;
?>