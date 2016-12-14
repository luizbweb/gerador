<?php
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */

	include_once 'Participante.class.php';
	include_once 'Atividade.class.php';

	class Certificado {

		public $participante;
		public $atividade;
		public $now;
		public $hash;
		// public $local;

		function __construct( Atividade $atividade, $argId ) {
			$this->atividade = $atividade;
			$this->now = date('d/m/Y H:i:s');
			$this->participante = $this->atividade->presentes[0];
		}
		function geraCertificado() {
			echo '<h1>Dados do Certificado:</h1>';
			echo 'Atividade: '.$this->atividade->nomeAtividade;
			echo '<br> Data da Atividade: ';
			echo $this->atividade->dataAtividade;
			echo '<br> Local da Atividade: ';
			echo $this->atividade->local;
			echo '<br> TIMESTAMP: ';
			echo $this->now;
			echo '<br> Nome dos Participantes: ';
			echo $this->participante->nome;
			$this->hash = hash( 'sha256', $this->now.'luizbweb@gmail.com', false );
			echo '<br> HASH: ';
			echo $this->hash;
		}
	}
?>
