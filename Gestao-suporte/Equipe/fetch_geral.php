<?php
include("conexao.php");

if (isset($_POST['month'])) {
    $month = $_POST['month'];
    $query = "SELECT quantidade FROM geral WHERE mes = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $month);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    echo json_encode($data);
}

$mysqli->close();
?>
