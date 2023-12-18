<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <title>CETREINA | PEBIT</title>
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
            margin-top: 5%;
            margin-left: 2%;
            text-align: left;
        }

        .botoes button {
            cursor: pointer;
            background-color: #FFA500;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            padding: 0.5rem 1rem;
            font-size: 1rem;
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
    </style>
</head>

<body>
    <nav>
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
        <button onclick="redirectToEnvios()">Comunicado</button>
        <button onclick="redirectToDados()">Carregar Dados</button>
        <button onclick="logout()">Logout</button>
    </div>


    <script>
        function redirectToIndex() {
            // Verifica se a pessoa está logada antes de redirecionar
            if (isLoggedIn()) {
                redirectTo('principal.php');
            } else {
                // Redireciona para a página de login caso não esteja logada
                redirectTo('login.php');
            }
        }

        function logout() {
            window.location.href = 'principal.php';
        }

        function redirectToEnvios() {
            // Redireciona para a página envios.php
            window.location.href = 'envios.php';
        }

        function redirectToDados() {
            // Redireciona para a página envios.php
            window.location.href = 'dados.php';
        }

        function redirectToEnvios() {
            // Redireciona para a página envios.php
            window.location.href = 'envios.php';
        }

        function redirectTo(page) {
            // Redireciona para a página especificada se não estiver nela
            if (window.location.href.indexOf(page) === -1) {
                window.location.href = page;
            }
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



</body>

</html>