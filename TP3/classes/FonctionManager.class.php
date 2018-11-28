<?php
class FonctionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($fonction) {
		$r = $this->db->prepare(
			'INSERT INTO fonction(fon_libelle) VALUES(:libelle)'
		);
		$r->bindValue(':libelle', $fonction->getLibelle(),
			PDO::PARAM_STR);

		$r->execute();
		$r->closeCursor();
	}

	public function getList() {
		$listeFonction = array();
		$r = $this->db->prepare(
			'SELECT * FROM fonction'
		);

		$r->execute();
		while($fonction = $r->fetch(PDO::FETCH_OBJ)) {
			$listeFonction[] = new Fonction($fonction);
		}
		$r->closeCursor();
		return $listeFonction;
	}

	public function getFonction($idFonction) {
		$r = $this->db->prepare(
			'SELECT * FROM fonction WHERE fon_num = :idFonction'
		);
		$r->bindValue(':idFonction', $idFonction,
			PDO::PARAM_STR);

		$r->execute();
		$fonctionFetch = $r->fetch(PDO::FETCH_OBJ);
		$r->closeCursor();
		return new Fonction($fonctionFetch);
	}
}
