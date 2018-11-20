<?php
class Departement{
	private $id;
	private $nom;
	private $idVille;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'dep_num':
					$this->setId($value);
					break;
				case 'dep_nom':
					$this->setNom($value);
					break;
				case 'vil_num':
					$this->setIdVille($value);
					break;
			}
		}
	}

// get ----------------------------
	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getIdVille() {
		return $this->idVille;
	}

// set ----------------------------
	public function setId($newId) {
		$this->id = $newId;
	}

	public function setNom($newNom) {
		$this->nom = $newNom;
	}

	public function setIdVille($newIdVille) {
		$this->idVille = $newIdVille;
	}
}
?>
