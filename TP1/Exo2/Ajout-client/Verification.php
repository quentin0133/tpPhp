<?php
	session_start();
	if(!empty($_POST['FormNomCli']) and !empty($_POST['FormPrenomCli']) and !empty($_POST['FormEmlCli'])) {
		$_SESSION['FormNomCli'] = $_POST['FormNomCli'];
		$_SESSION['FormPrenomCli'] = $_POST['FormPrenomCli'];
		$_SESSION['FormEmlCli'] = $_POST['FormEmlCli'];
		
		$nom = $_SESSION['FormNomCli'];
		$prenom = $_SESSION['FormPrenomCli'];
		$mail = $_SESSION['FormEmlCli'];
		$inscrit = '1';
		$nonInscrit = '0';
		
		$db = mysqli_connect("localhost", "bibi", "bibi");
		mysqli_select_db($db, "client");
		
		$r = "INSERT INTO client(NOM_CLIENT, PRENOM_CLIENT, MAIL_CLIENT, INSCRIT_CLIENT) VALUES('$nom', '$prenom', '$mail', '$inscrit');";
		$r2 = "INSERT INTO client(NOM_CLIENT, PRENOM_CLIENT, MAIL_CLIENT, INSCRIT_CLIENT) VALUES('$nom', '$prenom', '$mail', '$nonInscrit');";
		
		
		if(isset($_POST['diffusion'])) {
			mysqli_query($db, $r);
			$_SESSION['diffusion'] = 1;
		}
		else {
			mysqli_query($db, $r2);
			$_SESSION['diffusion'] = 0;
		}
		header('Location: Afficher.php');
		exit();
	}
	else {
		header('Location: Erreur.php');
		exit();
	}
?>