<?php
class DivisionManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($division) {
		$r = $this->db->prepare(
		'INSERT INTO division(div_num, div_nom) VALUES(:id, :nom)'
		);
		$r->bindValue(':id', $division->getId(),
			PDO::PARAM_INT);
		$r->bindValue(':nom', $division->getNom(),
			PDO::PARAM_STR);

		$r->execute();
	}

	public function getList() {
		$listeDivision = array();
		$r = 'SELECT div_num, div_nom FROM division';

		$tabDivision = $this->db->query($r);
		while($division = $tabDivision->fetch(PDO::FETCH_OBJ)) {
			$listeDivision[] = new Division($division);
		}
		return $listeDivision;
		$tabDivision->close();
	}
}
