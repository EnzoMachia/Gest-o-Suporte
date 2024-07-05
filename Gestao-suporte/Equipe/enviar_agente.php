<?php
include("conexao.php");
$data_atual = date('Y-m-d');
$enviarofx = mysqli_query(
        $mysqli,
        "INSERT INTO `equipe_notas` (`id`,`lixo`,`data`, `id_colaborador`, `mes`, `quant_atend`,`nota_med`,`percent_av`,`percent_des`,`rank`) 
    VALUES (NULL, '0','$data_atual', '$_POST[id]', '$_POST[mes]', '$_POST[quant_atend]', '$_POST[nota]', '$_POST[percent]'
    , '$_POST[percent_des]', '$_POST[rank]')"
    );
    ?>