<html>
	<head>
		<meta charset="UTF-8">
		<title>MERCI de remplir le formulaire</title>
	</head>
	<body>
		<h1>Merci de remplir le formulaire</h1>
		<form action="Verification.php" id="insert" method="post">
			Nom <input type="text" name="FormNomCli" size="4">
			<br>
			Prenom <input type="text" name="FormPrenomCli" size="4">
			<br>
			Email <input type="text" name="FormEmlCli" size="4">
			<br>
			<input type="checkbox" name="diffusion" value="oui">Ajoutez moi à la liste de diffusion <br>
			
			<input type="submit" value="Envoyer " />
			<input type="reset" value="annuler" />
		</form>
		<?php echo 'Remplissez toutes les cases !' ?>
	</body>
</html>