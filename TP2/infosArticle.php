<?php
	session_start();
	$_SESSION['idArticle'] = $_POST['SelectArticle'];
	
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
		<p>N° article : <?php echo $_SESSION['idArticle']; ?></p>
		<table border="1">
			<tr>
				<td>
					N° article
				</td>
				<td>
					Nom article
				</td>
				<td>
					Quantité commandée
				</td>
				<td>
					Quantité livrée
				</td>
			</tr>
			<?php
				$idArticle = $_SESSION['idArticle'];
				
				$r = "SELECT a.NO_ARTICLE, LIB_ARTICLE, SUM(QTE_CDEE) as QTE_CDEE, SUM(QTE_LIVREE) as QTE_LIVREE FROM ARTICLE a, DETAIL_CDE dc
				WHERE dc.NO_ARTICLE = $idArticle GROUP BY a.NO_ARTICLE";

				$resultat = mysqli_query($db, $r);
				
				while($ligne = mysqli_fetch_array($resultat)) {
					?>
						<tr>
							<td>
								<?php echo $ligne['NO_ARTICLE']; ?>
							</td>
							<td>
								<?php echo $ligne['LIB_ARTICLE']; ?>
							</td>
							<td>
								<?php echo $ligne['QTE_CDEE']; ?>
							</td>
							<td>
								<?php echo $ligne['QTE_LIVREE']; ?>
							</td>
						</tr>
					<?php
				}
			?>
		</table>
	</body>
</html>