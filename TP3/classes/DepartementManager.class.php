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
		$r->closeCursor();
	}

	public function getList() {
		$listeDepartement = array();
		$r = $this->db->prepare(
			'SELECT * FROM departement'
		);

		$r->execute();
		while($departement = $r->fetch(PDO::FETCH_OBJ)) {
			$listeDepartement[] = new Departement($departement);
		}
		$r->closeCursor();
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
		$r->closeCursor();
		return new Departement($departementFetch);
	}
}
?>
