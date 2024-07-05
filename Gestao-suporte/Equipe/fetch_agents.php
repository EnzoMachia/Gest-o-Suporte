<?php
include("conexao.php");

$month = $_POST['month'];
$query = "SELECT * FROM equipe_notas WHERE mes = '$month'";
$result = mysqli_query($mysqli, $query);

$agents = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $agents[] = $row;
    }
    echo json_encode($agents);
} else {
    echo json_encode([]);
}

mysqli_close($mysqli);
?>
