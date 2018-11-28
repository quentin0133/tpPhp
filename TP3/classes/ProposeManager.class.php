<?php
class ProposeManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($propose) {
		$r = $this->db->prepare(
			'INSERT INTO propose(par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES(:idParcours, :idPersonne, :dateP,
			:timeP, :place, :sens)'
		);
		$r->bindValue(':idParcours', $propose->getIdParcours(),
			PDO::PARAM_INT);
		$r->bindValue(':idPersonne', $propose->getIdPersonne(),
			PDO::PARAM_INT);
		$r->bindValue(':dateP', $propose->getDate(),
			PDO::PARAM_STR);
		$r->bindValue(':timeP', $propose->getTime(),
			PDO::PARAM_STR);
		$r->bindValue(':place', $propose->getPlace(),
			PDO::PARAM_INT);
		$r->bindValue(':sens', $propose->getSens(),
			PDO::PARAM_INT);

		$r->execute();
	}

	public function getList() {
		$listePropose = array();
		$r = $this->db->prepare(
			'SELECT * FROM propose'
		);

		$r->execute();
		while($propose = $r->fetch(PDO::FETCH_OBJ)) {
			$listePropose[] = new Propose($propose);
		}
		return $listePropose;
	}

	public function getProposeParcours($idParcours) {
		$r = $this->db->prepare(
			'SELECT * FROM propose
			WHERE par_num = :idParcours'
		);
		$r->bindValue(':idParcours', $idParcours,
			PDO::PARAM_INT);

		$r->execute();
		$proposeFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Propose($proposeFetch);
	}

	public function getProposeAroundDate($date, $precision) {
		$listePropose = array();
		$r = $this->db->prepare(
			'SELECT * FROM propose
			 WHERE :date BETWEEN SUBDATE(pro_date, :precision)
			 AND ADDDATE(pro_date, :precision)'
		);
		$r->bindValue(':date', $date,
			PDO::PARAM_STR);
		$r->bindValue(':precision', $precision,
			PDO::PARAM_INT);

		$r->execute();
		while($propose = $r->fetch(PDO::FETCH_OBJ)) {
			$listePropose[] = new Propose($propose);
		}
		return $listePropose;
	}

	public function delProposePersonne($idPersonne){
    $r = $this->db->prepare(
      'DELETE FROM propose WHERE per_num = :idPersonne'
    );
		$r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

    $r->execute();
	}
}
?>
