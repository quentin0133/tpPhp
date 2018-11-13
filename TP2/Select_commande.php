<?php 
	session_start(); 
	$_SESSION['idClient'] = $_POST['SelectClient'];
	
	$db = mysqli_connect('localhost', 'bibi', 'bibi');
	mysqli_select_db($db, 'client');
?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>TP2</title>
		<link rel="stylesheet" type="text/css">
	</head>
	<body>
		<h2>Détail de la commande d'un client</h2>
		<?php
			$idClient = $_SESSION['idClient'];
			$r = "SELECT NOM_CLIENT FROM client WHERE NO_CLIENT = $idClient";
			$nomClientTableau = mysqli_query($db, $r);
			while($ligne = mysqli_fetch_array($nomClientTableau)) {
				$_SESSION['nomClient'] = $ligne['NOM_CLIENT'];
			}
		?>
		<h4>Nom client : <?php echo $_SESSION['nomClient']; ?></h4>
		<form action="Select_article.php" id="select_commande" method="post">
			N° commande <select name="SelectCommande" size="1" onChange='javascript:document.getElementById("select_commande").submit()'>
				<option>
					Choissisez la commande
				</option>
				<?php
					$r = "SELECT NO_COMMANDE FROM commande WHERE $idClient = NO_CLIENT";
					
					$numCommande = mysqli_query($db, $r);

					while($ligne = mysqli_fetch_array($numCommande)) {		
					?>
						<option>
							<?php echo $ligne['NO_COMMANDE']; ?>
						</option>
					<?php
					}
				?>
				</select>
		</form>
	</body>
</html>