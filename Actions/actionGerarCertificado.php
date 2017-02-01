<?php

/*
 * Action para gerar os Certificados
 * Recebe dados dos campos atividade, email do participante.
 * Consulta dos dados da atividade no banco de dados e gera o certificado.
 * Pode ser melhorado criando uma unica query que busque o participante de acordo com a atividade.
 */

 $aluno = '';

include_once '../Classes/Atividade.class.php';
include_once '../Classes/Participante.class.php';
include_once '../Classes/Certificado.class.php';

//Biblioteca geradora do PDF
include('../criadorPDF/mpdf.php');

// Recebe os dados
$nome_atividade = $_POST['atividade'];
$email = $_POST['email'];

// Consulta as informações da atividade

$atividade = new Atividade();
$atividade->retornaAtividade( $nome_atividade );

// Busca informações do Participante com base no email

$participante = new Participante();
$participante->retornaParticipante( $email, $atividade->idAtividade );

// Gerar o certificado



// Script antigo:
/*
$atividade = new Atividade();
$atividade->insereNomeAtividade( $nome_atividade );
$atividade->insereLocal( $local );
$atividade->insereDataAtividade( $data );
$atividade->insereOrganizador( $organizador );
$atividade->insereEmailOrganizador( $email );
$atividade->insereSenhaOrganizador( $senha );
$atividade->insereUrlAtividade( $pagina );
$atividade->insereDescAtividade( $desc );

// Cria um participante com os dados do organizador
$participante = new Participante();
$participante->nome = $organizador;
$participante->senha = $senha;
$participante->email = $email;
*/

// Registra o participante como presente. Isso é util?
$atividade->registraPresentes( $participante );

// Exibe os dados inseridos
$nome_atividade = $atividade->nomeAtividade;
$local = $atividade->retornaLocal();
$data_atividade = $atividade->retornaDataAtividade();
$organizador = $atividade->retornaOrganizador();
$url = $atividade->retornaUrlAtividade();
$desc = $atividade->retornaDescAtividade();

$aluno = $participante->nome;

/*
* O certificado deve conter:
* Aluno
* Organizador
* Atividade
* Data da Atividade
* Data de Emissão
*/

// Código antigo para gerar o Certificado:

$today = date(" d/m/Y ");
$now = date("d/m/Y H:i:s ");
$hash = hash(sha256, $now.$email, false);

$html = "<div class='certificado'>
    <div class='texto'>
        Certificamos que <u>" . $aluno . "</u> participou da <u>" . $nome_atividade . "</u>, ministrada por <u>" . $organizador . "</u>, no dia ". $data_atividade ." na cidade de ". $local .". <br><br><br><br> ". $local .", ". $today ."
        <div style='font-size: 14px;font-family:arial, helvetica;'>
        	<br><br><br><br><br><br><br><br><br><br><br><br> codigo: ". $hash ."
        </div>
    </div>
</div>";

// Se o email estiver cadastrado gera o PDF

if ($aluno == '') {
    echo '<h2 align=center><br><br>Seu email n&atilde;o esta cadastrado. <br>Entre em contato conosco atrav&eacute;s do endere&ccedil;o:<br> certificados@waw.net.br</h2>';
    } else {

        $certificado = new Certificado( $atividade, $atividade->idAtividade );
        $certificado->registraCertificado( $atividade, $participante, $hash );
    	$geraPDF = new mPDF('utf-8', 'A4-L', s, 'Aegyptus');
    	$geraPDF->SetDisplayMode('fullpage');
    	$css = file_get_contents('style.css');
    	$geraPDF->WriteHTML($css,1);
    	$geraPDF->WriteHTML($html);
        // $geraPDF->Output( 'files/'.$hash.'.pdf', f);
        $geraPDF->Output();
    }


// $certificado = new Certificado();
// $certificado->geraCertificado();

?>