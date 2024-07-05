<?php
include("conexao.php");

$query = "UPDATE integracoes_integracoes SET rec_finan = 1 WHERE id='$_POST[id]'";
$result = mysqli_query($mysqli, $query);
?>
