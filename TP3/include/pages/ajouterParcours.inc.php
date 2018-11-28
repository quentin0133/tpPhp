<h1>Ajouter un parcours</h1>
<?php
$listeParcours = $managerParcours->getList();
if(empty($_POST['par_km'])) {
?>
	<form action="#" method="post">
		<label>Ville 1:</label>
		<select class="select" name="vil_num1">
		<?php
			$listeVilles = $managerVille->getList();
			foreach($listeVilles as $ville) {
			?>
				<option value='<?php echo $ville->getId(); ?>'>
					<?php echo $ville->getNom(); ?>
				</option>
			<?php
			}
		?>
		</select>
		<label>Ville 2:</label>
		<select class="select" name="vil_num2">
		<?php
			foreach($listeVilles as $ville) {
			?>
				<option value='<?php echo $ville->getId(); ?>'>
					<?php echo $ville->getNom(); ?>
				</option>
			<?php
			}
		?>
		</select>
		<label>Nombre de kilomètre(s)</label>
		<input type="text" name="par_km">
		</br>
		<input type="submit" value="Valider" />
	</form>
	<?php
}
else {
	$cpt = 0;
	$estDouble = false;
	foreach ($listeParcours as $parcours) {
		if($parcours->getVille1() == $_POST['vil_num1'] && $parcours->getVille2() == $_POST['vil_num2']
		|| $parcours->getVille1() == $_POST['vil_num2'] && $parcours->getVille2() == $_POST['vil_num1']) {
			$estDouble = true;
		}
	}
	if($estDouble) {
		?>
		<h1>Ajouter un parcours</h1>
		<p>
			<img src="image/erreur.png" />
			Le parcours existe déjà !
		</p>
		<?php
	}
	else {
		$parcours = new Parcours($_POST);
		$managerParcours->add($parcours);

		?>
		<h1>Ajouter un parcours</h1>
		<p>
			<img src="image/valid.png" />
			Le parcours a été ajouté
		</p>
	<?php
	}
}
?>
