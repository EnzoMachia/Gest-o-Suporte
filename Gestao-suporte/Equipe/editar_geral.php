<?php
include("conexao.php");
$data_atual = date('Y-m-d');
$enviarofx = mysqli_query(
        $mysqli,
        "UPDATE `geral` SET `quantidade` = $_POST[quantidade] WHERE `mes` = $_POST[mes];"
    );
    ?>