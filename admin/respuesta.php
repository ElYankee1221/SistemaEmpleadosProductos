<?php
    $valor = $_REQUEST['valor'];
    $ban = 0;

    if ($valor >= 60) {
        $ban = 1;
    }

    echo $ban;

?>