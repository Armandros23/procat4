<html>
<head>
	<title>Adicionar</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--BOOTSTRAP-->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/jquery-ui.css">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery-ui.js"></script>

		<!--Botão fechar-->
		<style>
		.wrapper {
		text-align: center;
		}

		.button {
		position: absolute;
		top: 50%;
		}
		</style>

</head>

<body>
<?php
//including the database connection file
include_once("db_connection.php");

if(isset($_POST['Submit'])) {
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$User = mysqli_real_escape_string($mysqli, $_POST['User']);

	//$Password = mysqli_real_escape_string($mysqli, $_POST['Password']);
	$Password = stripslashes($_POST['Password']);
	$passwordEscapado = mysqli_real_escape_string($mysqli,$Password);

	$passwordFinal = password_hash($passwordEscapado, PASSWORD_DEFAULT);

	// checking empty fields
	if( empty($name) || empty($User) || empty($Password) ) {

		if(empty($name)) {
			echo "<br/><div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o nome do novo utilizador da plataforma.</div></div><br/>";

		}

		if(empty($User)) {
			echo "<br/><div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira o login do utilizador da plataforma.</div></div><br/>";
		}

		if(empty($Password)) {
			echo "<br/><div class=\"container\"><div class=\"alert alert-danger\"><strong>Alerta!</strong> Este campo não pode ficar em branco. Insira a password do utilizador da plataforma.</div></div><br/>";
		}

		//link to the previous page
		echo "<div style=\"text-align:center\"><a href='javascript:self.history.back();' class=\"btn btn-warning\" role=\"button\">Voltar</a></div>";

	} else

		{
		// if all the fields are filled (not empty)

		//insert data to database
		$result = mysqli_query($mysqli, "INSERT INTO ProCat_Users(name,User,Password) VALUES('$name','$User','$passwordFinal')");

		//display success message
		echo "<br/><div class=\"container\"><div class=\"alert alert-success\"><strong>Concluído!</strong> Dados inseridos com sucesso.</div></div><br/>";
		//echo "<br/><a href='index.php'>Ver resultados</a>";
		//echo "<button href='gestao.php' onclick='fecha()'>Fechar</button>";
		echo "<div class=\"wrapper\"><button class=\"btn btn-warning\" role=\"button\" href='gestao.php' onclick='fecha()'>Fechar</button></div>";
		//<!-- aqui a função é carregada ao fechar a popup //-->
		}
}
?>

<script type="text/javascript">
function fecha() {
    opener.location.reload();//Atualiza a página de origem que abriu esse pop-up
	window.close();
}
</script>

</body>

</html>
