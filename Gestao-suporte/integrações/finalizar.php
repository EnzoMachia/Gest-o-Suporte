<?php
include("conexao.php");
$data_atual = date('Y-m-d');
$query = "UPDATE integracoes_integracoes SET status = 1 , dt_fin = '$data_atual' WHERE id='$_POST[id]'";
$result = mysqli_query($mysqli, $query);
?>
