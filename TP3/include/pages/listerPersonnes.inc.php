<?php
  if(empty($_GET['id'])) {
		$listePersonne = $managerPersonne->getList();
    ?>
    <h1>Liste des personnes proposés</h1>
    <p>Actuellement <?php echo sizeof($listePersonne) ?> personnes sont enregistrées</p>
    <table class="collapseTableau">
    	<tr>
    		<th>
    			Numéro
    		</th>
    		<th>
    			Nom
    		</th>
        <th>
    			prenom
    		</th>
    	</tr>
    	<?php
    	foreach($listePersonne as $personne) {
        ?>
    		<tr>
    			<td class="elementTableau">
            <a title="Détail de <?php echo $personne->getPrenom() ?>" href="index.php?page=2&id=<?php echo $personne->getId() ?>">
              <?php echo $personne->getId() ?>
            </a>
    			</td>
    			<td class="elementTableau">
    				<?php echo $personne->getNom() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $personne->getPrenom() ?>
    			</td>
    		</tr>
      	<?php
      }
      ?>
    </table>
    <?php
  }
  else {
    $personne = $managerPersonne->getPersonne($_GET['id']);
    $etudiant = $managerEtudiant->getEtudiantPersonne($_GET['id']);
    $salarie = $managerSalarie->getSalariePersonne($_GET['id']);
    if($_GET['id'] == $etudiant->getIdPersonne()) {
      $departement = $managerDepartement->getDepartement($etudiant->getIdDepartement());
      $ville = $managerVille->getVille($departement->getIdVille());
      ?>
      <h1>Détail sur l'étudiant <?php echo $personne->getNom() ?></h1>
      <table class="collapseTableau">
      	<tr>
      		<th>
      			Prénom
      		</th>
      		<th>
      			Mail
      		</th>
          <th>
      			Tel
      		</th>
          <th>
      			Département
      		</th>
          <th>
      			Ville
      		</th>
      	</tr>
  	    <tr>
  		  	<td class="elementTableau">
            <?php echo $personne->getPrenom() ?>
    			</td>
    			<td class="elementTableau">
    				<?php echo $personne->getMail() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $personne->getTel() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $departement->getNom() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $ville->getNom() ?>
    			</td>
    		</tr>
      </table>
      <?php
    }
    else {
      $fonction = $managerFonction->getFonction($salarie->getIdFonction());
      ?>
      <h1>Détail sur le salarié <?php echo $personne->getNom() ?></h1>
      <table class="collapseTableau">
      	<tr>
      		<th>
      			Prénom
      		</th>
      		<th>
      			Mail
      		</th>
          <th>
      			Tel
      		</th>
          <th>
      			Tel pro
      		</th>
          <th>
      			Fonction
      		</th>
      	</tr>
  	    <tr>
  		  	<td class="elementTableau">
            <?php echo $personne->getPrenom() ?>
    			</td>
    			<td class="elementTableau">
    				<?php echo $personne->getMail() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $personne->getTel() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $salarie->getTelProf() ?>
    			</td>
          <td class="elementTableau">
    				<?php echo $fonction->getLibelle() ?>
    			</td>
    		</tr>
      </table>
      <?php
    }
  }
?>
