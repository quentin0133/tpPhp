<html>
	<head>
		<meta charset="UTF-8">
		<title>Tout les clients</title>
	</head>
	<body>
		<h1>Affichage des clients</h1>
		<table border=1>
			<tr>
				<td>Nom</td>
				<td>Prénom</td>
				<td>Mail</td>
				<td>Inscrit</td>
			</tr>
				<?php 
					$db = mysqli_connect("localhost", "bibi", "bibi");
					mysqli_select_db($db, "client");
					
					$r = "SELECT * FROM client";
					
					$tableClient = mysqli_query($db, $r);
					
					while($ligne = mysqli_fetch_array($tableClient)) {
						?>
						<tr>
							<td><?php echo $ligne['NOM_CLIENT']; ?></td>
							<td><?php echo $ligne['PRENOM_CLIENT']; ?></td>
							<td><?php echo $ligne['MAIL_CLIENT']; ?></td>
							<td><?php 
								if($ligne['INSCRIT_CLIENT']){
									echo 'Oui';
								}
								else {
									echo 'Non';
								}
							?></td>
						</tr>
						<?php
					}
				?>
		</table>
	</body>
</html>