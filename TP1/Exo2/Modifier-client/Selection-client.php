<html>
	<head>
		<meta charset="UTF-8">
		<title>Modifier client</title>
	</head>
	<body>
		<h1>Modification du prénom et/ou du mail</h1>
		<form action="Modification.php" id="update" method="post">
			Nom <SELECT name="nom" size="1">
				<?php
					$db = mysqli_connect("localhost", "bibi", "bibi");
					mysqli_select_db($db, "client");
					
					$r = "SELECT NO_CLIENT, NOM_CLIENT FROM client";
					
					$numNomClient = mysqli_query($db, $r);
					
					while($ligne = mysqli_fetch_array($numNomClient)) {		
					?>
						<option value='<?php echo $ligne["NO_CLIENT"]; ?>'>
							<?php echo $ligne["NOM_CLIENT"]; ?>
						</option>
					<?php
					}
				?>
				</SELECT>
			<input type="submit" value="Ok" />
		</form>
	</body>
</html>