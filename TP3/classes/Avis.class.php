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
			$this->add($values);
		}
	}

	public function add($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'per_num':
					$this->setIdPer($value);
					break;
				case 'per_per_num':
					$this->setIdPer_per($value);
					break;
				case 'par_num':
					$this->setIdParcours($value);
					break;
        case 'avi_comm':
            $this->setComm($value);
            break;
        case 'avi_note':
            $this->setNote($value);
            break;
        case 'avi_date':
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
