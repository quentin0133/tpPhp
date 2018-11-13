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
		$r = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';

		$tabParcours = $this->db->query($r);
		while($parcours = $tabParcours->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours($parcours);
		}
		return $listeParcours;
		$tabParcours->close();
	}

	public function getParcours($idParcours) {
		$r = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours WHERE par_num = '.$idParcours;

		$tabParcours = $this->db->query($r);
		$parcoursFetch = $tabParcours->fetch(PDO::FETCH_OBJ);
		$parcours = new Parcours($parcoursFetch);
		return $parcours;
		$tabParcours->close();
	}

	public function getListPairVille($vil_num) {
		$r = 'SELECT par_num, vil_num1, vil_num2 FROM parcours WHERE vil_num1 = '.$vil_num.' OR vil_num2 = '.$vil_num;

		$tabParcours = $this->db->query($r);
		while($parcours = $tabParcours->fetch(PDO::FETCH_OBJ)) {
			$listeParcours[] = new Parcours($parcours);
		}
		return $listeParcours;
		$tabParcours->close();
	}
}
