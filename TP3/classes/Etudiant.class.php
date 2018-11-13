<?php
class Etudiant{
	private $idPersonne;
	private $idDepartement;
	private $idDivision;

	public function __construct($values = array()) {

		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'per_num':
					$this->setIdPersonne($value);
					break;
				case 'dep_num':
					$this->setIdDepartement($value);
					break;
				case 'div_num':
					$this->setIdDivision($value);
					break;
			}
		}
	}

// get ----------------------------
	public function getIdPersonne() {
		return $this->idPersonne;
	}

	public function getIdDepartement() {
		return $this->idDepartement;
	}

	public function getIdDivision() {
		return $this->idDivision;
	}

// set ----------------------------
	public function setIdPersonne($newIdPersonne) {
		$this->idPersonne = $newIdPersonne;
	}

	public function setIdDepartement($newDepartement) {
		$this->idDepartement = $newDepartement;
	}

	public function setIdDivision($newIdDivision) {
		$this->idDivision = $newIdDivision;
	}
}
?>
