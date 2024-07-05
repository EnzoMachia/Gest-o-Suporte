<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrações Pendentes</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: black;
        }

        h1 {
            text-align: center;
            color: white;
            font-weight: 700;
        }

        table {
            width: 80%;
            max-width: 800px;
            background-color: #343a40;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            text-align: center;
            color: black;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            font-weight: 500;
        }

        tr {
            background-color: white;
        }

        .recebido {
            background-color: #d4edda; /* Verde claro */
        }

        .infos {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 80%;
            max-width: 800px;
            background-color: #343a40;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            color: white;
        }

        p, h1 {
            margin: 0;
        }

        a {
            display: block;
            text-align: center;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
        }

        a:hover {
            background-color: #c82333;
        }

        .updateBtn {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .updateBtn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Integrações Realizadas</h1>
    <?php
    include ("conexao.php");
    $valor_recb = 0;
    $valor_pend = 0;
    $valor_err = 0;
    $valor_dif= 0;
    $quanti_int = 0;
    $query = "SELECT * FROM integracoes_integracoes WHERE status = 1";
    $pendentes = mysqli_query($mysqli, $query);

    if (!$pendentes) {
        echo "Erro ao executar a consulta: " . mysqli_error($mysqli);
        exit;
    }

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Valor (Líquido)</th><th>Data de Finalização</th><th>Recebido no Financeiro</th></tr>";
    while ($row = mysqli_fetch_assoc($pendentes)) {
        $class = $row['rec_finan'] == 1 ? 'recebido' : '';
        $valor_lqd = $row['valor'] * 0.8;
        echo "<tr class='$class'>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['empresa']) . "</td>";
        echo "<td>" . $valor_lqd . "</td>";
        echo "<td>". $row['dt_fin'] . "</td>";
        echo "<td><button onclick='rec_finan()' class='updateBtn' id='" . $row['id'] . "'>Recebido</button></td>";
        echo "</tr>";
        $row['rec_finan'] == 1 ?  $valor_recb = $valor_recb + $valor_lqd : $valor_pend = $valor_pend + $valor_lqd ;
        if($valor_lqd < 160){
            $valor_dif = 160 - $valor_lqd; 
            $valor_err = $valor_err + $valor_dif ;
        }
        $quanti_int++;
    }

    echo "</table>";
    echo "<div class='infos'>";
    echo "<p>Total Recebido: " . $valor_recb . "</p>";
    echo "<p>Total Pendente: ". $valor_pend. "</p>";
    echo "<p>Total errado (Líquido): ". $valor_err . "</p>";
    echo "<p>Quantidade de Integrações: ". $quanti_int. "</p>";
    echo "<p>Valor Realizado: ". $quanti_int * 160 ."</p>";
    echo "</div>";
    mysqli_close($mysqli);
    ?>
    <a href="index.html">Voltar</a>
    <script>
        function rec_finan() {
            var id = event.target.id;
            console.log(id)
            $.ajax({
                url: 'update.php',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    alert('Recebimento Confirmado');
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>
