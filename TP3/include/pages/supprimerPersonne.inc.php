<?php


	$listePersonne = $managerPersonne->getList();
    $managerAvis = new AvisManager($db);
	if(empty($_POST['per_num'])) {
	?>
		<h1>Supprimer une personne</h1>
		<form action="#" method="post">
			<label> Sélectionner la personne à supprimer : </label>
			<select class="select" name="per_num" style="width: 205px;">
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
			</br>
			<input type="submit" value="Valider" />
		</form>
	<?php
	}
	else{
		$managerPropose->delProposePersonne($_POST['per_num']);
		$managerAvis->delAvisPersonne($_POST['per_num']);
		$managerEtudiant->delEtudiantPersonne($_POST['per_num']);
		$managerSalarie->delSalariePersonne($_POST['per_num']);
		$managerPersonne->delPersonne($_POST['per_num']);
		?>
		<h1>Ajouter une ville</h1>
		<p>
			<img src="image/valid.png" />
			La personne a été supprimé avec succès
		</p>
	<?php
  }
?>
