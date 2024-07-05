<?php
include("conexao.php");
$data_atual = date('Y-m-d');
$enviarofx = mysqli_query(
        $mysqli,
        "INSERT INTO `integracoes_integracoes` (`id`, `lixo`, `data`, `empresa`, `plataforma`, `int_rap`, `valor`) 
    VALUES (NULL, '0', '$data_atual', '$_POST[empresa]','$_POST[plataforma]','$_POST[int_rap]','$_POST[valor]')"
    );
    ?>