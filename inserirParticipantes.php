<?php
    $id_atividade = $_GET['atividade'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inserir Participante</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <style>
        body {
            background-image:url('img/logo-waw.png');
            background-repeat:no-repeat;
            background-position: 100px 400px;
            font-family:sans-serif;
            color: #442000;
        }
    </style>
    <body>
        <div class="topo">
            <h1>GERADOR DE CERTIFICADOS</h1>
        </div>
        <div class="formulario-container">
            <form name="formulario-de-aluno" method="post" action="Actions/actionInserirParticipante.php">
            <div class="box">
                <p align=""><i>Preencha os dados dos participantes e clique em "Inserir Participante" ou "Finalizar".</i></p>
                <input type="hidden" name="atividade"  <?php echo "value=".$id_atividade; ?> >
                <p>Nome do Participante: <input type="text" name="participante" value="" placeholder="José"></p>
                <p>Email do Paricipante: <input type="email" name="email" value="" placeholder="nome@provedor.com"></p>
                <p>Telefone do Paricipante: <input type="text" name="tel" value="" placeholder="(00)00000-0000"></p>
                <!-- <p>Matrícula: <input type="text" name="matricula" value="" placeholder="000.000.0000"></p> -->
                <input type="submit" value="Inserir Paricipante"><br /><br />
                <input type="submit" value="Finalizar">
            </div>
            </form>
        </div>
    </body>
</html>