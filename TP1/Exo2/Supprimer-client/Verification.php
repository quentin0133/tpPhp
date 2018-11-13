<?php
	$num = $_POST["FormNomCliSuppr"];

	$db = mysqli_connect("localhost", "bibi", "bibi");
	mysqli_select_db($db, "client");
	
	$r = "SELECT INSCRIT_CLIENT FROM client WHERE NO_CLIENT = '$num'";
	echo $r;
	$inscriptionClient = mysqli_query($db, $r);
	
	$ligne = mysqli_fetch_array($inscriptionClient);
	
	if(!$ligne['INSCRIT_CLIENT']) {
		$r = "DELETE FROM client WHERE NO_CLIENT = '$num'";
		
		mysqli_query($db, $r);
		header('Location: Confirmation.php');
		exit();
	}
	else {
		header('Location: Erreur.php');
		exit();
	}
?>