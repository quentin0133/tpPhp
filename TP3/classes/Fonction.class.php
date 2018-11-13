<?php
class Fonction{
	private $id;
	private $liblle;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'fon_num':
					$this->setId($value);
					break;
				case 'fon_libelle':
					$this->setLibelle($value);
					break;
			}
		}
	}

// get ----------------------------
	public function getId() {
		return $this->id;
	}

	public function getLibelle() {
		return $this->libelle;
	}

// set ----------------------------
	public function setId($newId) {
		$this->id = $newId;
	}

	public function setLibelle($newLibelle) {
		$this->libelle = $newLibelle;
	}
}
