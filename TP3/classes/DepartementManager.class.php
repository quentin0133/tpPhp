<?php
class DepartementManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($departement) {
		$r = $this->db->prepare(
		'INSERT INTO departement(dep_num, dep_nom, vil_num) VALUES(:id, :nom, :idDepartement)'
		);
		$r->bindValue(':id', $departement->getIdDepartement(),
			PDO::PARAM_INT);
		$r->bindValue(':nom', $departement->getIdDepartement(),
			PDO::PARAM_STR);
		$r->bindValue(':idDepartement', $departement->getIdDepartement(),
			PDO::PARAM_INT);

		$r->execute();
	}

	public function getList() {
		$listeDepartement = array();
		$r = 'SELECT dep_num, dep_nom, vil_num FROM departement';

		$tabDepartement = $this->db->query($r);
		while($departement = $tabDepartement->fetch(PDO::FETCH_OBJ)) {
			$listeDepartement[] = new Departement($departement);
		}
		return $listeDepartement;
		$tabDepartement->close();
	}

	public function getDepartement($idDepartement) {
		$r = 'SELECT dep_num, dep_nom, vil_num FROM departement WHERE dep_num = '.$idDepartement;

		$tabDepartement = $this->db->query($r);
		$departementFetch = $tabDepartement->fetch(PDO::FETCH_OBJ);
		$departement = new Departement($departementFetch);
		return $departement;
		$tabDepartement->close();
	}
}
?>
