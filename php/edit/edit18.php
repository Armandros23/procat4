<?php

//botão update
if(isset($_POST['update']))
{	

// including the database connection file
include("db2.php");

	$sim_card_number = mysqli_real_escape_string($mysqli, $_POST['sim_card_number']);
	$MB_max = mysqli_real_escape_string($mysqli, $_POST['MB_max']);	
	
	// checking empty fields
	if(empty($sim_card_number) || empty($MB_max)) {	
		
		if(empty($sim_card_number)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o n.º do cartão.</div></div>";
		}
		
		if(empty($MB_max)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o consumo máximo.</div></div>";
		}
				
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE `ProCat_ID` SET `sim_card_number`='$sim_card_number',`MB_max`='$MB_max' WHERE `Serial_Number` LIKE '0111180A3E26000002'");
	
		//display success message
		//print "<p><font face=\"verdana\" color=\"green\">---> Dados alterados com sucesso. Clique em fechar!</font></p>";
		echo "<div class=\"container\"><div class=\"alert alert-success\"><strong>Concluído!</strong> Dados alterados com sucesso. Clique em fechar!</div></div>";
		//echo "<br/><a href='index.php'>Ver resultados</a>";
		//echo "<button href='#' onclick='opener.location.reload()' onclick='window.close()'>Fechar</button>";
		//<!-- aqui a função é carregada ao fechar a popup //--> 

	}
}

?>

<?php

// including the database connection file
include("db2.php");

//selecionar pelo ID
$result = mysqli_query($mysqli, "SELECT * FROM `ProCat_ID` WHERE `Serial_Number` LIKE '0111180A3E26000002'");

$row = mysqli_fetch_array($result);

?>


<html>
<head>	
	<title>Editar Cartões</title>
	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>

  
<script type="text/javascript">
function fecha() {
    opener.location.reload();//Atualiza a página de origem que abriu esse pop-up
	window.close();
}
</script>
	
</head>

<body>
		
	<div class="container">
  <h2>Editar Cartões:</h2>
  <h3>UAR-1</h3></br>
  <form action="edit18.php" method="post" name="form1">
	<div class="form-group">
      <label for="sim_card_number">N.º do Cartão:</label>
      <input type="text" class="form-control" name="sim_card_number" value="<?php echo $row['sim_card_number']; ?>">
    </div>
	<div class="form-group">
      <label for="MB_max">Consumo Máximo (MB):</label>
      <input type="text" class="form-control" name="MB_max" value="<?php echo $row['MB_max']; ?>">
    </div>
    <button type="submit" class="btn btn-default" name="update">Guardar</button>
	<button type="submit" class="btn btn-default" onclick='fecha()'>Fechar</button>
  </form>
</div>	
	
</body>
</html>