<?php
class Personne{
	private $id;
	private $nom;
	private $prenom;
	private $tel;
	private $mail;
	private $login;
	private $mdp;

	public function __construct($values = array()) {
		if(!empty($values)) {
			$this->set($values);
		}
	}

	public function set($data) {
		foreach($data as $label => $value) {
			switch($label) {
				case 'per_num':
					$this->setId($value);
					break;
				case 'per_nom':
					$this->setNom($value);
					break;
				case 'per_prenom':
					$this->setPrenom($value);
					break;
				case 'per_tel':
					$this->setTel($value);
					break;
				case 'per_mail':
					$this->setMail($value);
					break;
				case 'per_login':
					$this->setLogin($value);
					break;
				case 'per_pwd':
					$this->setMdp($value);
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

	public function getPrenom() {
		return $this->prenom;
	}

	public function getTel() {
		return $this->tel;
	}

	public function getMail() {
		return $this->mail;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getMdp() {
		return $this->mdp;
	}

// set ----------------------------
	public function setId($newId) {
		$this->id = $newId;
	}

	public function setNom($newNom) {
		$this->nom = $newNom;
	}

	public function setPrenom($newPrenom) {
		$this->prenom = $newPrenom;
	}

	public function setTel($newTel) {
		$this->tel = $newTel;
	}

	public function setMail($newMail) {
		$this->mail = $newMail;
	}

	public function setLogin($newLogin) {
		$this->login = $newLogin;
	}

	public function setMdp($newMdp) {
		$this->mdp = $newMdp;
	}
}
