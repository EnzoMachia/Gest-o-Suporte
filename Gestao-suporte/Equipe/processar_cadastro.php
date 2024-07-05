<?php
include("conexao.php");
$data_atual = date('Y-m-d');
$enviarofx = mysqli_query(
        $mysqli,
        "INSERT INTO `equipe` (`id`,`lixo`, `data`, `nome`) 
    VALUES (NULL, '0', '$data_atual','$_POST[nome]')"
    );
    ?>