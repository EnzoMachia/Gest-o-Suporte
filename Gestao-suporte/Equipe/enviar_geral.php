<?php
include("conexao.php");
$data_atual = date('Y-m-d');
$enviarofx = mysqli_query(
        $mysqli,
        "INSERT INTO `geral` (`id`,`lixo`,`quantidade`, `data`, `mes`, `ano`) 
    VALUES (NULL, '0','$_POST[quant_atend]', '$data_atual', '$_POST[mes]', '$_POST[ano]')"
    );
    ?>