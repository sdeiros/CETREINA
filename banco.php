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

// Verifica se o parâmetro 'modoNoturno' está presente na URL
if (isset($_GET['modoNoturno']) && $_GET['modoNoturno'] === 'true') {
    $_SESSION['modoNoturno'] = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<style>
    nav {
        text-align: center;
        margin: 1rem;
    }

    .logonav {
        width: 3rem;
    }
</style>

<body>
    <nav>
        <img class="logonav" src="./src/logocetreina.png" alt="Logo do Cetreina">
    </nav>
    <div class="container mt-5">
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="convenioFilter">Filtrar por Convenio:</label>
                    <select class="form-control" id="convenioFilter" name="convenioFilter">
                        <option value="TODOS">TODOS</option>
                        <option value="FAETEC">FAETEC</option>
                        <option value="FIA">FIA</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="searchTerm">Buscar por Nome ou Email:</label>
                    <input type="text" class="form-control" id="searchTerm" name="searchTerm"
                        placeholder="Digite o Nome ou Email">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
                </div>
            </div>
        </form>

        <?php
        // Conecta ao banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pebit";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        // Filtros
        $convenioFilter = isset($_GET['convenioFilter']) ? $_GET['convenioFilter'] : 'TODOS';
        $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

        $sqlFilters = array();
        if ($convenioFilter !== 'TODOS') {
            $sqlFilters[] = "Convenio = '$convenioFilter'";
        }
        if (!empty($searchTerm)) {
            $sqlFilters[] = "(Nome LIKE '%$searchTerm%' OR Email LIKE '%$searchTerm%')";
        }

        $sqlFilter = (!empty($sqlFilters)) ? " WHERE " . implode(" AND ", $sqlFilters) : '';
        $orderBy = " ORDER BY Nome"; // Adicionamos a cláusula ORDER BY para ordenar por nome
        
        // Consulta todos os dados da tabela com ou sem filtro
        $result = $conn->query("SELECT * FROM estagiarios" . $sqlFilter . $orderBy);

        if ($result->num_rows > 0) {
            echo '<table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Convenio</th>
                    </tr>
                </thead>
                <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['Nome'] . '</td>
                    <td>' . $row['Email'] . '</td>
                    <td>' . $row['Convenio'] . '</td>
                  </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning" role="alert">Sem dados na tabela.</div>';
        }

        // Fecha a conexão
        $conn->close();
        ?>
    </div>

    <script>
        // Adiciona um ouvinte de evento ao campo de busca
        $(document).ready(function () {
            let typingTimer;
            const doneTypingInterval = 500;  // Tempo em milissegundos (0.5 segundos)

            $('#searchTerm').on('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    $('form').submit();
                }, doneTypingInterval);
            });
        });
    </script>

</body>

</html>