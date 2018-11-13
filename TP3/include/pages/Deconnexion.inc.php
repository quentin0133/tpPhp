<?php
	session_unset($_SESSION['estConnecte']);
	header('Location: index.php?page=0');
	exit();
?>
