<?php

/*
 * Action para inserir atividades no banco de dados.
 * Recebe dados dos campos atividade, local, data, organizador, email, password, pagina, desc
 * Avalia se deve inserir um novo participante ou finalizar as inscrições.
 */

include_once '../Classes/Atividade.class.php';
include_once '../Classes/Participante.class.php';

$nome_atividade = $_POST['atividade'];
$local = $_POST['local'];
$data = $_POST['data'];
$organizador = $_POST['organizador'];
$email = $_POST['email'];
$password = $_POST['password'];
$pagina = $_POST['pagina'];
$desc = $_POST['desc'];

$atividade = new Atividade();
$atividade->insereNomeAtividade( $nome_atividade );
$atividade->insereLocal( $local );
$atividade->insereDataAtividade( $data );
$atividade->insereOrganizador($organizador);

// Cria um participante com os dados do organizador
$participante = new Participante();
$participante->nome = $organizador;
$participante->senha = $password;
$participante->email = $email;

// Associa o organizador como primeiro Participante
$participante->insereParticipante( $participante );




?>
