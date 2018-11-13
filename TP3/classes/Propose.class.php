<?php
class Propose{
	private $idParcours;
	private $idPersonne;
	private $dateP;
	private $timeP;
	private $place;
	private $sens;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'par_num':
					$this->setIdParcours($value);
					break;
				case 'per_num':
					$this->setIdPersonne($value);
					break;
				case 'pro_date':
					$this->setDate($value);
					break;
				case 'pro_time':
					$this->setTime($value);
					break;
				case 'pro_place':
					$this->setPlace($value);
					break;
				case 'pro_sens':
					$this->setSens($value);
					break;
			}
		}
	}

// get ----------------------------
public function getIdParcours() {
	return $this->idParcours;
}

public function getIdPersonne() {
	return $this->idPersonne;
}

public function getDate() {
	return $this->date;
}

public function getTime() {
	return $this->time;
}

public function getPlace() {
	return $this->place;
}

public function getSens() {
	return $this->idSens;
}

// set ----------------------------
	public function setIdParcours($newIdParcours) {
		$this->idParcours = $newIdParcours;
	}

	public function setIdPersonne($newIdPersonne) {
		$this->idPersonne = $newIdPersonne;
	}

	public function setDate($newDate) {
		$this->date = $newDate;
	}

	public function setTime($newTime) {
		$this->time = $newTime;
	}

	public function setPlace($newPlace) {
		$this->place = $newPlace;
	}

	public function setSens($newSens) {
		$this->idSens = $newSens;
	}
}
?>
