<h1>Modifier une personne</h1>
<?php
$listePersonne = $managerPersonne->getList();
if(empty($_POST['per_nom']) && empty($_SESSION['personneModif'])) {
	unset($_SESSION['typePersonne']);
	unset($_SESSION['personneModif']);
  ?>
  <form action="#" method="post">
		<table>
      <tr>
				<td colspan="4">
					<label>La personne à modifier :</label>
          <select title="Liste des personnes" class="select"
          name="idPersonneModif" style="width: 205px;">
    			<?php
    				foreach($listePersonne as $personne) {
    				?>
    					<option value='<?php echo $personne->getId(); ?>'>
    						<?php echo strtoupper($personne->getNom()).' '.$personne->getPrenom(); ?>
    					</option>
    				<?php
    				}
    			?>
          </select>
				</td>
      </tr>
			<tr>
				<td class="labelAlign">
					<label>Ancien/nouveau nom:</label>
				</td>
				<td>
					<input title="Veuillez entrer votre nom"
					type="text" name="per_nom" required>
				</td>
				<td class="labelAlign">
					<label>Ancien/nouveau prenom:</label>
				</td>
				<td>
					<input title="Veuillez entrer votre prénom"
					type="text" name="per_prenom" required>
				</td>
			</tr>
			<tr>
				<td class="labelAlign">
					<label>Ancien/nouveau téléphone:</label>
				</td>
				<td>
					<input title="Veuillez entrer votre numéro de téléphone"
					type="text" name="per_tel" required>
				</td>
				<td class="labelAlign">
					<label>Ancien/nouveau mail:</label>
				</td>
				<td>
					<input title="Veuillez entrer votre mail"
					type="text" name="per_mail" required>
				</td>
			</tr>
			<tr>
				<td class="labelAlign">
					<label>Ancien/nouveau login:</label>
				</td>
				<td>
					<input title="Veuillez entrer votre login"
					type="text" name="per_login" required>
				</td>
				<td class="labelAlign">
					<label>Ancien/nouveau mot de passe:</label>
				</td>
				<td>
					<input title="Veuillez entrer votre mot de passe"
					type="password" name="per_pwd" required>
				</td>
			</tr>
			<tr>
				<td colspan=4>
					<label>Catégorie:</label>

					<input title="Personne étudiante" type="radio"
					name="typePersonne" value="etudiant" required />
					<label>Etudiant</label>

					<input title="Personne salarié" type="radio"
					name="typePersonne" value="salarie" required />
					<label>Etudiant</label>
				</td>
			</tr>
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
	if(empty($_SESSION['personneModif'])) {
		$_SESSION['personneModif'] = new Personne($_POST);
		$_SESSION['typePersonne'] = $_POST['typePersonne'];
    $_SESSION['idPersonneModif'] = $_POST['idPersonneModif'];
	}

  if($_SESSION['typePersonne'] == 'etudiant') {
		if(empty($_POST['anneeEtudiant'])) {
		?>
			<form action="#" method="post">
				<label>Année:</label>
				<select title="Année de l'étudiant" class="select" name="anneeEtudiant">
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
				<select title="Département de l'étudiant" class="select" name="departementEtudiant">
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
      $etudiant = new Etudiant (
        array(
          'per_num' => $_SESSION['idPersonneModif'],
          'dep_num' => $_POST['departementEtudiant'],
          'div_num' => $_POST['anneeEtudiant']
        )
      );
      $managerEtudiant->delEtudiantPersonne($_SESSION['idPersonneModif']);
      $managerSalarie->delSalariePersonne($_SESSION['idPersonneModif']);
      $managerEtudiant->add($etudiant);
      $managerPersonne->modifPers($_SESSION['idPersonneModif'], $_SESSION['personneModif']);
      unset($_SESSION['typePersonne']);
			unset($_SESSION['personneModif']);
			?>
      <p>
        <img title="Valide" src="image/valid.png"/>
        La personne a été modifier
      </p>
			<?php
		}
	}
	else {
		if(empty($_POST['telSalarie'])) {
			?>
			<form action="#" method="post">
				<label>Téléphone professionel:</label>
				<input title="Veuillez entrer votre numéro
				de téléphone de travail"
				type="text" name="telSalarie" required>
				<br>
				<label>Fonction:</label>
				<select title="Fonction du salarié" class="select" name="fonctionSalarie">
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
      $salarie = new Salarie(
        array(
          'per_num' => $_SESSION['idPersonneModif'],
          'sal_telprof' => $_POST['telSalarie'],
          'fon_num' => $_POST['fonctionSalarie']
        )
      );
      $managerEtudiant->delEtudiantPersonne($_SESSION['idPersonneModif']);
      $managerSalarie->delSalariePersonne($_SESSION['idPersonneModif']);
      $managerSalarie->add($salarie);
      $managerPersonne->modifPers($_SESSION['idPersonneModif'], $_SESSION['personneModif']);
      unset($_SESSION['typePersonne']);
			unset($_SESSION['personneModif']);
			?>
      <p>
        <img title="Valide" src="image/valid.png"/>
        La personne a été modifier
      </p>
			<?php
		}
	}
}
?>
