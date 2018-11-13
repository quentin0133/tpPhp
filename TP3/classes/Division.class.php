<?php
class Division{
	private $id;
	private $nom;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'div_num':
					$this->setId($value);
					break;
				case 'div_nom':
					$this->setNom($value);
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

// set ----------------------------
	public function setId($newId) {
		$this->id = $newId;
	}

	public function setNom($newNom) {
		$this->nom = $newNom;
	}
}
