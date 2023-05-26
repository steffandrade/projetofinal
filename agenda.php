<?php
require_once 'db.php';

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM agendamentos WHERE data = ?  AND hora = ?');
    $stmt->execute([$data, $hora]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error = 'Já existe um agendamento para essa data e horário.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO agendamentos (nome, email, telefone, endereco, data, hora)
            VALUES(:nome, :email, :telefone, :endereco, :data, :hora)');
        $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'endereco' => $endereco, 'data' => $data, 'hora' => $hora]);

        if ($stmt->rowCount()) {
            $successMessage = 'Compromisso agendado com sucesso!';
        } else {
            $errorMessage = 'Erro ao agendar o compromisso, tente novamente mais tarde.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agendamentos de Compromissos</title>
</head>

<body class="body">
    <div id="login">
        <form class="card" method="post">
            <div class="card-header">
                <h2>Agendamentos</h2>
            </div>

            <?php
            if (isset($successMessage)) {
                echo '<span>' . $successMessage . '</span>';
            } elseif (isset($errorMessage)) {
                echo '<span>' . $errorMessage . '</span>';
            } elseif (isset($error)) {
                echo '<span>' . $error . '</span>';
            }
            ?>

            <div class="card-content">
                <div class="card-content-area">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required><br>
                </div>

                <div class="card-content-area">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required><br>
                </div>

                <div class="card-content-area">
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" maxLength="11" required><br>
                </div>

                <div class="card-content-area">
                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" required><br>
                </div>

                <div class="card-content-area">
                    <label for="data">Data:</label>
                    <input type="date" name="data" required><br>
                </div>

                <div class="card-content-area">
                <label for="hora">Horário:</label>
                    <input type="time" name="hora" required><br>
                </div>

                <div class="card-footer">
                    <button class="submit" type="submit" name="submit" value="Agendar">Agendar</button>
                    <button class="submit"><a href="listar.php">Listar</a></button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>