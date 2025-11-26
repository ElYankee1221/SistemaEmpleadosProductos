<?php
//valida_codigo.php

require "funciones/conecta.php";
$con = conecta();
$codigo = $_REQUEST['codigo'];

$sql = "SELECT *
        FROM productos 
        WHERE eliminado = 0 AND codigo = '$codigo'";

$res = $con->query($sql);
$num = $res->num_rows;

echo $num;
?>