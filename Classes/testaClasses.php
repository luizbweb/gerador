<?php

	include 'Participante.class.php';
	include 'Atividade.class.php';
	include 'Certificado.class.php';

	$participante = new Participante();
	$participante->nome = 'Luiz';
	$participante->email = 'luiz@teste.com';
	$participante->id = 0;
	$atividade = new Atividade();
	$atividade->insereParticipante( $participante );
	$atividade->insereNomeAtividade('Aula');
	$atividade->insereDataAtividade('02/11/2016');
	$atividade->insereHoraAtividade('12:00');
	$atividade->insereLocal('UEZO');
	$cert = new Certificado( $atividade, '0');
	$cert->geraCertificado();

?>
