<?php

/*
 * Action para consultar os Certificados
 * Recebe dados do campo hash, pesquisa no banco de dados.
 * Retorna as informações do participante e do evento.
 */
 include_once '../Classes/Atividade.class.php';
 include_once '../Classes/Participante.class.php';
 include_once '../Classes/Certificado.class.php';

 // $hash = 'cc90420322cfea035fd550494c32d3671d532334a8cfe79d3a0e611c3f6e5533';

 $hash = $_POST['codigo'];
 $ativ = new Atividade();
 $cert = new Certificado( $ativ, 0 );

 ?>

 <html>
     <head>
         <meta charset="utf-8">
         <title>Consulta Certificados</title>
         <link rel="stylesheet" type="text/css" href="style.css">
     </head>
     <style>
         body {
             background-image:url('img/logo-waw.png');
             background-repeat:no-repeat;
             background-position: 100px 400px;
             font-family:sans-serif;
             color: #442000;
             padding: 5%;
         }
     </style>
     <body>
         <div class="topo">
             <h1>Confira os dados do certificado:</h1>
         </div>

         <?php

         echo '<h2></h2>';
         $cert->consultaCertificado( $hash );

        ?>
     </body>
 </html>
