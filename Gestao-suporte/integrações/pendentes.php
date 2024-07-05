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

        .finalizado {
            background-color: #d4edda; /* Verde claro */
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
            margin: 20px 0;
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
    <h1>Integrações Pendentes</h1>
    <?php
    include ("conexao.php");

    $query = "SELECT * FROM integracoes_integracoes";
    $pendentes = mysqli_query($mysqli, $query);

    if (!$pendentes) {
        echo "Erro ao executar a consulta: " . mysqli_error($mysqli);
        exit;
    }

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Status</th><th>Finalizar</th></tr>";

    while ($row = mysqli_fetch_assoc($pendentes)) {
        $class = $row['status'] == 1 ? 'finalizado' : '';
        echo "<tr class='$class'>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['empresa']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status'] == 1 ? 'finalizado' : 'pendente') . "</td>";
        echo "<td><button onclick='alt_status()' class='updateBtn' id='" . $row['id'] . "'>Finalizar</button></td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($mysqli);
    ?>
    <a href="../index.html">Voltar</a>

    <script>
        function alt_status() {
            alert('Integração finalizada com sucesso!');
            var id = event.target.id;
            $.ajax({
                url: 'finalizar.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>
