<?php
session_start();

// Verifica se o parâmetro 'authenticated' está presente na URL
if (isset($_GET['authenticated']) && $_GET['authenticated'] === 'true') {
    $_SESSION['authenticated'] = true;
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Se não estiver autenticado, redireciona para a página de login com uma mensagem de erro
    header("Location: login.php");
    exit();
}

$authenticated = isset($_GET['authenticated']) ? $_GET['authenticated'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">



    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        nav {
            text-align: center;
            margin: 1rem;
        }

        .logonav {
            width: 3rem;
        }

        .fundo {
            margin: 2%;
            width: 96%;
            height: 60vh;
            border-radius: 70px;
            background: linear-gradient(82deg, #FFCA8B -1.74%, #FFBC6C -1.73%, #EB7C07 17.47%, #F46060 49.73%, #FF8777 100.93%);
        }

        .txt {
            position: relative;
            color: #ffffff;
            text-align: center;
            font-family: Inter;
            font-size: 0.8rem;
            top: 1rem;
            margin-top: 0;
        }

        .star {
            position: absolute;
            width: 2rem;
            height: auto;
            margin: 0 auto;
            margin-top: 0rem;
            left: 4%;
        }

        .conteudo {
            padding: 1rem;

        }

        .logo {
            max-width: 40%;
            height: auto;
            margin-top: 8rem;
        }

        .cetreina {
            width: 50%;
            margin-top: 1rem;
            color: #ffffff;
            font-family: Inter;
            font-size: 1rem;
        }

        .botoes {
            margin-top: 10vh;
            margin-left: 2%;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            flex-wrap: wrap;
            /* Adiciona quebra de linha quando não houver espaço suficiente */
        }

        .botoes button {
            cursor: pointer;
            background-color: #FFA500;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            /* Adiciona espaço abaixo dos botões (ajuste conforme necessário) */
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        /* Adiciona uma consulta de mídia para ajustar o layout em telas menores */
        @media (max-width: 768px) {
            .botoes {
                flex-direction: column;
                /* Muda para uma coluna em telas menores */
            }

            .botoes button {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
        }

        .botoes button:hover {
            background-color: #FF8C00;
            /* Laranja mais escuro no hover */
        }

        @media screen and (max-width: 360px) {
            .logonav {
                width: 2rem;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }

            .cetreina {
                width: 100%;
                margin-top: 0.4vh;
            }
        }

        @media screen and (max-width: 375px) {
            .logonav {
                width: 2rem;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }

            .cetreina {
                width: 100%;
                margin-top: 0.4vh;
            }
        }

        @media screen and (max-width: 414px) {
            .logonav {
                width: 2rem;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }

            .cetreina {
                width: 100%;
            }
        }

        @media screen and (max-width: 412px) {
            .logonav {
                width: 2rem;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }

            .cetreina {
                width: 10%;
            }
        }

        @media screen and (max-width: 430px) {
            .cetreina {
                width: 100%;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }
        }

        @media screen and (max-width: 468px) {
            .cetreina {
                width: 100%;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }
        }

        @media screen and (max-width: 1024px) {
            .cetreina {
                width: 50%;
            }

            .fundo {
                margin: 2%;
                border-radius: 30px;
            }

        }

        .greeting {
            color: #FF8300;
            font-family: Inter;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            position: absolute;
            left: 2%;
            font-size: 1.2rem;
            margin-top: 0%;
        }

        .name {
            font-family: Inter;
            font-style: normal;
            font-size: 1.2rem;
            font-weight: 500;
            color: #FF8300;
        }

        .custom-alert {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
            margin-left: 2%;
            margin-top: 1rem;
        }

        .custom-alert.alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .custom-alert.alert-success {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        /* Adicione esses estilos ao seu CSS existente */
        #modoNoturnoBtn {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            cursor: pointer;
            color: #FF8300;
            transition: all 0.4s ease;
        }

        #modoNoturnoIcon {
            position: absolute;
            width: 3.4em;
            height: auto;
            margin-left: 93%;
            margin-top: 3%;
            color: #FF8300;
            transition: all 0.4s ease;
        }

        .modo-noturno #modoNoturnoIcon {
            content: url('https://img.icons8.com/ios-filled/50/FF8300/do-not-disturb-2.png');
            /* Altera o ícone quando o modo noturno está ativado */
        }

        /* Adicione esses estilos ao seu CSS existente */
        body.modo-noturno {
            background-color: #141414;
            /* Cor de fundo para o modo noturno */
            color: #fff;
            /* Cor do texto para o modo noturno */
            transition: all 0.4s ease;
        }

        .modo-noturno .custom-alert.alert-danger {
            color: #f8d7da;
            /* Cor do texto de alerta de erro no modo noturno */
            background-color: #721c24;
            /* Cor de fundo do alerta de erro no modo noturno */
            border-color: #f5c6cb;
            /* Cor da borda do alerta de erro no modo noturno */
            transition: all 0.4s ease;
        }

        .modo-noturno .custom-alert.alert-success {
            color: #fff3cd;
            /* Cor do texto de alerta de sucesso no modo noturno */
            background-color: #856404;
            /* Cor de fundo do alerta de sucesso no modo noturno */
            border-color: #ffeeba;
            /* Cor da borda do alerta de sucesso no modo noturno */
            transition: all 0.4s ease;
        }

        #modoNoturnoIcon.modo-noturno-transition {
            transition: all 0.4s ease;
        }
    </style>


</head>

<body>
    <nav>
        <button id="modoNoturnoBtn" onclick="toggleModoNoturno()">
            <img id="modoNoturnoIcon" src="https://img.icons8.com/ios/FF8300/summer.png" alt="Modo Noturno Ícone">
        </button>

        <img class="logonav" src="./src/logocetreina.png" alt="Logo do Cetreina">


    </nav>

    <div class="fundo">
        <h6 class="txt">integrar, formar, pesquisar, interagir e aplicar</h6>
        <img class="star" src="./src/Star 2.png">
        <div class="conteudo">
            <img class="logo" src="./src/PB-logo-cetreina (1) (3).png" alt="Logo do Cetreina">
            <p class="cetreina">Integrar alunos ao mercado de trabalho, complementando a formação, incentivando pesquisa
                e
                interação social,
                visando reduzir evasão e aplicar conhecimentos desde cedo na carreira.</p>
        </div>
    </div>
    <p class="greeting"></p>
    <p style="color: #707070;
    font-family: Inter;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    position: absolute;
    font-size: 1.1rem;
    left: 2%;
    ">
        serviços
    </p>

    <div class="botoes">
        <form method="post" action="principal.php" onsubmit="redirectToPrincipal()">
            <button type="submit" class="btn btn-primary">Importar Dados</button>
        </form>

        <button onclick="redirectToEnvios()">Comunicado</button>
        <button onclick="redirectToBanco()">Estagiários</button>
        <button onclick="logout()">Logout</button>

    </div>

    <script>

        // Adicione este script ao seu bloco de script existente
        function toggleModoNoturno() {
            const body = document.body;
            body.classList.toggle('modo-noturno');

        }

        // Adicione este script ao seu bloco de script existente
        function toggleModoNoturno() {
            const body = document.body;
            const modoNoturnoIcon = document.getElementById('modoNoturnoIcon');

            body.classList.toggle('modo-noturno');
            // Adiciona uma classe de transição para suavizar a mudança de estilo
            modoNoturnoIcon.classList.add('modo-noturno-transition');


            modoNoturnoIcon.src = body.classList.contains('modo-noturno')
                ? 'https://img.icons8.com/ios/452/do-not-disturb.png' // Ícone quando o modo noturno está ativado
                : 'https://img.icons8.com/ios/50/FF8300/summer--v1.png'; // Ícone padrão quando o modo noturno está desativado
            // Aguarda um curto período de tempo antes de remover a classe de transição
            setTimeout(() => {
                modoNoturnoIcon.classList.remove('modo-noturno-transition');
            }, 300); // O mesmo valor que a duração da transição
            // Verifica se o modo noturno está ativado no localStorage e aplica-o
            document.addEventListener('DOMContentLoaded', () => {
                const modoNoturnoAtivado = localStorage.getItem('modoNoturnoAtivado') === 'true';

                if (modoNoturnoAtivado) {
                    toggleModoNoturno(); // Ativa o modo noturno se estava ativado
                }
            });
        }

        function redirectToBanco() {
            window.location.href = 'banco.php';
        }

        function logout() {
            window.location.href = 'login.php';
        }

        function redirectToEnvios() {
            // Redireciona para a página envios.php
            window.location.href = 'envios.php';
        }

        function redirectToPrincipal() {
            // Obtém o nome da planilha
            const name = "<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>";

            // Adiciona os parâmetros à URL
            const url = `principal.php?authenticated=true&name=${encodeURIComponent(name)}`;

            // Atualiza a ação do formulário
            document.forms[0].action = url;
        }

        // Recupera o nome completo do usuário da URL
        const fullName = new URLSearchParams(window.location.search).get('name');

        // Verifica se o parâmetro 'name' está presente na URL
        if (!fullName) {
            redirectTo('login.php');
        } else {
            // Função para capitalizar corretamente cada parte do nome
            function capitalizeNamePart(namePart) {
                return namePart
                    .toLowerCase()
                    .split(' ')
                    .map(part => part.charAt(0).toUpperCase() + part.slice(1))
                    .join(' ');
            }
        }

        // Função para obter o primeiro nome e sobrenome com capitalização adequada
        function getFirstAndLastName(fullName) {
            const names = fullName.split(' ');

            const firstName = capitalizeNamePart(names[0]);

            const lastName = names.slice(1).join(' ');

            return { firstName, lastName };
        }

        // Obtemos o primeiro nome e sobrenome chamando a função
        const { firstName, lastName } = getFirstAndLastName(fullName);

        // Obtém a hora atual
        const currentHour = new Date().getHours();

        // Função para obter a saudação com base na hora atual
        function getGreetingByHour(hour) {
            if (hour >= 5 && hour < 12) {
                return 'Bom dia';
            } else if (hour >= 12 && hour < 18) {
                return 'Boa tarde';
            } else {
                return 'Boa noite';
            }
        }

        // Adiciona a classe 'greeting' ao elemento <p> e aplica os estilos adequados
        const greetingElement = document.querySelector('.greeting');
        greetingElement.innerHTML = `${getGreetingByHour(currentHour)}, <span class="name">${firstName}</span>`;
    </script>

    <div class="container mt-5">
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Substitua 'SEU_API_KEY' pela chave de API do Google Sheets
            $apiKey = 'AIzaSyDq1_3tOQdeM3besaeg1-O4coztRsL3FZY';

            // ID da planilha do Google Sheets
            $spreadsheetId = '1WAxnZPqgbTAvqtTampi34xDkL-3-W13mnbIo2ACcIm4';

            // Range específico
            $range = 'estagiario!A2:C';

            // URL da API do Google Sheets
            $url = "https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$range}?key={$apiKey}";

            // Faz a requisição para obter os dados
            $response = file_get_contents($url);

            // Converte a resposta JSON para um array associativo
            $data = json_decode($response, true);

            // Verifica se há dados
            if (isset($data['values'])) {
                // Conecta ao seu banco de dados (substitua os detalhes do banco de dados)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pebit";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica a conexão
                if ($conn->connect_error) {
                    die("Erro na conexão: " . $conn->connect_error);
                }

                // Mensagem de sucesso ou erro
                $successMessage = "Dados importados, atualizados ou excluídos com sucesso!";
                $errorMessage = "";

                // Se a planilha estiver vazia, limpe todo o banco de dados
                if (empty($data['values'])) {
                    $truncateSql = "TRUNCATE TABLE estagiarios";
                    if ($conn->query($truncateSql) === FALSE) {
                        $errorMessage = "Erro ao limpar o banco de dados: " . $conn->error;
                    } else {
                        $successMessage = "Banco de dados limpo com sucesso.";
                    }
                } else {
                    // Obtém todos os e-mails presentes na planilha
                    $emailsNaPlanilha = array_column($data['values'], 1);

                    // Obtém todos os e-mails presentes no banco de dados
                    $result = $conn->query("SELECT Email FROM estagiarios");
                    $emailsNoBanco = array();
                    while ($row = $result->fetch_assoc()) {
                        $emailsNoBanco[] = $row['Email'];
                    }

                    // Identifica e exclui os e-mails que estão no banco de dados, mas não na planilha
                    $emailsExcluir = array_diff($emailsNoBanco, $emailsNaPlanilha);
                    foreach ($emailsExcluir as $emailExcluir) {
                        $excluirSql = "DELETE FROM estagiarios WHERE Email = '$emailExcluir'";
                        if ($conn->query($excluirSql) === FALSE) {
                            $errorMessage = "Erro ao excluir dados: " . $conn->error;
                        } else {
                            $successMessage .= " $emailExcluir removido do sistema.";
                        }
                    }

                    // Itera sobre os dados e insere/atualiza no banco de dados
                    foreach ($data['values'] as $row) {
                        // Verifica se a linha possui pelo menos um valor (ignorando linhas vazias ou em branco)
                        if (!empty(array_filter($row))) {
                            // Verifica se o array possui pelo menos 3 elementos (índices 0, 1 e 2)
                            if (count($row) >= 3) {
                                $nome = $row[0];
                                $email = $row[1];
                                $convenio = $row[2];

                                // Verifica se o e-mail já existe no banco de dados
                                $result = $conn->query("SELECT * FROM estagiarios WHERE Email = '$email'");
                                if ($result->num_rows > 0) {
                                    // Se existir, realiza um UPDATE
                                    $updateSql = "UPDATE estagiarios SET Nome = '$nome', Convenio = '$convenio' WHERE Email = '$email'";
                                    if ($conn->query($updateSql) === FALSE) {
                                        $errorMessage = "Erro ao atualizar dados: " . $conn->error;
                                    } else {
                                        $successMessage = "$successMessage";
                                    }
                                } else {
                                    // Se não existir, realiza um INSERT
                                    $insertSql = "INSERT INTO estagiarios (Nome, Email, Convenio) VALUES ('$nome', '$email', '$convenio')";
                                    if ($conn->query($insertSql) === FALSE) {
                                        if ($conn->errno == 1062) { // Código de erro para duplicata (pode variar dependendo do MySQL)
                                            $errorMessage = "Erro: E-mail ou Nome já existente.";
                                        } else {
                                            $errorMessage = "Erro ao inserir dados: " . $conn->error;
                                        }
                                    } else {
                                        $successMessage .= " $nome adicionado no sistema.";
                                    }
                                }
                            } else {
                                // Caso a linha da planilha não tenha todos os elementos esperados, exibe uma mensagem de erro
                                $errorMessage = "Erro: A linha da planilha não possui todos os elementos esperados.";
                            }
                        }
                    }

                    // Fecha a conexão
                    $conn->close();

                    // Exibe mensagens
                    if ($errorMessage !== "") {
                        echo '<div class="custom-alert alert alert-danger" role="alert">' . $errorMessage . '</div>';
                    } elseif ($successMessage !== "") {
                        echo '<div class="custom-alert alert alert-success" role="alert">' . $successMessage . '</div>';
                    }
                }

            }
        }

        ?>



    </div>

</body>

</html>