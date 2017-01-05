<?php

    include_once 'Classes/Participante.class.php';
    include_once 'Classes/Atividade.class.php';

    $id_atividade = $_GET['atividade'];
    $n = $_GET['n'];

    /*
     * Action para inserir participantes no banco de dados.
     * Recebe dados dos campos atividade, participante, email, tel
     * Avalia se deve inserir um novo participante ou finalizar as inscrições.
     */

    //  Se o formulario de participantes estiver sendo preenchido, registre no banco de dados.

    if ($n != 0) {
        // Obtem dados do formulario
        $atividade = $_POST['atividade'];
        $nome = $_POST['participante'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];

        // Cria o objeto participante
        $participante = new Participante();

        $participante->idAtividade = $atividade;
        $participante->nome = $nome;
        $participante->email= $email;
        $participante->telefone = $tel;

        // Registra no Banco de dados
        $participante->registraParticipante();
        // $n = $n + 1;
    }

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
            <?php $n = $n + 1; ?>
            <form name="formulario-de-aluno" method="post"
                action="inserirParticipantes.php?atividade=<?php echo $id_atividade; ?>&n=<?php echo $n; ?>">
            <div class="box">
                <p align=""><i>Preencha os dados dos participantes e clique em "Inserir Participante" ou "Finalizar".</i></p>
                <input type="hidden" name="atividade"  <?php echo "value=".$id_atividade; ?> >
                <input type="hidden" name="n"  <?php echo "value=".$n; ?> >
                <p>Nome do Participante: <input type="text" name="participante" value="" placeholder="José"></p>
                <p>Email do Paricipante: <input type="email" name="email" value="" placeholder="nome@provedor.com"></p>
                <p>Telefone do Paricipante: <input type="text" name="tel" value="" placeholder="(00)00000-0000"></p>
                <!-- <p>Matrícula: <input type="text" name="matricula" value="" placeholder="000.000.0000"></p> -->
                <input type="submit" value="Inserir Paricipante"><br /><br />
            </form>
            <form name="formulario-de-aluno" method="post"
                action="index.html">
                <input type="submit" value="Finalizar">
            </div>
            </form>
        </div>
    </body>
</html>
