<?php

//botão update
if(isset($_POST['update']))
{	

// including the database connection file
include("db2.php");

	$Name_5 = mysqli_real_escape_string($mysqli, $_POST['Name_5']);
	$Cellphone_5 = mysqli_real_escape_string($mysqli, $_POST['Cellphone_5']);	
	
	// checking empty fields
	if(empty($Name_5) || empty($Cellphone_5)) {	
		
		if(empty($Name_5)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o nome.</div></div>";
		}
		
		if(empty($Cellphone_5)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o n.º de telefone.</div></div>";
			
		}
				
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE ProCat_Alerts SET Name_5='$Name_5', Cellphone_5='$Cellphone_5', Command=1 WHERE Input=1");
		$result = mysqli_query($mysqli, "UPDATE ProCat_Alerts SET Name_5='$Name_5', Cellphone_5='$Cellphone_5', Command=1 WHERE Input=2");
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
$result = mysqli_query($mysqli, "SELECT * FROM ProCat_Alerts WHERE Input=1");

$row = mysqli_fetch_array($result);

?>


<html>
<head>	
	<title>Configuração dos Telefones dos Alertas</title>
	
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
  <h2>Configuração dos Telefones e E-mails dos Alertas:</h2>
  <form action="edit17.php" method="post" name="form1">
	<div class="form-group">
      <label for="Name_5">Nome:</label>
      <input type="text" class="form-control" name="Name_5" value="<?php echo $row['Name_5']; ?>">
    </div>
	<div class="form-group">
      <label for="Cellphone_5">Telefone:</label>
      <input type="text" class="form-control" name="Cellphone_5" value="<?php echo $row['Cellphone_5']; ?>">
    </div>
    <button type="submit" class="btn btn-default" name="update">Guardar</button>
	<button type="submit" class="btn btn-default" onclick='fecha()'>Fechar</button>
  </form>
</div>	
	
</body>
</html>