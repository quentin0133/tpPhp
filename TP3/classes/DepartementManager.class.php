<?php
class DepartementManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($departement) {
		$r = $this->db->prepare(
		'INSERT INTO departement(dep_nom, vil_num) VALUES(:nom, :idVille)'
		);
		$r->bindValue(':nom', $departement->getIdDepartement(),
			PDO::PARAM_STR);
		$r->bindValue(':idVille', $departement->getVille(),
			PDO::PARAM_INT);

		$r->execute();
	}

	public function getList() {
		$listeDepartement = array();
		$r = $this->db->prepare(
			'SELECT * FROM departement'
		);

		$tabDepartement = $this->db->query($r);
		while($departement = $tabDepartement->fetch(PDO::FETCH_OBJ)) {
			$listeDepartement[] = new Departement($departement);
		}
		return $listeDepartement;
	}

	public function getDepartement($idDepartement) {
		$r = $this->db->prepare(
			'SELECT * FROM departement WHERE dep_num = :idDepartement'
		);
		$r->bindValue(':idDepartement', $idDepartement,
			PDO::PARAM_INT);

		$r->execute();
		$departementFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Departement($departementFetch);
	}
}
?>
