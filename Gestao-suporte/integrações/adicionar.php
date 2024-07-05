<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Integração</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 50%;
            max-width: 500px;
            background-color: #343a40;
            padding: 20px;
            border-radius: 10px;
        }

        input, select, button, a {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
        }

        input, select {
            background-color: #f8f9fa;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-weight: 500;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px;
        }

        a:hover {
            background-color: #c82333;
        }

        label {
            color: white;
            align-self: flex-start;
            margin-bottom: 5px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <h1>Adicionar Integração</h1>
    <form id="integrationForm">
        <label for="empresa">Nome da Empresa:</label>
        <input type="text" id="empresa" name="empresa" required>
        
        <label for="plataforma">Plataforma</label>
        <select name="plataforma" id="plataforma" required>
            <option value="">Selecione a Plataforma</option>
            <option value="1">Ifood</option>
            <option value="2">AnotaAi</option>
        </select>
        
        <label for="int_rap">Integração Rápida</label>
        <input type="checkbox" name="int_rap" id="int_rap" >
        
        <label for="valor">Valor (Bruto)</label>
        <input name="valor" id="valor" type="number" required>
        
        <button type="submit">Salvar</button>
        <a href="../index.html">Voltar</a>
    </form>

    <script>
        const check = document.querySelector("#int_rap");
        check.addEventListener("change", function() {
            console.log("checked");
            check.value = check.checked ? 1 : 0;
        });

        $("#integrationForm").on("submit", function(event) {
            event.preventDefault(); // Evita o envio do formulário pelo método tradicional
            if ($("#empresa").val() == "") {
                alert("Qual o nome da Empresa?");
                return; // Aborta o envio do formulário
            }
            if ($("#plataforma").val() == "") {
                alert("Selecione uma Plataforma");
                return; // Aborta o envio do formulário
            }

            if ($("#valor").val() == "") {
                alert("Insira um valor da integração");
                return; // Aborta o envio do formulário
            }
            $.ajax({
                url: "banco.php",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert("Integração salva com sucesso!");
                    $("#integrationForm")[0].reset();
                },
                error: function(xhr, status, error) {
                    alert("Ocorreu um erro ao salvar a integração.");
                }
            });
        });
    </script>
</body>
</html>
