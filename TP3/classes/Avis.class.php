<?php
class Avis{
	private $idPer;
	private $idPer_per;
	private $idParcours;
    private $comm;
    private $note;
    private $date;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'idPer':
					$this->setIdPer($value);
					break;
				case 'idPer_per':
					$this->setIdPer_per($value);
					break;
				case 'idParcours':
					$this->setIdParcours($value);
					break;
                case 'comm':
                    $this->setComm($value);
                    break;
                case 'note':
                    $this->setNote($value);
                    break;
                case 'date':
                    $this->setDate($value);
                    break;
			}
		}
	}

// get ----------------------------
	public function getIdPer() {
		return $this->idPer;
	}

	public function getIdPer_per() {
		return $this->idPer_per;
	}

	public function getIdParcours() {
		return $this->idParcours;
	}

    public function getComm() {
        return $this->comm;
    }

    public function getNote() {
        return $this->note;
    }

    public function getDate() {
        return $this->date;
    }

// set ----------------------------
	public function setIdPer($idPer) {
		$this->idPer = $idPer;
	}

	public function setIdPer_per($idPer_per) {
		$this->idPer_per = $idPer_per;
	}

	public function setIdParcours($idParcours) {
		$this->idParcours = $idParcours;
	}

    public function setComm($comm) {
        $this->comm = $comm;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}
?>
