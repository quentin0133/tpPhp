<?php
	if(empty($_POST['vil_nom'])) {
		?>
		<h1>Ajouter une ville</h1>
		<form action="#" method="post">
			<label>Nom : </label>
			<input type="text" name="vil_nom">
			<input type="submit" value="Valider" />
		</form>
		<?php
	}
	else {
		$ville = new Ville($_POST);
		$managerVille->add($ville);

		?>
		<h1>Ajouter une ville</h1>
		<p>
			<img src="image/valid.png" />
			La ville "<b><?php echo $ville->getNom(); ?></b>" a été ajouté
		</p>
		<?php
	}
?>
