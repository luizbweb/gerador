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

$hash = hash(sha256, 'mail@mail.com', false);

$html = "<div class='certificado'>
    <div class='texto'>
        Certificamos que <b>" . $aluno . "</b> participou do <b>" . $atividade. "</b>, ministrado pelo(a) Prof.(a) <b>" . $orientador . "</b>, no período de 18 a 19 de outubro de 2016. <br><br> Codigo do certificado:<br> ". $hash ."
    </div>
</div>";

$geraPDF = new mPDF('utf-8', 'A4-L');
$geraPDF->SetDisplayMode('fullpage');
$css = file_get_contents("style.css");
$geraPDF->WriteHTML($css,1);
$geraPDF->WriteHTML($html);
if ($aluno == 'aluno') {
    echo '<h2 align=center><br><br>Seu email n�o esta cadastrado. <br>Entre em contato conosco atraves do email:<br> lemauezo@gmail.com</h2>';
} else {
    $geraPDF->Output( $hash.'.pdf', f);
}
echo $hash;
exit;
?>