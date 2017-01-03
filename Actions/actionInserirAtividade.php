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
$atividade->insereOrganizador( $organizador );
$atividade->insereUrlAtividade( $pagina );
$atividade->insereDescAtividade( $desc );

// Cria um participante com os dados do organizador
$participante = new Participante();
$participante->nome = $organizador;
$participante->senha = $password;
$participante->email = $email;

// Associa o organizador como primeiro Participante
$atividade->insereParticipante( $participante );

// Exibe os dados inseridos
$testa[0] = $atividade->retornaAtividade();
$testa[1] = $atividade->retornaLocal();
$testa[2] = $atividade->retornaDataAtividade();
$testa[3] = $atividade->retornaOrganizador();
$testa[4] = $atividade->retornaUrlAtividade();
$testa[5] = $atividade->retornaDescAtividade();

foreach ($testa as $retornos) {
    echo $retornos;
}

$atividade->exibeParticipantes();

?>
