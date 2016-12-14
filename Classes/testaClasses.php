<?php

	include 'Participante.class.php';
	include 'Atividade.class.php';

	$participante = new Participante();
	$participante->nome = 'Luiz';
	$participante->email = 'luiz@teste.com';
	$atividade = new Atividade();
	$atividade->insereParticipante( $participante );

	echo "O Atributo e: ". $participante->nome;

	echo "<br><br>";

	$atividade = new Atividade();
	$atividade->insereNomeAtividade('Aula');
	$atividade->insereParticipante( $participante );
	$atividade->exibeParticipantes();

?>
