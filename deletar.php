<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM agendamentos WHERE id = ?');
$stmt->execute([$id]);
$apoointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$apoointment) {
    header('Location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('DELETE FROM agendamentos WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: listar.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Deletar compromisso</title>
</head>
<body>
    
<div id="login">
            <form class="card">
                <div class="card-header">
<h1>Deletar compromisso</h1>
<p>Tem certeza que deseja deletar o compromisso de
    <?php echo $apoointment['nome'];?>
    em <?php echo date('d/m/Y', strtotime($apoointment['data']));?>
    á <?php echo date('H:i', strtotime($apoointment['hora']));?></p>
    <form method='post'>
    
    <div class="card-footer">
    <button class="submit" type='submit'>Sim</button>
        <a class="a" href="listar.php">Não</a>
    </form>
                </div>
                </div>
</body>
</html>