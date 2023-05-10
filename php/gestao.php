<?php

session_start();



if($_SESSION['nome'] == 'user'){

    $_SESSION['erro'] = "Não tem permissão para aceder a esta página.";
  
    echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=login.php\"> ";
    
}else if ($_SESSION['logged'] != true) {//verificacao se tem login feito

    $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";

   echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=index.php\"> ";

} else {

  $nome = $_SESSION['nome'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTÃO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">

<link rel="stylesheet" href="../css/jquery-ui.css">
<script src="../js/index3.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>

<script src="../js/bootstrap.min.js"></script>

<script src="../js/jquery-ui.js"></script>
    <?php

//including the database connection file

        include("db_connection.php");

        ?>



        <!--FUNCÃO BOTÃO ADICIONAR-->

        <style type="text/css">

            button {

                float:right;

            }

        </style>

</head>

<body>

<div class="container" id="container">

<aside class="sidebar" id="mySidebar" style="left:0;margin-left:0;position:absolute">
    <div class="top" id="main" >
        <div class="menu">
        <h2 style="color:white; display: none;" id="nomeProjeto">PROCAT</h2>
            <i class="material-symbols-sharp" style="color:white" onclick="openNav()" id="abrirside">menu</i>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                <span class="material-symbols-sharp" id="closeside" style="display: none; color: white; justify-content: center;">close</span>
            </a>
        </div>
     <!--   <div class="close" id="close-btn">
            <span class="material-symbols-sharp">close</span>
        </div>  -->

    </div>
    <div class="sidebar">
      <a href="index.php">
      <span class="material-symbols-sharp">dashboard</span>
          <h3 id="dashboard">Monitorização</h3>
      </a>
      <a href="mapa.php">
          <span class="material-symbols-sharp">distance</span>
          <h3 id="localizacao">Localização</h3>
      </a>
      <a href="graficos.php">
          <span class="material-symbols-sharp">query_stats</span>
          <h3 id="consulta">Consulta</h3>
      </a>
      <a href="historico.php">
          <span class="material-symbols-sharp">history</span>
          <h3 id="historico">Histórico</h3>
      </a>
      <a href="controlo.php">
          <span class="material-symbols-sharp">toggle_on</span>
          <h3 id="controlo">Controlo</h3>
      </a>
      <a href="gestao.php" class="active">
          <span class="material-symbols-sharp">manage_accounts</span>
          <h3 id="profile">Gestão</h3>
      </a>
      <a href="logout.php" id="traco">
          <span class="material-symbols-sharp">logout</span>
          <h3 id="logout">LOGOUT</h3>
      </a>
    </div>
</aside>
        <!-- fim da sidebar -->
        <main style="height:100%;top: 0;left:15%;position:absolute" >
            <h1 class="titulo">Gestão</h1>

            <br /><br />

<p><strong>Configuração dos Utilizadores</strong></p>

<button type="button" class="btn btn-success" href="#" onclick="window.open('add.html', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Adicionar</button><br />

<table class="table table-striped">

    <thead>

        <tr>

            <th>Nome</th>

            <th>Utilizador</th>

            <th>Ação</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_Users` WHERE Input > 1 ORDER BY Input DESC"); // using mysqli_query instead

        while ($res = mysqli_fetch_array($result)) {

            echo "<tr>";

            echo "<td>" . $res['name'] . "</td>";

            echo "<td>" . $res['User'] . "</td>";

            echo "

<td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit.php?Input=$res[Input]', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a>

| <a href=\"delete.php?Input=$res[Input]\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Confirma a eliminação?')\"><span class=\"glyphicon glyphicon-remove\"></span>Apagar</a></td>";

        }

        ?>



    </tbody>

</table>



<!--TABELA CARTÕES UPCs-->

<br /><br />

<p><strong>Configuração dos Cartões das UPCs</strong></p>

<table class="table table-striped">

    <thead>

        <tr>

            <th>Local</th>

            <th>N.º Cartão</th>

            <th>Consumo Máximo (MB)</th>

            <th>Ação</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '032E280C4321000002'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UPC Póvoa</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit11.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '018E22DC44F1000003'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UPC Aveiro</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit12.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>



    </tbody>

</table>

<!--TABELA CARTÕES UARs-->
<br /><br />

<p><strong>Configuração dos Cartões das UARs</strong></p>

<table class="table table-striped">

    <thead>

        <tr>

            <th>Nome</th>

            <th>N.º Cartão</th>

            <th>Consumo Máximo (MB)</th>

            <th>Ação</th>

        </tr>

    </thead>

    <tbody>
        
        <!--UAR-1-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0311180A3E26000004'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - Aveiro (P1)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit20.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <!--UAR-2-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000006'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - MG (P2)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit22.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <!--UAR-4-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000007'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - Testada (P4)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit23.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-5-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0111180A3E26000005'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - CX2 (P5)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit21.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-6-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000008'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - Chegado (P6)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit24.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-7-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000009'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - E. Vieiros (P7)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit25.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-8-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000010'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - CUF (P8)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit26.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-9-->
        <?php

       $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0311180A3E26000003'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - Póvoa (P9)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit19.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-10-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000011'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - L.CP (P10)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit27.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-11-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0411180A3E26000012'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - C.C (P11)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit28.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>
        
        <!--UAR-12-->
        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0111180A3E26000002'"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>UAR - Cires (12)</td>";

            echo "<td>" . $res['sim_card_number'] . "</td>";

            echo "<td>" . $res['MB_max'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit18.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

    </tbody>

</table>





<!--TABELA TELEFONES-->

<br /><br />

<p><strong>Configuração dos Telefones dos Alertas</strong></p>

<table class="table table-striped">

    <thead>

        <tr>

            <th>Nome</th>

            <th>Telefone</th>

            <th>Ação</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM ProCat_Alerts WHERE Input=1"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>" . $res['Name_1'] . "</td>";

            echo "<td>" . $res['Cellphone_1'] . "</td>";


            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit13.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM ProCat_Alerts WHERE Input=1"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

             echo "<td>" . $res['Name_2'] . "</td>";

            echo "<td>" . $res['Cellphone_2'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit14.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM ProCat_Alerts WHERE Input=1"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

             echo "<td>" . $res['Name_3'] . "</td>";

            echo "<td>" . $res['Cellphone_3'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit15.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM ProCat_Alerts WHERE Input=1"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

             echo "<td>" . $res['Name_4'] . "</td>";

            echo "<td>" . $res['Cellphone_4'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit16.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM ProCat_Alerts WHERE Input=1"); // using mysqli_query instead

         if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>" . $res['Name_5'] . "</td>";

            echo "<td>" . $res['Cellphone_5'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit17.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>



    </tbody>

</table>


<!--TABELA MAILS-->

<br /><br />

<p><strong>Configuração dos E-Mails dos Alertas</strong></p> 

<button type="button" class="btn btn-success" href="#" onclick="window.open('add2.html', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Adicionar</button><br />

<table class="table table-striped">

    <thead>

        <tr>

            <th>Nome</th>

            <th>E-Mail</th>

            <th>Ação</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM ProCat_Mails ORDER BY Input DESC"); // using mysqli_query instead

        while ($res = mysqli_fetch_array($result)) {

            echo "<tr>";

            echo "<td>" . $res['Nome'] . "</td>";

            echo "<td>" . $res['Mail'] . "</td>";

            echo "

<td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit10.php?Input=$res[Input]', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a>

| <a href=\"delete2.php?Input=$res[Input]\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Confirma a eliminação?')\"><span class=\"glyphicon glyphicon-remove\"></span>Apagar</a></td>";

        }

        ?>



    </tbody>

</table>



<!--TABELA ALERTAS-->

<br /><br />

<p><strong>Configuração das Mensagens de Alertas de E-mail</strong></p>



<table class="table table-striped">

    <thead>

        <tr>

            <th>Grupo</th>

            <th>Alerta</th>

            <th>Descrição</th>

            <th>Ação</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $result = mysqli_query($mysqli, "SELECT * FROM UPR_Alerts"); // using mysqli_query instead

        if ($result->num_rows > 0)

        {

            $res = $result->fetch_assoc();



            echo "<tr>";

            echo "<td>Fusivéis</td>";

            echo "<td>V+</td>";

            echo "<td>" . $res['Fuse_Vout_Pos'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit2.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Fusivéis</td>";

            echo "<td>V-</td>";

            echo "<td>" . $res['Fuse_Vout_Neg'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit3.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Fusivéis</td>";

            echo "<td>Vref</td>";

            echo "<td>" . $res['Fuse_Uref'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit4.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Parâmetros</td>";

            echo "<td>TR</td>";

            echo "<td>" . $res['TR'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit5.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Parâmetros</td>";

            echo "<td>Umax</td>";

            echo "<td>" . $res['Umax'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit6.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Parâmetros</td>";

            echo "<td>Imax</td>";

            echo "<td>" . $res['Imax'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit7.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Parâmetros</td>";

            echo "<td>Uref</td>";

            echo "<td>" . $res['Uref'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit8.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



            echo "<tr>";

            echo "<td>Comunicação</td>";

            echo "<td>GPS</td>";

            echo "<td>" . $res['GPS'] . "</td>";

            echo "

                <td><a href=\"#\" class=\"btn btn-info btn-sm\" onclick=\"window.open('edit/edit9.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');\"><span class=\"glyphicon glyphicon-edit\"></span>Editar</a></td>";



        }

        ?>

    </tbody>

</table>





        </main>
        <!--Fim da main-->

    </div>



    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
<?php } ?>