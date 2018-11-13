<?php
class Salarie{
	private $idPersonne;
	private $telProf;
	private $idFonction;

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
				case 'sal_telprof':
					$this->setTelProf($value);
					break;
				case 'fon_num':
					$this->setIdFonction($value);
					break;
			}
		}
	}

// get ----------------------------
	public function getIdPersonne() {
		return $this->idPersonne;
	}

	public function getTelProf() {
		return $this->telProf;
	}

	public function getIdFonction() {
		return $this->idFonction;
	}

// set ----------------------------
	public function setIdPersonne($newIdPersonne) {
		$this->idPersonne = $newIdPersonne;
	}

	public function setTelProf($newTelProf) {
		$this->telProf = $newTelProf;
	}

	public function setIdFonction($newIdFonction) {
		$this->idFonction = $newIdFonction;
	}
}
