<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ajout avec succès</title>
	</head>
	<body>
		<h1>Affichage et écriture dans la BD</h1>
		<h3>Nous avons reçu les informations suivantes :</h3>
		<h5>Nom = <?php echo $_SESSION["FormNomCli"]; ?></h5>
		<h5>Prénom = <?php echo $_SESSION["FormPrenomCli"]; ?></h5>
		<h5>Mail = <?php echo $_SESSION["FormEmlCli"]; ?></h5>
		<?php 
			if($_SESSION["diffusion"]) {
				echo "inscrit";
			}
			else {
				echo "non inscrit";
			}
			echo "<br>";
			echo "l'insertion s'est bien passée";
			session_unset();
		?>
	</body>
</html>