<?php
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */

	class Participante {

		// Declara os atributos

		public $id;
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
	}

?>
