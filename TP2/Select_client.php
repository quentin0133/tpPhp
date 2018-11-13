<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>TP2</title>
		<link rel="stylesheet" type="text/css">
	</head>
	<body>
		<h2>Détail de la commande d'un client</h2>
		<form action="Select_commande.php" id="select_client" method="post">
			N° client <select name="SelectClient" size="1" onChange='javascript:document.getElementById("select_client").submit()'>
				<option value="0">
					Choissisez le client
				</option>
				<?php
					$db = mysqli_connect("localhost", "bibi", "bibi");
					mysqli_select_db($db, "client");
					
					$r = "SELECT NO_CLIENT, NOM_CLIENT FROM client";
					
					$numNomClient = mysqli_query($db, $r);
					
					while($ligne = mysqli_fetch_array($numNomClient)) {		
					?>
						<option value="<?php echo $ligne["NO_CLIENT"]; ?>">
							<?php echo $ligne["NOM_CLIENT"]; ?>
						</option>
					<?php
					}
				?>
				</select>
		</form>
	</body>
</html>