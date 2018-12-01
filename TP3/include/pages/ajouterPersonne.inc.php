<!-- Mettre l'objet personne dans la SESSION -->
<?php
	if(isEmptyPersonne($_POST) && (!isset($_POST['departementEtudiant'])
	&& !isset($_POST['fonctionSalarie']))) {
		if(isset($_SESSION['typePersonne'])) {
			unset($_SESSION['typePersonne']);
			unset($_SESSION['personne']);
		}
		?>
		<h1>Ajouter une personne</h1>
		<form action="#" method="post">
			<table>
				<tr>
					<td class="labelAlign"> <label>Nom:</label> </td>
					<td> <input type="text" name="per_nom"> </td>
					<td class="labelAlign"> <label>Prenom:</label> </td>
					<td> <input type="text" name="per_prenom"> </td>
				</tr>
				<tr>
					<td class="labelAlign"> <label>Téléphone:</label> </td>
					<td> <input type="text" name="per_tel"> </td>
					<td class="labelAlign"> <label>Mail:</label> </td>
					<td> <input type="text" name="per_mail"> </td>
				</tr>
				<tr>
					<td class="labelAlign"> <label>Login:</label> </td>
					<td> <input type="text" name="per_login"> </td>
					<td class="labelAlign"> <label>Mot de passe:</label> </td>
					<td> <input type="password" name="per_pwd"> </td>
				</tr>
				<tr>
					<td colspan=4>
						<label>Catégorie:</label>

						<input type="radio" name="typePersonne" value="etudiant" />
						<label>Etudiant</label>

						<input type="radio" name="typePersonne" value="personnel" />
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
			$personne = new Personne(
				array('per_nom' => $_POST['per_nom'],
						'per_prenom' => $_POST['per_prenom'],
						'per_tel' => $_POST['per_tel'],
						'per_mail' => $_POST['per_mail'],
						'per_login' => $_POST['per_login'],
						'per_pwd' => $_POST['per_pwd'].SALT
				)
			);
			$_SESSION['personne'] = $personne;
			$_SESSION['typePersonne'] = $_POST['typePersonne'];
		}

		if(isset($_SESSION['typePersonne']) && $_SESSION['typePersonne'] == 'etudiant') {
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
				?>
				<h1>Ajouter un etudiant</h1>
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
					<input type="text" name="telSalarie">
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
