<?php

//botão update
if(isset($_POST['update']))
{	

// including the database connection file
include("db2.php");

	$Uref = mysqli_real_escape_string($mysqli, $_POST['Uref']);
	
	// checking empty fields
	if(empty($Uref)) {	
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o alerta.</div></div>";	
		} 
	else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE UPR_Alerts SET Uref='$Uref'");
	
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

$result = mysqli_query($mysqli, "SELECT Uref FROM UPR_Alerts");

$row = mysqli_fetch_array($result);

?>


<html>
<head>	
	<title>Editar Alerta</title>
	
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
  <h2>Editar Alerta</h2>
  <form action="edit8.php" method="post" name="form1">
    <div class="form-group">
      <label for="Uref">Uref:</label>
      <input type="text" class="form-control" name="Uref" value="<?php echo $row['Uref']; ?>">
    </div>
    <button type="submit" class="btn btn-default" name="update">Alterar</button>
	<button type="submit" class="btn btn-default" onclick='fecha()'>Fechar</button>
  </form>
</div>	
	
</body>
</html>
