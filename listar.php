<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="style.css"> 
<title>Agendamentos de Compromissos</title>
</head>

<body class="listar">
<h1>Agendamentos de Compromissos</h1>

<?php
$stmt = $pdo->query('SELECT * FROM agendamentos ORDER BY data, hora'); 
$agendamentos = $stmt->fetchAll(PDO:: FETCH_ASSOC);

if (count($agendamentos) == 0) {
echo '<p>Nenhum compromisso agendado.</p>';
} else {
echo '<table border="1">';
echo '<thead>
    <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Data</th>
        <th>Horário</th>
        <th colspan="2">Opções</th>
    </tr>
    </thead>';
echo '<tbody>';

foreach ($agendamentos as $agendamento) {
echo '<tr>';
echo '<td>' . $agendamento['nome'] . '</td>'; 
echo '<td>' . $agendamento['email'] . '</td>';
echo '<td>' . $agendamento['telefone'] . '</td>';
echo '<td>' . $agendamento['endereco'] . '</td>';
echo '<td>' . date('d/m/Y', strtotime($agendamento['data'])) . '</td>'; 
echo '<td>' . date('H:i', strtotime($agendamento['hora'])) . '</td>';
echo '<td><a style="color:white;" href="atualizar.php?id=' . $agendamento['id'].'">Atualizar</a></td>';
echo '<td><a style="color:white;" href="deletar.php?id=' . $agendamento['id'].'">Deletar</a></td>';
echo '</tr>';
}

echo '</tbody>';
echo '</table>';
}
?> 

<div class="card-footer">
                    <a href="agenda.php" class="submit2">Agendar compromisso</a></input>
                </div>

</body>
</html>