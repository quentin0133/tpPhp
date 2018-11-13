<?php
class Parcours{
	private $id;
	private $km;
	private $ville1;
	private $ville2;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'par_num':
					$this->setId($value);
					break;
				case 'par_km':
					$this->setKm($value);
					break;
				case 'vil_num1':
					$this->setVille1($value);
					break;
				case 'vil_num2':
					$this->setVille2($value);
					break;
			}
		}
	}

// get ----------------------------
	public function getId() {
		return $this->id;
	}

	public function getKm() {
		return $this->km;
	}

	public function getVille1() {
		return $this->ville1;
	}

	public function getVille2() {
		return $this->ville2;
	}

// set ----------------------------
	public function setId($newId) {
		$this->id = $newId;
	}

	public function setKm($newKm) {
		$this->km = $newKm;
	}

	public function setVille1($newVille1) {
		$this->ville1 = $newVille1;
	}

	public function setVille2($newVille2) {
		$this->ville2 = $newVille2;
	}
}
