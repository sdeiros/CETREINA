<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Enviado com Sucesso</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            color: #4caf50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .return-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            display: inline-block;
        }

        .return-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="success-message">E-mail enviado com sucesso!</div>
        <a href="principal.php" class="return-button">Voltar para a tela principal</a>
    </div>
</body>

</html>
