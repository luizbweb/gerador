<?php
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */

	include_once 'Participante.class.php';
	include_once 'Atividade.class.php';
	// include 'criadorPDF/mpdf.php';

	class Certificado {

		public $participante;
		public $atividade;
		public $now;
		public $hash;
		// public $local;

		function __construct( Atividade $atividade, $argId ) {
			$this->atividade = $atividade;
			$this->now = date('d/m/Y H:i:s');
			// $this->participante = $this->atividade->presentes[0];
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

			$html = "<div class='certificado'>
			    <div class='texto'>
			        Certificamos que <u>" . $this->participante->nome . "</u>
					participou da <u>" . $this->atividade->nomeAtividade. "</u>,
					organizada por <u>" . $this->atividade->organizadorAtividade .
					"</u>, no dia ". $this->atividade->dataAtividade . ". <br><br><br><br>
					 Rio de Janeiro, 23 de Novembro de 2016.
			        <div style='font-size: 14px;font-family:arial, helvetica;'>
			        	<br><br><br><br><br><br><br><br><br><br> codigo: ". $this->hash ."
			        </div>
			    </div>
			</div>";
			$geraPDF = new mPDF('utf-8', 'A4-L', s);
			$geraPDF->SetDisplayMode('fullpage');
			$css = file_get_contents('style.css');
			$geraPDF->WriteHTML($css,1);
			$geraPDF->WriteHTML($html);
		    $geraPDF->Output( 'files/'.$this->hash.'.pdf', f);
		}

		function registraCertificado( Atividade $argAtividade, Participante $argParticipante, $argHash ) {
			// Registra as informações do certificado no banco de dados.
			// Registrar o id_participante, cod_atividade e hash,
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());

			$cod_atividade = $argAtividade->idAtividade;
			$id_participante = $argParticipante->id;
			$hash = $argHash;

			$sql = "INSERT INTO Certificados ( id_participante, cod_atividade, hash )
				values(?, ?, ?)";
			$stmt = $conecta->prepare( $sql );
			$stmt->bind_param('sss', $cod_atividade, $id_participante, $hash);
			$stmt->execute();

			mysqli_close($conecta);
		}

		function consultaCertificado( $argHash ) {
			// Consulta hash no Banco de Dados e exibe os seus dados
			// Dados: Nome do participante, Nome da atividade, Data de conclusão
			$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());
			$hash = $argHash;
			$sql = "SELECT * FROM `Atividades` INNER JOIN `Certificados` INNER JOIN `Participantes`
				WHERE `hash` LIKE '". $hash ."' LIMIT 1";
			$query = $conecta -> query($sql);

			/* Adicionando os dados às variàveis */

			while ($dados = mysqli_fetch_array($query)) {
			    $id_participante = $dados['id_participante'];
				$nome_participante = $dados['nome_participante'];
				$atividade = $dados['atividade'];
				$data = $dados['data_fim'];
			}

			$data = implode('-', array_reverse(explode('-', $data)));
			// echo $id_participante;
			echo '<br>';
			echo 'Nome: '.$nome_participante ;
			echo '<br>';
			echo 'Atividade: '.$atividade ;
			echo '<br>';
			echo 'Data de Conclus&atilde;o: '.$data ;
			echo '<br>';

			mysqli_close($conecta);
		}
	}
?>
