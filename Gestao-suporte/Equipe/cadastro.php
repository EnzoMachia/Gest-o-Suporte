<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <title>Cadastro de Colaborador</title>
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

        button{
            margin:2px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80%;
            width: 50%;
            background-color: #343a40;
            padding: 20px;
            border-radius: 10px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
        }

        .form-container label {
            color: white;
            margin-bottom: 5px;
        }

        .form-container input {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container input:invalid {
            border-color: #dc3545;
        }

        .form-container input:invalid:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
        }

        .form-container input:required:valid {
            border-color: blue;
        }

        .form-container input:required:valid:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .form-container button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Cadastro de Colaborador</h1>

    <div class="form-container">
        <form action="processar_cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required title="Por favor, preencha o nome">
            <button type="submit">Cadastrar</button>
            <a href="index.html">
                <button type="button">voltar</button>
            </a>
        </form>
    </div>
</body>

</html>
