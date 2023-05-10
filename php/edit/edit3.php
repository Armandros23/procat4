<?php

//botão update
if(isset($_POST['update']))
{	

// including the database connection file
include("db2.php");

	$Fuse_Vout_Neg = mysqli_real_escape_string($mysqli, $_POST['Fuse_Vout_Neg']);
	
	// checking empty fields
	if(empty($Fuse_Vout_Neg)) {	
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o alerta.</div></div>";	
		} 
	else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE UPR_Alerts SET Fuse_Vout_Neg='$Fuse_Vout_Neg'");
	
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

$result = mysqli_query($mysqli, "SELECT Fuse_Vout_Neg FROM UPR_Alerts");

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
  <form action="edit3.php" method="post" name="form1">
    <div class="form-group">
      <label for="Fuse_Vout_Neg">Alerta Fusivel V-:</label>
      <input type="text" class="form-control" name="Fuse_Vout_Neg" value="<?php echo $row['Fuse_Vout_Neg']; ?>">
    </div>
    <button type="submit" class="btn btn-default" name="update">Alterar</button>
	<button type="submit" class="btn btn-default" onclick='fecha()'>Fechar</button>
  </form>
</div>	
	
</body>
</html>
