<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

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
                <input type="text" class="form-control" id="searchTerm" name="searchTerm" placeholder="Digite o Nome ou Email">
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

</body>
</html>
