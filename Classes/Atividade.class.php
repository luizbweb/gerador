<?php

	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */
	include_once 'Participante.class.php';
	// include_once 'conection.php';

	class Atividade
	{
		public $idAtividade;
		public $nomeAtividade;
		public $dataAtividade;
		public $organizadorAtividade;
		public $emailOrganizador; // Criar metodos
		private $senhaOrganizador; // Criar metodos
		public $presentes;
		public $local;
		public $urlAtividade;
		public $descAtividade;

		function insereNomeAtividade( $argAtividade ) {
			$this->nomeAtividade = $argAtividade;
		}

		function insereDataAtividade( $argData ) {
			// Tentar forçar ao formato da data.
			$this->dataAtividade = implode('-', array_reverse(explode('-', $argData)));
		}

		function insereOrganizador( $argOrganizador ) {
			$this->organizadorAtividade = $argOrganizador;
		}

		function insereEmailOrganizador( $argEmail )  {
			$this->emailOrganizador = $argEmail;
		}

		function insereSenhaOrganizador( $argSenha ) {
			$this->senhaOrganizador =  $argSenha;
		}

		// Recebe o ID da atividade e retorna uma lista de todos os participantes
		function registraPresentes( Participante $participante) {
			$this->presentes[$participante->id] = $participante;
		}
		function insereLocal( $argLocal ) {
			$this->local = $argLocal;
		}

		function insereUrlAtividade( $argUrlAtividade ) {
			$this->urlAtividade = $argUrlAtividade;
		}

		function insereDescAtividade( $argDesc ) {
			$this->descAtividade = $argDesc;
		}

		function registraAtividade () {
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());

			$nome =	$this->nomeAtividade;
			$data = $this->dataAtividade;
			$organizador = $this->organizadorAtividade;
			$email = $this->emailOrganizador;
			$senha = $this->senhaOrganizador;
			// $presentes = $this->presentes;
			$local = $this->local;
			$url = $this->urlAtividade;
			$descricao = $this->descAtividade;

			// Faz a inserção no banco de dados conforme o modelo:
			/*
			$mysqli = new mysqli('host','usuario','senha','base');
			$sql = 'INSERT INTO tabela (campo1, campo2, campo3) values(?,?,?)';
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("sss", $variavel1, $variavel2, $varivavel3);
			$stmt->execute();
			*/

			$sql = "INSERT INTO Atividades ( atividade, data_fim, local, organizador,
				email_organizador, senha_organizador, url_atividade, descricao )
				values(?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $conecta->prepare( $sql );
			$stmt->bind_param('ssssssss', $nome, $data, $local, $organizador, $email,
			  	$senha, $url, $descricao );
			$stmt->execute();

			mysqli_close($conecta);

		}

		function retornaIdAtividade( $argTitulo ){
			// Consulta $argTitulo no banco de dados para obter o idAtividade
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$titulo = $argTitulo;
			$sql = "SELECT * FROM `Atividades` WHERE `atividade` LIKE '". $titulo ."' LIMIT 1";
			$query = $conecta -> query($sql);

			/* Adicionando os dados às variàveis */

			while ($dados = mysqli_fetch_array($query)) {
			    $this->idAtividade = $dados['cod'];
			}

			return $this->idAtividade;
			mysqli_close($conecta);
		}

		function retornaNomeAtividade( $argId ) {
			// consultar o Id no banco de dados e retornar o titulo da atividade.
			return $this->nomeAtividade;
		}

		function retornaAtividade( $argTitulo ) {
			// Busca atividade no banco de dados com base seu titulo.
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$titulo = $argTitulo;
			$sql = "SELECT * FROM `Atividades` WHERE `atividade` LIKE '". $titulo ."' LIMIT 1";
			$query = $conecta -> query($sql);

			/* Adicionando os dados às variàveis */

			while ($dados = mysqli_fetch_array($query)) {
				$this->idAtividade = $dados['cod'];
				$this->nomeAtividade = $dados['atividade'];
				$data_invertida = $dados['data_fim'];
				$this->dataAtividade = implode('-', array_reverse(explode('-', $data_invertida)));
				$this->organizadorAtividade = $dados['organizador'];
				$this->emailOrganizador = $dados['email_organizador'];
				$this->senhaOrganizador = $dados['senha_organizador'];
				$this->local = $dados['local'];
				$this->urlAtividade = $dados['url_atividade'];
				$this->descAtividade = $dados['descricao'];
			}
			mysqli_close($conecta);
		}

		function listaAtividades() {
			// Busca atividades no banco de dados.
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$sql = "SELECT `atividade` FROM `Atividades` ";
			$query = $conecta -> query($sql);

			/* Adicionando os dados às variàveis */
			$i = 0;
			while ($dados = mysqli_fetch_array($query)) {
				$lista[$i] = $dados['atividade'];
				$i++;
			}

			return $lista;
			/*
			foreach ($lista as $item) {
				echo $item;
			}
			*/
			mysqli_close($conecta);

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

		/*
		function exibeParticipantes( $argIdAtividade ) {

			foreach ($this->presentes as $participante) {
				echo "Nome: ".$participante->nome ." | E-mail: ".$participante->email ." | Telefone: ". $participante->telefone;
			}
		}
		*/

		function retornaLocal() {
			return $this->local;
		}

		function retornaUrlAtividade () {
			return $this->urlAtividade;
		}

		function retornaDescAtividade () {
			return $this->descAtividade;
		}

		function __destruct () {
			// echo "Terminei!";
		}

	}

?>
