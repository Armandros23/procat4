<?php

session_start();



if ($_SESSION['logged'] != true) {//verificacao se tem login feito

    $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";

   echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=index.php\"> ";

} else {

  $nome = $_SESSION['nome'];

?>

<!DOCTYPE html>

<html lang="PT">

    <head>

        <title>Gestão</title>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <!--BOOTSTRAP-->

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet" href="css/jquery-ui.css">

        <script src="js/jquery-3.2.1.min.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/jquery-ui.js"></script>



	   <?php

//including the database connection file

        include("db2.php");

        ?>



        <!--FUNCÃO BOTÃO ADICIONAR-->

        <style type="text/css">

            button {

                float:right;

            }

        </style>



    </head>

    <body>



       <!-- MENU INICIAL -->

            <nav class="navbar navbar-inverse navbar-fixed-top">

                <div class="container-fluid">

                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                        </button>

                        <a class="navbar-brand" href="monotorizacao.php">

                            <span class="glyphicon glyphicon-dashboard"></span> ProCat</a>

                    </div>

                    <div class="collapse navbar-collapse" id="myNavbar">

                        <ul class="nav navbar-nav">

                           <a href="monotorizacao.php" class="btn btn-primary navbar-btn" role="button">Monitorização</a>&ensp; 

                           <a href="mapa.php" class="btn btn-primary navbar-btn" role="button">Localização</a>&ensp;
                           
                            <a href="consultaAveiro.php" class="btn btn-primary navbar-btn" role="button">Consulta</a>&ensp;                          

                            <a href="historico.php" class="btn btn-primary navbar-btn" role="button">Histórico</a>&ensp;

                           <a href="controlo.php" class="btn btn-primary navbar-btn" role="button">Controlo</a>&ensp; 

                           <a href="gestao.php" class="btn btn-primary navbar-btn" role="button">Gestão</a>

                          

                        </ul>

                       

                       <ul class="nav navbar-nav navbar-right">

                            <li>

                                <a id="log" class=" dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span><?php echo " " . $nome; ?><span class="caret"></span></a>

                                 <ul class="dropdown-menu">



                                <li><a href="logout.php">Terminar Sessão</a></li>



                            </ul>

                            </li>





                        </ul>

                    </div>

                </div>

            </nav>

            <br>

        <!--TITULO-->

        <div class="container">

                 <div class="container" style="margin-top:50px">

         <h2>

            <p align="center">Gestão</p>

         </h2>







            <!--TABELA UTILIZADORES-->

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



        </div>



        <!--RODAPÉ-->

		<br /><br /><br /><br />

        <nav class="navbar navbar-inverse navbar-fixed-bottom">

            <div class="container-fluid">

                <div class="navbar-header">

                    <a class="navbar-brand" href="about.php">Plataforma IoT Cires - Procat &nbsp &nbsp &nbsp &nbsp &nbsp © 2bConnect</a>

                </div>

            </div>

        </nav>



    </body>

</html>

<?php } ?>

