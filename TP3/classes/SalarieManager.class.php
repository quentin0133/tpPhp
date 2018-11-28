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
		$r = $this->db->prepare(
			'SELECT * FROM salarie'
		);

		$r->execute();
		while($salarie = $r->fetch(PDO::FETCH_OBJ)) {
			$listeSalarie[] = new Salarie($salarie);
		}
		return $listeSalarie;
	}

	public function getSalariePersonne($idPersonne) {
		$r = $this->db->prepare(
			'SELECT * FROM salarie WHERE per_num = :idPersonne'
		);
		$r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

		$r->execute();
		$salarieFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Salarie($salarieFetch);
	}

  public function delSalariePersonne($idPersonne){
    $r = $this->db->prepare(
        'DELETE FROM salarie WHERE per_num = :idPersonne'
    );
		$r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

    $r->execute();
  }
}
