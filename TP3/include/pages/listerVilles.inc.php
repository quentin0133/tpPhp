<?php
	$listeVille = $managerVille->getList();
?>
<h1>Liste des villes proposés</h1>
<p>Actuellement <?php echo sizeof($managerVille->getList()) ?> villes sont enregistrées</p>
<table class="collapseTableau">
	<tr>
		<th>
			Numéro
		</th>
		<th>
			Nom
		</th>
	</tr>
	<?php
		foreach($listeVille as $ville) {
		?>
			<tr>
				<td class="elementTableau">
					<?php echo $ville->getId() ?>
				</td>
				<td class="elementTableau">
					<?php echo $ville->getNom() ?>
				</td>
			</tr>
		<?php
		}
	?>
</table>
