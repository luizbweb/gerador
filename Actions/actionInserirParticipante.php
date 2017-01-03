<?php

/*
 * Action para inserir participantes no banco de dados.
 * Recebe dados dos campos atividade, participante, email, tel
 * Avalia se deve inserir um novo participante ou finalizar as inscrições.
 */

include_once '../Classes/Participante.class.php';

$atividade = $_POST['atividade'];
$nome = $_POST['participante'];
$email = $_POST['email'];
$tel = $_POST['tel'];

$participante = new Participante();

$participante->nome = $nome;
$Participante->email= $email;
$participante->telefone = $tel;


?>
