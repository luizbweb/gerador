<?php

	/* Conexão com o Banco de Dado */
	include "conection.php";

	function __autoload( $classe ) {
		include_once "Classes/{$classe}.class.php";
	}

	$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());

	$email = 'luizbweb@gmail.com';

	$sql = "SELECT * FROM `Alunos` WHERE `e-mail` LIKE '". $email ."' LIMIT 1";
	$query = $conecta -> query($sql);

	/* Adicionando os dados às variàveis */

	while ($dados = mysqli_fetch_array($query)) {
	    $aluno = $dados['nome'];
	    $orientador = $dados['orientador'];
	    $nomeAtividade = $dados['atividade'];
	}

	mysqli_close($conecta);
	// $conecta->Close();

	$participante = new Participante();
	$participante->nome = $aluno;
	$participante->email = $email;
	$participante->id = 0;
	$atividade = new Atividade();
	$atividade->insereParticipante( $participante );
	$atividade->insereNomeAtividade( $nomeAtividade );
	$atividade->insereOrganizador( $orientador );
	$atividade->insereDataAtividade('02/11/2016');
	$atividade->insereHoraAtividade('12:00');
	$atividade->insereLocal('UEZO');
	$cert = new Certificado( $atividade, '0');
	$cert->geraCertificado();


?>
