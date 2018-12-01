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
		$r->closeCursor();
	}

	public function getList() {
		$listeDivision = array();
		$r = $this->db->prepare(
			'SELECT * FROM division'
		);

		$r->execute();
		while($division = $r->fetch(PDO::FETCH_OBJ)) {
			$listeDivision[] = new Division($division);
		}
		$r->closeCursor();
		return $listeDivision;
	}
}
