<?php
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */

	class Participante {

		// Declara os atributos

		public $id;
		public $idAtividade;
		public $nome;
		public $email;
		public $telefone;
		public $senha;

		public function __set($name, $value) {

			$this->name = $value;
		}

		public function __get($name) {

			return $this->$name;

		}

		function registraParticipante(){
			function registraAtividade () {
				$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());

				$id_atividade =	$this->idAtividade;
				$nome = $this->nome;
				$email = $this->email;
				$tel = $this->telefone;

				$sql = "INSERT INTO Participantes ( cod_atividade, nome_participante, email_participante,
					tel_participante )
					values(?, ?, ?, ?)";
				$stmt = $conecta->prepare( $sql );
				$stmt->bind_param('ssss', $id_atividade, $nome, $email,	$tel);
				$stmt->execute();

				mysqli_close($conecta);

			}

		}


	}

?>
