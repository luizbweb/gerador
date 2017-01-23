<?php

/*
 * Action para gerar os Certificados
 * Recebe dados dos campos atividade, email do participante.
 * Consulta dos dados da atividade no banco de dados e gera o certificado.
 */

include_once '../Classes/Atividade.class.php';
include_once '../Classes/Participante.class.php';

$nome_atividade = $_POST['atividade'];
$email = $_POST['email'];


// Script antigo:
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

// Associa o organizador como primeiro Participante
$atividade->insereParticipante( $participante );

/*

// Exibe os dados inseridos
$testa[0] = $atividade->retornaAtividade();
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
// $atividade->exibeParticipantes();

*/

$atividade->registraAtividade();
$id_atividade = $atividade->retornaIdAtividade( $nome_atividade );

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="refresh" content="3;../inserirParticipantes.php?atividade=<?php echo $id_atividade; ?>&n=0 "
        <title>Atividade Registrada!</title>
    </head>
    <body>

    </body>
</html>
