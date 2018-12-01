<h1>Ajouter une ville</h1>
<?php
	if(empty($_POST['vil_nom'])) {
	?>
		<form action="#" method="post">
			<label>Nom : </label>
			<input title="SaisieNomVilleAjouter" type="text" name="vil_nom">
			<input type="submit" value="Valider" />
		</form>
	<?php
	}
	else {
		$listeVille = $managerVille->getList();
		$estDouble = false;
		foreach ($listeVille as $ville) {
			if(strtolower($ville->getNom()) == strtolower($_POST['vil_nom'])) {
				$estDouble = true;
			}
		}
		if($estDouble) {
		?>
			<p>
				<img src="image/erreur.png" />
				Cette ville existe déjà !
			</p>
		<?php
		}
		else {
			$ville = new Ville($_POST);
			$managerVille->add($ville);
			?>
			<p>
				<img src="image/valid.png" />
				La ville "<b><?php echo $ville->getNom(); ?></b>" a été ajouté
			</p>
		<?php
		}
	}
?>
