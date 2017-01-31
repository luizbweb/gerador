<?php

/*
 * Action para consultar os Certificados
 * Recebe dados do campo hash, pesquisa no banco de dados.
 * Retorna as informações do participante e do evento.
 */
 include_once '../Classes/Atividade.class.php';
 include_once '../Classes/Participante.class.php';
 include_once '../Classes/Certificado.class.php';


 $hash = 'cc90420322cfea035fd550494c32d3671d532334a8cfe79d3a0e611c3f6e5533';
 $ativ = new Atividade();
 $cert = new Certificado( $ativ, 0 );

 echo '<h2>Confira os dados do certificado abaixo:</h2>';
 $cert->consultaCertificado( $hash );

?>
