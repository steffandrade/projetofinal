<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM agendamentos WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listar.php');
    exit;
}
$nome = $appointment['nome'];
$email = $appointment['email'];
$telefone = $appointment['telefone'];
$endereco = $appointment['endereco'];
$data = $appointment['data'];
$hora = $appointment['hora'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Atualizar Compromisso</title>
</head>
<body>
    
<div id="login">
            <form class="card">
                <div class="card-header">
<h1>Atualizar Compromisso</h1>
</div>

    <form method="post">
    <div class="card-content">
   
   <div class="card-content-area">
        <label for="nome">Nome</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required></br>
        </div>

        <div class="card-content-area">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo $email;?>" required></br>
        </div> 

        <div class="card-content-area">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" value="<?php echo $telefone;?>" required></br>
        </div>

        <div class="card-content-area">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" value="<?php echo $endereco;?>" required></br>
        </div>
        
        <div class="card-content-area">
        <label for="data">Data</label>
        <input type="text" name="data" value="<?php echo $data;?>" required></br>
        </div>

        <div class="card-content-area">
        <label for="hora">Hora</label>
        <input type="text" name="hora" value="<?php echo $hora;?>" required></br>
        </div>

        <div class="card-footer">
        <button class="submit" type="submit">Atualizar</button>
        </div>
    </form>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $stmt = $pdo->prepare('UPDATE agendamentos SET nome = ?, email = ?, telefone = ?, endereco = ?, data = ?, hora = ? WHERE id = ?');
    $stmt->execute([$nome, $email, $telefone, $endereco, $data, $hora, $id]);
    header('Location: listar.php');
    exit;
}
?>