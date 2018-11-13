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
		$r = 'SELECT par_num, per_num, pro_date, pro_time, pro_place, pro_sens FROM propose';

		$tabPropose = $this->db->query($r);
		while($propose = $tabPropose->fetch(PDO::FETCH_OBJ)) {
			$listePropose[] = new Propose($propose);
		}
		return $listePropose;
		$tabPropose->close();
	}
}
?>
