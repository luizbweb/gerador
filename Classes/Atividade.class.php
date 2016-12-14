<?php

	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */
	include_once 'Participante.class.php';

	class Atividade
	{

		public $nomeAtividade;
		public $dataAtividade;
		public $horaAtividade;
		public $presentes;

		function insereNomeAtividade( $argAtividade ) {
			$this->nomeAtividade = $argAtividade;
		}

		function insereDataAtividade( $argData ) {
			// Tentar forçar ao formato da data.
			$this->dataAtividade = $argData;
		}

		function insereHoraAtividade( $argHora ) {
			// Tentar forçar o formato da hora.
			$this->horaAtividade = $argHora;
		}

		function insereParticipante( Participante $participante) {
			$this->presentes[] = $participante;
		}

		function retornaAtividade() {
			return $this->nomeAtividade;
		}

		function retornaDataAtividade() {
			return $this->dataAtividade;
		}

		function retornaHoraAtividade() {
			return $this->horaAtividade;
		}

		function retornaParticipantes() {
			return $this->presentes;
		}

		function exibeParticipantes() {
			foreach ($this->presentes as $participante) {
				echo "Nome: ".$participante->nome ." | E-mail: ".$participante->email ." | Telefone: ". $participante->telefone;
			}
		}

		function __destruct () {

			echo "Terminei!";
		}

	}

?>
