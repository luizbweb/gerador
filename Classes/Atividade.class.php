<?php
	
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */
	include_once 'Participante.class.php';

	class Atividade 
	{
		
		public $nomeAtividade;
		public $presentes;

		public function insereNomeAtividade( $argAtividade ) {

			$this->nomeAtividade = $argAtividade;
		}

		public function insereParticipante( Participante $participante) {
			
			$this->presentes[] = $participante;

		}

		public function exibeParticipantes() {

			foreach ($this->presentes as $participante) {
				
				echo "Nome: ".$participante->nome ." | E-mail: ".$participante->email ." | Telefone: ". $participante->telefone;
			}
		}
	}

?>