<?php
	if(!empty($_POST['FormPrenomCliModif']) or !empty($_POST['FormEmlCliModif'])) {
		session_start();
		$num = $_SESSION['num'];
		$prenom = $_POST['FormPrenomCliModif'];
		$mail = $_POST['FormEmlCliModif'];
		
		$db = mysqli_connect("localhost", "bibi", "bibi");
		mysqli_select_db($db, "client");
			
		if(!empty($_POST['FormPrenomCliModif']) and !empty($_POST['FormEmlCliModif'])) {
			$r = "UPDATE client SET PRENOM_CLIENT = '$prenom', MAIL_CLIENT = '$mail' WHERE NO_CLIENT = '$num'";
			echo $r;
			mysqli_query($db, $r);
		}
		else if(!empty($_POST['FormPrenomCliModif'])) {
			$r = "UPDATE client SET PRENOM_CLIENT = '$prenom' WHERE NOM_CLIENT = '$num'";
			echo $r;
			mysqli_query($db, $r);
		}
		else {
			$r = "UPDATE client SET MAIL_CLIENT = '$mail' WHERE NOM_CLIENT = '$num'";
			echo $r;
			mysqli_query($db, $r);
		}
		header('Location: Confirmation.html');
		exit();
	}
	else {
		header('Location: Erreur.php');
		exit();
	}
?>