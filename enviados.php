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

        nav {
            text-align: center;
            margin: 1rem;
        }

        .logonav {
            width: 3rem;
        }

        .success-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            color: #FF8300;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .return-button {
            color: #D55D0C;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            display: inline-block;
            outline: none;
            /* Remove a linha azul do foco */
        }

        .return-button:focus {
            outline: none;
            /* Remova a linha azul mesmo ao receber foco (útil para acessibilidade) */
        }
    </style>
</head>

<body>
    <div class="success-container">
        <nav>
            <img class="logonav" src="./src/logocetreina.png" alt="Logo do Cetreina">
        </nav>
        <div class="success-message">E-mail enviado com sucesso!</div>
        <a href="login.php" class="return-button">Voltar para a tela principal</a>
    </div>
</body>

</html>