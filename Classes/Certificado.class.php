<?php
	/*
	 * Gerador de Certificados WAW
	 * @luizbweb
	 */

	include_once 'Participante.class.php';
	include_once 'Atividade.class.php';
	include('../criadorPDF/mpdf.php');

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
			$css = file_get_contents("../style.css");
			$geraPDF->WriteHTML($css,1);
			$geraPDF->WriteHTML($html);
		    $geraPDF->Output( '../files/'.$this->hash.'.pdf', f);
		}
	}
?>
