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
		public $organizadorAtividade;
		public $presentes;
		public $local;

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
		function insereOrganizador( $argOrganizador ) {
			$this->organizadorAtividade = $argOrganizador;
		}

		function insereParticipante( Participante $participante) {
			$this->presentes[$participante->id] = $participante;
		}
		function insereLocal( $argLocal ) {
			$this->local = $argLocal;
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

		function retornaOrganizador() {
			return $this->organizadorAtividade;
		}

		function retornaParticipantes( $argId ) {
			return $this->presentes[ $argID ];
		}

		function exibeParticipantes() {
			foreach ($this->presentes as $participante) {
				echo "Nome: ".$participante->nome ." | E-mail: ".$participante->email ." | Telefone: ". $participante->telefone;
			}
		}

		function retornaLocal() {
			return $this->local;
		}

		function __destruct () {
			// echo "Terminei!";
		}

	}

?>
