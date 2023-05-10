<?php

//botão update
if(isset($_POST['update']))
{	

// including the database connection file
include("db2.php");

	$Input = mysqli_real_escape_string($mysqli, $_POST['Input']);
	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$User = mysqli_real_escape_string($mysqli, $_POST['User']);
	
	//$Password = mysqli_real_escape_string($mysqli, $_POST['Password']);
	$Password = stripslashes($_POST['Password']);
	$passwordEscapado = mysqli_real_escape_string($mysqli,$Password);
	
	$passwordFinal = password_hash($passwordEscapado, PASSWORD_DEFAULT);	
	
	// checking empty fields
	if(empty($name) || empty($User) || empty($Password)) {	
			
		if(empty($nome)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o nome do utilizador da plataforma.</div></div>";
		}
		
		if(empty($User)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o login do utilizador da plataforma.</div></div>";
		}
		
		if(empty($Password)) {
			echo "<div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira a password do utilizador da plataforma.</div></div>";
		}
			
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE ProCat_Users SET name='$name',User='$User',Password='$passwordFinal' WHERE Input=$Input");
	
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
$result = mysqli_query($mysqli, "SELECT * FROM ProCat_Users WHERE Input='" . $_GET["Input"] . "'");

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
  <h2>Editar Utilizador:</h2>
  <form action="edit.php" method="post" name="form1">
    <div class="form-group">
      <label for="name">Nome:</label>
      <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
    </div>
	<div class="form-group">
      <label for="User">Utilizador:</label>
      <input type="text" class="form-control" name="User" value="<?php echo $row['User']; ?>">
    </div>
	<div class="form-group">
      <label for="Password">Password:</label>
      <input type="text" class="form-control" name="Password" value="">
    </div>
	<input type="hidden" name="Input" value=<?php echo $row['Input']; ?>>
    <button type="submit" class="btn btn-default" name="update">Alterar</button>
	<button type="submit" class="btn btn-default" onclick='fecha()'>Fechar</button>
  </form>
</div>	
	
</body>
</html>
