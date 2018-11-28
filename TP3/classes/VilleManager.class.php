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
		$r = $this->db->prepare(
			'SELECT * FROM ville'
		);

		$r->execute();
		while($ville = $r->fetch(PDO::FETCH_OBJ)) {
			$listeVilles[] = new Ville($ville);
		}
		return $listeVilles;
	}

	public function getVille($idVille) {
		$r = $this->db->prepare(
			'SELECT * FROM ville WHERE vil_num = :idVille'
		);
		$r->bindValue(':idVille', $idVille,
			PDO::PARAM_INT);

		$r->execute();
		$villeFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Ville($villeFetch);
	}
}
?>
