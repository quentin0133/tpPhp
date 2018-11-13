<?php
class SalarieManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($salarie) {
		$r = $this->db->prepare(
		'INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES(:per_num, :sal_telprof, :fon_num)'
		);
		$r->bindValue(':per_num', $salarie->getIdPersonne(),
			PDO::PARAM_INT);
		$r->bindValue(':sal_telprof', $salarie->getTelProf(),
			PDO::PARAM_STR);
		$r->bindValue(':fon_num', $salarie->getIdFonction(),
			PDO::PARAM_INT);

		$r->execute();
	}

	public function getList() {
		$listeSalarie = array();
		$r = 'SELECT per_num, sal_telprof, fon_num FROM salarie';

		$tabSalarie = $this->db->query($r);
		while($salarie = $tabSalarie->fetch(PDO::FETCH_OBJ)) {
			$listeSalarie[] = new Salarie($salarie);
		}
		return $listeSalarie;
		$tabSalarie->close();
	}

	public function getSalariePersonne($idPersonne) {
		$r = 'SELECT per_num, sal_telprof, fon_num FROM salarie WHERE per_num = '.$idPersonne;

		$tabSalarie = $this->db->query($r);
		$salarieFetch = $tabSalarie->fetch(PDO::FETCH_OBJ);
		$salarie = new Salarie($salarieFetch);
		return $salarie;
		$tabSalarie->close();
	}
}
