<?php
	session_start();
	$_SESSION['idCommande'] = $_POST['SelectCommande'];

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
		<h4>Nom client : <?php echo $_SESSION['nomClient']; ?></h4>
		<p>N° commande : <?php echo $_SESSION['idCommande']; ?></p>
		<form action="infosArticle.php" id="select_article" method="post">
			N° d'article <select name="SelectArticle" size="1" onChange='javascript:document.getElementById("select_article").submit()'>
				<option>
					Choissisez l'article
				</option>
				<?php
					$idCommande = $_SESSION['idCommande'];
					$r = "SELECT dc.NO_ARTICLE FROM commande c, DETAIL_CDE dc WHERE '$idCommande' = c.NO_COMMANDE AND c.NO_COMMANDE = dc.NO_COMMANDE";

					$numArticle = mysqli_query($db, $r);

					while($ligne = mysqli_fetch_array($numArticle)) {
					?>
						<option>
							<?php echo $ligne["NO_ARTICLE"]; ?>
						</option>
					<?php
					}
				?>
				</select>
		</form>
	</body>
</html>
