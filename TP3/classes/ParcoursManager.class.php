<?php
class ParcoursManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($parcours) {
		$r = $this->db->prepare(
			'INSERT INTO parcours(par_km, vil_num1, vil_num2) VALUES(:parKm, :parVille1, :parVille2)'
		);
		$r->bindValue(':parKm', $parcours->getKm(),
			PDO::PARAM_INT);
		$r->bindValue(':parVille1', $parcours->getVille1(),
			PDO::PARAM_INT);
		$r->bindValue(':parVille2', $parcours->getVille2(),
			PDO::PARAM_INT);

		$r->execute();
	}

	public function getList() {
		$listeParcours = array();
		$r = $this->db->prepare(
			'SELECT * FROM parcours'
		);

		$r->execute();
		while($parcours = $r->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours($parcours);
		}
		return $listeParcours;
	}

	public function getParcours($idParcours) {
		$r = $this->db->prepare(
			'SELECT * FROM parcours WHERE par_num = :idParcours'
		);
		$r->bindValue(':idParcours', $idParcours,
			PDO::PARAM_INT);

		$r->execute();
		$parcoursFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Parcours($parcoursFetch);
	}

	public function getListPairVille($vil_num) {
		$r = $this->db->prepare(
			'SELECT * FROM parcours WHERE vil_num1 = :vil_num OR vil_num2 = :vil_num'
		);
		$r->bindValue(':vil_num', $vil_num,
			PDO::PARAM_INT);

		$r->execute();
		while($parcours = $r->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours($parcours);
		}
		return $listeParcours;
	}
}
