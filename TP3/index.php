<?php
	require_once("include/config.inc.php");
	require_once("include/functions.inc.php");
	require_once("include/autoLoad.inc.php");
	require_once("include/header.inc.php");

	$db = new Mypdo();
	$managerVille = new VilleManager($db);
	$managerParcours = new ParcoursManager($db);
	$managerPersonne = new PersonneManager($db);
	$managerEtudiant = new EtudiantManager($db);
	$managerDivision = new DivisionManager($db);
	$managerDepartement = new DepartementManager($db);
	$managerSalarie = new SalarieManager($db);
	$managerFonction = new FonctionManager($db);
	$managerPropose = new ProposeManager($db);
?>
<div id="corps">
<?php
	require_once("include/menu.inc.php");
	require_once("include/texte.inc.php");
?>
</div>

<div id="spacer"></div>
<?php
	require_once("include/footer.inc.php");
?>
