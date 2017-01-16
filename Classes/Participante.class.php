<?php
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */

 include_once 'conection.php';

	class Participante {

		// Declara os atributos

		public $id;
		public $idAtividade;
		public $nome;
		public $email;
		public $telefone;

		public function __set($name, $value) {

			$this->name = $value;
		}

		public function __get($name) {

			return $this->$name;

		}

		function registraParticipante () {
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

		function exibeParticipantes ( $argIdAtividade ) {
			// Exibe todos os participantes da atividade com o Id passado.
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$cod = $argIdAtividade;
			$sql = "SELECT * FROM `Participantes` WHERE `cod_atividade` LIKE '". $cod ."' ";
			$query = $conecta -> query($sql);

			/* Adicionando os dados às variàveis */
			echo '<table align="right" cellspacing="7">';
			echo '<tr>';
			echo '<th>Nome</th><th>Email</th><th>Telefone</th>';
			echo '</tr>';
			while ($dados = mysqli_fetch_array($query)) {
				echo '<tr><td>';
			    echo $dados['nome_participante'];
				echo ' </td><td> ';
				echo $dados['email_participante'];
				echo ' </td><td> ';
				echo $dados['tel_participante'];
				echo ' </td><td> ';
			}
            echo '</tr><tr>';
            echo '<td colspan="3">';
            echo '<form name="formulario-de-aluno" method="post"
                    action="index.html">
                    <p align="right"><input type="submit" value="Finalizar"></p>
                </form>';
            echo '</td>';
			echo '</tr></table>';

			mysqli_close($conecta);
			/*
			foreach ($this->presentes as $participante) {
				echo "Nome: ".$participante->nome ." | E-mail: ".$participante->email ." | Telefone: ". $participante->telefone;
			}
			*/
		}

/*
		function retornaParticipante( $argIdParticipante ) {
			// Recebe o Id do Participante e retorna o objeto participante com seus dados.
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$id_participante = $argIdParticipante;
			$sql = "SELECT * FROM `Participantes` WHERE `id` LIKE '". $id_participante ."' ";
			$query = $conecta -> query($sql);


			while ($dados = mysqli_fetch_array($query)) {
				$this->id = $argIdParticipante;
				$this->nome = $dados['nome_participante'];
				$this->email = $dados['email_participante'];
				$this->telefone = $dados['tel_participante'];
				$this->idAtividade = $dados['cod_atividade'];
			}

			mysqli_close($conecta);
		}
*/
        function retornaParticipante( $argEmail, $argCodAtividade ) {
            $conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$email_participante = $argEmail;
            $cod_atividade = $argCodAtividade;
			$sql = "SELECT * FROM `Participantes` WHERE `email_participante` LIKE '". $email_participante ."'
                AND `cod_atividade` LIKE '". $cod_atividade ."' LIMIT 1 " ;
			$query = $conecta -> query($sql);

			/* Adicionando os dados aos atributos */
			while ($dados = mysqli_fetch_array($query)) {
				$this->id = $dados['id'];
				$this->nome = $dados['nome_participante'];
				$this->email = $dados['email_participante'];
				$this->telefone = $dados['tel_participante'];
				$this->idAtividade = $dados['cod_atividade'];
			}

			mysqli_close($conecta);



        }

	}

?>
