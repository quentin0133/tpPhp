<?php
class VilleManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($ville) {
		$r = $this->db->prepare(
		'INSERT INTO ville(vil_nom) VALUES(:nomVille)'
		);
		$r->bindValue(':nomVille', $ville->getNom(),
			PDO::PARAM_STR);
		$r->execute();
	}

	public function getList() {
		$listeVilles = array();
		$r = 'SELECT vil_num, vil_nom FROM ville';

		$tabVille = $this->db->query($r);
		while($ville = $tabVille->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville($ville);
		}
		return $listeVilles;
		$tabVille->close();
	}

	public function getVilleDepartement($idVilleParcours) {
		$r = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num = '.$idVilleParcours;

		$tabVille = $this->db->query($r);
		$villeFetch = $tabVille->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($villeFetch);
		return $ville;
		$tabVille->close();
	}

	public function getVilleParcours($idVilleParcours) {
		$r = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num = '.$idVilleParcours;

		$tabVille = $this->db->query($r);
		$villeFetch = $tabVille->fetch(PDO::FETCH_OBJ);
		$ville = new Ville($villeFetch);
		return $ville;
		$tabVille->close();
	}
}
?>
