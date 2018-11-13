<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Modifier client</title>
	</head>
	<body>
		<h1>Modification du prénom et/ou du mail</h1>
		<form action="Verification.php" id="insert" method="post">
			Prénom <input type="text" name="FormPrenomCliModif" size="4">
			<br>
			Mail <input type="text" name="FormEmlCliModif" size="4">
			<br>
			
			<input type="submit" value="Ok" />
			<input type="reset" value="effacer" />
			<?php
				$_SESSION['num'] = $_POST['nom']; 
			?>
		</form>
	</body>
</html>
</html>