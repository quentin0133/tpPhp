<?php
	$listeParcours = $managerParcours->getList();
?>
<h1>Liste des parcours proposés</h1>
<p>Actuellement <?php echo sizeof($managerParcours->getList()) ?> parcours sont enregistrées</p>
<table class="collapseTableau">
	<tr>
		<th> Numéro </th>
		<th> Nom ville </th>
		<th> Nom ville </th>
		<th> Nombre de km </th>
	</tr>
	<?php
		foreach($listeParcours as $parcours) {
			$ville1 = $managerVille->getVille($parcours->getVille1());
			$ville2 = $managerVille->getVille($parcours->getVille2());
		?>
			<tr>
				<td class="elementTableau"> <?php echo $parcours->getId(); ?> </td>
				<td class="elementTableau"> <?php echo $ville1->getNom(); ?> </td>
				<td class="elementTableau"> <?php echo $ville2->getNom(); ?> </td>
				<td class="elementTableau"> <?php echo $parcours->getKm(); ?> </td>
			</tr>
		<?php
		}
	?>
</table>
