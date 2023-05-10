<?php

//botão update
if(isset($_POST['update']))
{	

// including the database connection file
include("db2.php");

	$Input = mysqli_real_escape_string($mysqli, $_POST['Input']);
	
	$Nome = mysqli_real_escape_string($mysqli, $_POST['Nome']);
	$Mail = mysqli_real_escape_string($mysqli, $_POST['Mail']);
	
	//$Password = mysqli_real_escape_string($mysqli, $_POST['Password']);
	//$Password = stripslashes($_POST['Password']);
	//$passwordEscapado = mysqli_real_escape_string($mysqli,$Password);
	
	//$passwordFinal = password_hash($passwordEscapado, PASSWORD_DEFAULT);	
	
	// checking empty fields
	if(empty($Nome) || empty($Mail)) {	
			
		if(empty($Nome)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o nome do utilizador da plataforma.</div></div>";
		}
		
		if(empty($Mail)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o E-Mail do utilizador da plataforma.</div></div>";
		}
		
			
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE ProCat_Mails SET Nome='$Nome',Mail='$Mail' WHERE Input=$Input");
	
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
$result = mysqli_query($mysqli, "SELECT * FROM ProCat_Mails WHERE Input='" . $_GET["Input"] . "'");

$row = mysqli_fetch_array($result);

?>


<html>
<head>	
	<title>Editar Utilizador</title>
	
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
  <h2>Editar E-Mail:</h2>
  <form action="edit10.php" method="post" name="form1">
    <div class="form-group">
      <label for="Nome">Nome:</label>
      <input type="text" class="form-control" name="Nome" value="<?php echo $row['Nome']; ?>">
    </div>
	<div class="form-group">
      <label for="Mail">E-Mail:</label>
      <input type="text" class="form-control" name="Mail" value="<?php echo $row['Mail']; ?>">
    </div>
	<input type="hidden" name="Input" value=<?php echo $row['Input']; ?>>
    <button type="submit" class="btn btn-default" name="update">Alterar</button>
	<button type="submit" class="btn btn-default" onclick='fecha()'>Fechar</button>
  </form>
</div>	
	
</body>
</html>
