<?php


	$listePersonne = $managerPersonne->getList();
    $managerAvis = new AvisManager($db);
	if(empty($_POST['per_num1'])) {
		?>
		<h1>Supprimer une personne</h1>
		<form action="#" method="post">
			<label> Sélectionner la personne à supprimer : </label>
			<select class="select" name="per_num1" style="
                width: 205px;
                ">
			<?php

				foreach($listePersonne as $personne) {
				?>
					<option value='<?php echo $personne->getId(); ?>'>
						<?php echo strtoupper($personne->getNom()); ?>  <?php echo $personne->getPrenom(); ?>
					</option>
				<?php
				}
			?>
            </select>
			</br>
			<input type="submit" value="Valider" />
		</form>
		<?php
	}else{
	    echo $_POST['per_num1'];
	    $DelPropose=$managerPropose->delProposeParcours($_POST['per_num']);
	    $DelAvis = $managerAvis->delAvis($_POST['per_num']);

    }

?>

