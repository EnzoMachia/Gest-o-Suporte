<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Código</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
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
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80%;
            width: 60%;
            background-color: #343a40;
            padding: 20px;
            border-radius: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        label {
            color: white;
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            height: 400px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #555;
            color: white;
            resize: none;
        }

        button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Editar Código</h1>

    <div class="form-container">
        <form action="processar_edicao.php" method="post">
            <label for="codigo">Edite o código:</label>
            <textarea id="codigo" name="codigo" required></textarea>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>
