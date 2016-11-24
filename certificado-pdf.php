<?php
/* Gerador de Certificados da IXJCT
 * Objetivos do código:
 * Obter os dados do formulário usando $_POST
 * Validar a identidade do aluno a partir do email e matrícula
 * Gerar o certificado contendo
 * Imagem de Fundo
 * Nome do Aluno
 * Orientador
 * Título do trabalho
 *
 */

//Biblioteca geradora do PDF
include('criadorPDF/mpdf.php');

/* Conexão com o Banco de Dado */
include('conection.php');

$conecta = new mysqli(HOST, USER, PASS, DB) or print(mysql_error());

$aluno = 'aluno';
$email = $_POST['email'];
$matricula = $_POST['matricula'];

/* Consulta com base no formulario */
$sql = "SELECT * FROM `Alunos` WHERE `e-mail` LIKE '". $email ."' LIMIT 1";
$query = $conecta -> query($sql);

/* Adicionando os dados às variàveis */

while ($dados = mysqli_fetch_array($query)) {
    $aluno = $dados['nome'];
    $orientador = $dados['orientador'];
    $atividade = $dados['atividade'];
}

mysqli_close($conecta);

$now = date("d/m/Y H:i:s ");
$hash = hash(sha256, $now.$email, false);

$html = "<div class='certificado'>
    <div class='texto'>
        Certificamos que <u>" . $aluno . "</u> participou da <u>" . $atividade. "</u>, ministrada por <u>" . $orientador . "</u>, no dia 16 de Novembro de 2016 durante a Semana de Campo Grande. <br><br><br><br> Rio de Janeiro, 23 de Novembro de 2016.
        <div style='font-size: 14px;font-family:arial, helvetica;'>
        	<br><br><br><br><br><br><br><br><br><br> codigo: ". $hash ."
        </div>
    </div>
</div>";

/* Se o email estiver cadastrado gera o PDF */

if ($aluno == 'aluno') {
    echo '<h2 align=center><br><br>Seu email n�o esta cadastrado. <br>Entre em contato conosco atraves do endere&ccedil;o:<br> certificados@waw.net.br</h2>';
} else {
	$geraPDF = new mPDF('utf-8', 'A4-L', s, 'Aegyptus');
	$geraPDF->SetDisplayMode('fullpage');
	$css = file_get_contents("style.css");
	$geraPDF->WriteHTML($css,1);
	$geraPDF->WriteHTML($html);
    $geraPDF->Output( $hash.'.pdf', f);

	/* Enviando o certificao por email */

	$assunto = "Certificado da Semana de Campo Grande";
	$texto = "Obrigado por participar da Semana de Campo Grande ". $aluno ."! \n
	Clique no link abaixo para fazer o Download do seu cerificado ou copie e cole o link no seu navegador: \n
	http://waw.net.br/certificados/". $hash .".pdf \n\n
	Luiz Bruno \n
	WAW Certificados \n
	http://waw.net.br \n
	";
	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
	$headers .= "From: certificados@waw.net.br\r\n"; // remetente
	$headers .= "Return-Path: certificados@waw.net.br\r\n"; // return-path
	$envio = mail($email, $assunto, $texto, $headers);
	 
	if($envio) {
	 echo "<h2 align=center><br><br>O Certificado foi enviado com para ".$email."<br> Em caso de d&uacute;vidas envie mensagem para: contato@waw.net.br</h2>";
	}
	else {
	 echo "<h2 align=center><br><br>A mensagem n&aatilde;o pode ser enviada...<br>Envie email para certificados@waw.net.br</h2>";
	}

	exit;

}
?>