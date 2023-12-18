<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar e Atualizar Dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

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
                    echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
                } elseif ($successMessage !== "") {
                    echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
                }

                echo '<script>setTimeout(function(){ window.location.href = "' . $_SERVER['PHP_SELF'] . '"; }, 3000);</script>';
            }
        }

        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" class="btn btn-primary">Importar Dados</button>
            <a href="banco.php" class="btn btn-secondary">Acessar Banco de Dados</a>
        </form>
    </div>

</body>

</html>
