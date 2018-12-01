<?php
if(empty($_POST['per_nom']) && empty($_SESSION['personne'])) {
	unset($_SESSION['typePersonne']);
	unset($_SESSION['personne']);
	?>
	<h1>Ajouter une personne</h1>
	<form action="#" method="post">
		<table>
			<tr>
				<td class="labelAlign"> <label>Nom:</label> </td>
				<td> <input type="text" name="per_nom" required> </td>
				<td class="labelAlign"> <label>Prenom:</label> </td>
				<td> <input type="text" name="per_prenom" required> </td>
			</tr>
			<tr>
				<td class="labelAlign"> <label>Téléphone:</label> </td>
				<td> <input type="text" name="per_tel" required> </td>
				<td class="labelAlign"> <label>Mail:</label> </td>
				<td> <input type="text" name="per_mail" required> </td>
			</tr>
			<tr>
				<td class="labelAlign"> <label>Login:</label> </td>
				<td> <input type="text" name="per_login" required> </td>
				<td class="labelAlign"> <label>Mot de passe:</label> </td>
				<td> <input type="password" name="per_pwd" required> </td>
			</tr>
			<tr>
				<td colspan=4>
					<label>Catégorie:</label>

					<input type="radio" name="typePersonne" value="etudiant" required />
					<label>Etudiant</label>

					<input type="radio" name="typePersonne" value="personnel" required />
					<label>Personnel</label>
				</td>
			<tr>
				<td colspan=4>
					<input type="submit" value="Valider" />
				</td>
			</tr>
		</table>
	</form>
	<?php
}
else {
	if(empty($_SESSION['personne'])) {
		$personne = new Personne($_POST);
		$_SESSION['personne'] = $personne;
		$_SESSION['typePersonne'] = $_POST['typePersonne'];
	}

	if($_SESSION['typePersonne'] == 'etudiant') {
		if(empty($_POST['anneeEtudiant'])) {
		?>
			<h1>Ajouter un étudiant</h1>
			<form action="#" method="post">
				<label>Année:</label>
				<select class="select" name="anneeEtudiant">
				<?php
					$listeDivisions = $managerDivision->getList();
					foreach($listeDivisions as $division) {
					?>
						<option value='<?php echo $division->getId(); ?>'>
							<?php echo $division->getNom(); ?>
						</option>
					<?php
					}
				?>
				</select>
				<br>
				<label>Département:</label>
				<select class="select" name="departementEtudiant">
				<?php
					$listeDepartement = $managerDepartement->getList();
					foreach($listeDepartement as $departement) {
					?>
						<option value='<?php echo $departement->getId(); ?>'>
							<?php
							$estDouble = false;
							$cpt = 0;
							foreach($listeDepartement as $departementVerif) {
								if($departement->getNom() == $departementVerif->getNom()) {
									$cpt++;
								}
								if($cpt == 2) {
									$estDouble = true;
								}
							}
							if($estDouble) {
								$villeDepartement = $managerVille->getVille($departement->getIdVille());
								echo $departement->getNom().' ('.$villeDepartement->getNom().')';
							}
							else {
								echo $departement->getNom();
							}
							?>
						</option>
					<?php
					}
				?>
				</select>
				<br>
				<input type="submit" name="valider" value="Valider" />
			</form>
		<?php
		}
		else {
			$managerPersonne->add($_SESSION['personne']);
			$etudiant = new Etudiant(
				array(
						'per_num' => $db->lastInsertId(),
						'dep_num' => $_POST['departementEtudiant'],
					  'div_num' => $_POST['anneeEtudiant']
				)
			);
			$managerEtudiant->add($etudiant);
			unset($_SESSION['typePersonne']);
			unset($_SESSION['personne']);
			?>
			<h1>Ajouter un étudiant</h1>
			<p>
				<img src="image/valid.png" />
				L'etudiant a été ajouté
			</p>
			<?php
		}
	}
	else {
		if(empty($_POST['telSalarie'])) {
			?>
			<h1>Ajouter un salarié</h1>
			<form action="#" method="post">
				<label>Téléphone professionel:</label>
				<input type="text" name="telSalarie" required>
				<br>
				<label>Fonction:</label>
				<select class="select" name="fonctionSalarie">
				<?php
					$listeFonction = $managerFonction->getList();
					foreach($listeFonction as $fonction) {
					?>
						<option value='<?php echo $fonction->getId(); ?>'>
							<?php echo $fonction->getLibelle(); ?>
						</option>
					<?php
					}
				?>
				</select>
				<br>
				<input type="submit" value="Valider" />
			</form>
		<?php
		}
		else {
			$managerPersonne->add($_SESSION['personne']);
			$salarie = new Salarie(
				array(
						'per_num' => $db->lastInsertId(),
						'sal_telprof' => $_POST['telSalarie'],
					  'fon_num' => $_POST['fonctionSalarie']
				)
			);
			$managerSalarie->add($salarie);
			unset($_SESSION['typePersonne']);
			unset($_SESSION['personne']);
			?>
			<h1>Ajouter un salarié</h1>
			<p>
				<img src="image/valid.png" />
				Le salarié a été ajouté
			</p>
			<?php
		}
	}
}
?>
