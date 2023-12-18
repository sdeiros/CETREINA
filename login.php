<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
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

        .login-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #343a40;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 1rem;
            color: #495057;
        }

        input {
            padding: 0.5rem;
            margin-top: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            cursor: pointer;
            background-color: #FFA500;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
            padding: 0.5rem;
            font-size: 1rem;
        }

        button:hover {
            background-color: #FF8C00;
        }

        #error-message {
            color: #dc3545;
            margin-top: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <nav>
            <img class="logonav" src="./src/logocetreina.png" alt="Logo do Cetreina">
        </nav>
        <h2>CETREINA</h2>
        <form id="loginForm">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button type="button" onclick="loadAndSend()">Login</button>
        </form>
        <p id="error-message"></p>
    </div>

    <script src="https://apis.google.com/js/api.js"></script>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        function loadAndSend() {
            gapi.load('client', () => {
                gapi.client.init({
                    apiKey: 'AIzaSyDq1_3tOQdeM3besaeg1-O4coztRsL3FZY',
                    discoveryDocs: ["https://sheets.googleapis.com/$discovery/rest?version=v4"],
                }).then(() => {
                    console.log('API do Google Sheets carregada com sucesso!');
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;

                    gapi.client.sheets.spreadsheets.values.get({
                        spreadsheetId: '1WAxnZPqgbTAvqtTampi34xDkL-3-W13mnbIo2ACcIm4',
                        range: 'cadastros!A:C',
                    }).then(response => {
                        console.log('Dados da planilha:', response.result.values);
                        const data = response.result.values;

                        for (let i = 0; i < data.length; i++) {
                            const row = data[i];

                            // Ignora linhas vazias
                            if (row.length === 0) {
                                continue;
                            }

                            console.log('Verificando linha:', row);
                            const emailIndex = row.indexOf(email);
                            const passwordIndex = row.indexOf(password);

                            if (emailIndex !== -1 && passwordIndex !== -1) {
                                document.getElementById('error-message').innerText = '';
                                redirectToWelcomePage(row[0]);
                                return;
                            }
                        }

                        document.getElementById('error-message').innerText = 'Email ou senha inválido(s)';
                    }).catch(error => {
                        console.error('Erro ao acessar a planilha:', error.result?.error?.message || error.message);
                    });
                });
            });
        }

        function redirectToWelcomePage(name) {
            // Redireciona para a página de boas-vindas passando o nome como parâmetro
            window.location.href = `principal.php?name=${name}`;
        }
    </script>
</body>

</html>