<?php
class FonctionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($fonction) {
		$r = $this->db->prepare(
		'INSERT INTO fonction(fon_num, fon_libelle) VALUES(:id, :libelle)'
		);
		$r->bindValue(':id', $fonction->getId(),
			PDO::PARAM_INT);
		$r->bindValue(':libelle', $fonction->getLibelle(),
			PDO::PARAM_STR);

		$r->execute();
	}

	public function getList() {
		$listeFonction = array();
		$r = 'SELECT fon_num, fon_libelle FROM fonction';

		$tabFonction = $this->db->query($r);
		while($fonction = $tabFonction->fetch(PDO::FETCH_OBJ)) {
			$listeFonction[] = new Fonction($fonction);
		}
		return $listeFonction;
		$tabFonction->close();
	}

	public function getFonction($idFonction) {
		$r = 'SELECT fon_num, fon_libelle FROM fonction WHERE fon_num = '.$idFonction;

		$tabFonction = $this->db->query($r);
		$fonctionFetch = $tabFonction->fetch(PDO::FETCH_OBJ);
		$fonction = new Fonction($fonctionFetch);
		return $fonction;
		$tabFonction->close();
	}
}
