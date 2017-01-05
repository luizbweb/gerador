<?php

/*
 * Action para inserir participantes no banco de dados.
 * Recebe dados dos campos atividade, participante, email, tel
 * Avalia se deve inserir um novo participante ou finalizar as inscrições.
 */

include_once '../Classes/Participante.class.php';

// Obtem dados do formulario

$atividade = $_POST['atividade'];
$nome = $_POST['participante'];
$email = $_POST['email'];
$tel = $_POST['tel'];

// Cria o objeto participante
$participante = new Participante();

$participante->idAtividade = $atividade;
$participante->nome = $nome;
$participante->email= $email;
$participante->telefone = $tel;

// Registra no Banco de dados
$participante->registraParticipante();

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="refresh" content="3;../index.html>"
        <title>Participantes Registrados!</title>
    </head>
    <body>
<?php

echo $participante->idAtividade;
echo "<br>";
echo $participante->nome;
echo "<br>";
echo $participante->email;
echo "<br>";
echo $participante->telefone;
echo "<br>";

?>
