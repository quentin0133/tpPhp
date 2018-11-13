<html>
	<head>
		<meta charset="UTF-8">
		<title>Supprimer client</title>
	</head>
	<body>
		<h1>Suppression du prénom et/ou du mail</h1>
		<form action="Verification.php" id="update" method="post">
			Nom <SELECT name="FormNomCliSuppr" size="1">
				<?php
					$db = mysqli_connect("localhost", "bibi", "bibi");
					mysqli_select_db($db, "client");
					
					$r = "SELECT NOM_CLIENT FROM client";
					
					$nomClient = mysqli_query($db, $r);
					
					while($ligne = mysqli_fetch_array($nomClient)) {
					?>
						<OPTION><?php echo $ligne["NOM_CLIENT"]; ?>
					<?php
					}
				?>
				</SELECT>
			<input type="submit" value="Ok" />
		</form>
		<?php echo "Impossible de supprimer cet utilisateur !"; ?>
	</body>
</html>
</html>