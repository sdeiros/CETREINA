<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar E-mails</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
    nav {
        text-align: center;
    }

    .logonav {
        width: 3rem;
        margin-top: 1rem;
    }

    .btn-primary {
        cursor: pointer;
        background-color: #FFA500;
        border: none;
    }

    .btn-primary:hover {
        background-color: #FF8C00;
    }

    .alert {
        margin-top: 20px;
    }

    #anexoLabel {
        display: inline-block;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #fff;
        background-color: #FFA500;
        border: 1px solid #FFA500;
        border-radius: .25rem;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    #anexoLabel:hover {
        background-color: #FF8C00;
    }
</style>


<body>
    <nav>
        <img class="logonav" src="./src/logocetreina.png" alt="Logo do Cetreina">
    </nav>

    <div class="container mt-5">
        <?php

        require 'vendor/autoload.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        // Função para enviar e-mails com anexo
        function enviarEmailComAnexo($destinatario, $assunto, $corpo, $anexo)
        {
            $mail = new PHPMailer(true);

            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'davi.medeiros.silva1@gmail.com';
            $mail->Password = 'ajyo afba yzjp fpof';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurações do e-mail
            $mail->setFrom('davi.medeiros.silva1@gmail.com', 'Davi Medeiros');
            $mail->addAddress($destinatario);
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $corpo;

            // Adiciona o anexo ao e-mail, apenas se um arquivo foi enviado
            if ($anexo !== null) {
                $mail->addAttachment($anexo['tmp_name'], $anexo['name']);
            }

            // Envia o e-mail
            return $mail->send();
        }

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

        // Consulta todos os e-mails
        $result = $conn->query("SELECT Email, Convenio FROM estagiarios");

        if ($result->num_rows > 0) {
            echo '<h2>Enviar E-mail para Estagiários</h2>';
            echo '<form method="post" action="envios.php" enctype="multipart/form-data">';
            echo '<div class="form-group">';
            echo '<label for="convenioFilter">Filtrar por Convenio:</label>';
            echo '<select class="form-control" id="convenioFilter" name="convenioFilter">';
            echo '<option value="TODOS">TODOS</option>';
            echo '<option value="FAETEC">FAETEC</option>';
            echo '<option value="FIA">FIA</option>';
            echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="assunto">Assunto:</label>';
            echo '<input type="text" class="form-control" id="assunto" name="assunto" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="corpo">Corpo do E-mail:</label>';
            echo '<textarea class="form-control" id="corpo" name="corpo" rows="5" required></textarea>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label id="anexoLabel" for="anexo">Anexar Arquivo</label>';
            echo '<input type="file" class="form-control-file" id="anexo" name="anexo" style="display: none;">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary" id="enviarBtn">Enviar E-mail</button>';
            echo '</form>';


        } else {
            echo '<div class="alert alert-warning" role="alert">Sem e-mails na tabela.</div>';
        }

        // Envia e-mail com anexo se o formulário for enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assunto']) && isset($_POST['corpo'])) {
            $assunto = $_POST['assunto'];
            $corpo = $_POST['corpo'];
            $convenioFilter = isset($_POST['convenioFilter']) ? $_POST['convenioFilter'] : 'TODOS';

            // Volta ao início do resultado para iterar novamente
            $result->data_seek(0);

            while ($row = $result->fetch_assoc()) {
                if ($convenioFilter === 'TODOS' || $convenioFilter === $row['Convenio']) {
                    $destinatario = $row['Email'];

                    // Verifica se um arquivo foi enviado
                    if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] == UPLOAD_ERR_OK) {
                        $anexo = $_FILES['anexo'];
                        if (enviarEmailComAnexo($destinatario, $assunto, $corpo, $anexo)) {
                            // Mensagem de sucesso
                            echo '<div class="alert alert-success" role="alert">E-mail com anexo enviado com sucesso para ' . $destinatario . '.</div>';
                            // Redireciona para "enviados.php" com uma mensagem de sucesso
                            header("Location: enviados.php?status=success");
                            exit();
                        } else {
                            // Mensagem de erro
                            echo '<div class="alert alert-danger" role="alert">Erro ao enviar o e-mail com anexo para ' . $destinatario . '.</div>';
                        }
                    } else {
                        // Se nenhum arquivo foi enviado, envia o e-mail sem anexo
                        if (enviarEmailComAnexo($destinatario, $assunto, $corpo, null)) {
                            // Mensagem de sucesso
                            echo '<div class="alert alert-success" role="alert">E-mail enviado com sucesso para ' . $destinatario . '.</div>';
                            // Redireciona para "enviados.php" com uma mensagem de sucesso
                            header("Location: enviados.php?status=success");
                            exit();
                        } else {
                            // Mensagem de erro
                            echo '<div class="alert alert-danger" role="alert">Erro ao enviar o e-mail para ' . $destinatario . '.</div>';
                        }
                    }                    
                }
            }

        }

        // Fecha a conexão
        $conn->close();


        ?>

        <script>
            // JavaScript para lidar com a seleção de arquivo e atualizar o label estilizado
            document.getElementById('anexo').addEventListener('change', function () {
                var fileName = this.files[0] ? this.files[0].name : "Nenhum arquivo escolhido";
                document.getElementById("fileNameLabel").innerText = fileName;
            });
        </script>
    </div>

</body>

</html>