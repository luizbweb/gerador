<?php

/*
 * Action para gerar os Certificados
 * Recebe dados dos campos atividade, email do participante.
 * Consulta dos dados da atividade no banco de dados e gera o certificado.
 * Pode ser melhorado criando uma unica query que busque o participante de acordo com a atividade.
 */

include_once '../Classes/Atividade.class.php';
include_once '../Classes/Participante.class.php';

// Recebe os dados
$nome_atividade = $_POST['atividade'];
$email = $_POST['email'];

// Consulta as informações da atividade

$atividade = new Atividade();
$atividade->retornaAtividade( $nome_atividade );

// Busca informações do Participante com base no email

$participante = new Participante();
$participante->retornaParticipante( $email, $participante->idAtividade );

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
$testa[0] = $atividade->nomeAtividade;
$testa[1] = $atividade->retornaLocal();
$testa[2] = $atividade->retornaDataAtividade();
$testa[3] = $atividade->retornaOrganizador();
$testa[4] = $atividade->retornaUrlAtividade();
$testa[5] = $atividade->retornaDescAtividade();

foreach ($testa as $retornos) {
    echo $retornos;
    echo '<br>';
}
echo '<br>';

echo $participante->nome;

/*

$atividade->registraAtividade();
$id_atividade = $atividade->retornaIdAtividade( $nome_atividade );
*/


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- <meta http-equiv="refresh" content="3;../inserirParticipantes.php?atividade=<?php echo $id_atividade; ?>&n=0 " -->
        <title>Certificado</title>
    </head>
    <body>

    </body>
</html>
