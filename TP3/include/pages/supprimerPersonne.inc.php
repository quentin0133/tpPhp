<?php


	$listePersonne = $managerPersonne->getList();

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
				    if($_SESSION['estConnecte'] != $personne){  ?>
                        <option value='<?php echo $personne->getId(); ?>'>

                            <?php echo strtoupper($personne->getNom()); ?>  <?php echo $personne->getPrenom(); ?>
                        </option>
				<?php }
				}
			?>
            </select>
			</br>
			<input type="submit" value="Valider" />
		</form>
		<?php
	}else{

        $res = $managerPersonne->getPersonne($_POST['per_num1']);


	    $DelPropose=$managerPropose->delProposeParcours($_POST['per_num1']);
	    $DelAvis = $managerAvis->delAvis($_POST['per_num1']);
	    $DelSalarie = $managerSalarie->delSalarie($_POST['per_num1']);
	    $DelEtudiant = $managerEtudiant->delEtudiant($_POST['per_num1']);

        $Personne=$managerPersonne->delPersonne($_POST['per_num1']);
        ?>

        <p>
            <img src="image/valid.png" />
            La personne <b> <?php echo strtoupper($res->getNom()).$res->getPrenom() ;?></b> a été supprimé
        </p>

<?php
    }

?>

