<?php
class PersonneManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($personne) {
		$r = $this->db->prepare(
		'INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES(:nom, :prenom, :tel, :mail, :login, :mdp)'
		);
		$r->bindValue(':nom', $personne->getNom(),
			PDO::PARAM_INT);
		$r->bindValue(':prenom', $personne->getPrenom(),
			PDO::PARAM_STR);
		$r->bindValue(':tel', $personne->getTel(),
			PDO::PARAM_STR);
		$r->bindValue(':mail', $personne->getMail(),
			PDO::PARAM_STR);
		$r->bindValue(':login', $personne->getLogin(),
			PDO::PARAM_STR);
		$r->bindValue(':mdp', $personne->getMdp(),
			PDO::PARAM_STR);
			
		$r->execute();
	}

	public function getList() {
		$listePersonne = array();
		$r = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd FROM personne';

		$tabPersonne = $this->db->query($r);
		while($personne = $tabPersonne->fetch(PDO::FETCH_OBJ)) {
			$listePersonne[] = new Personne($personne);
		}
		return $listePersonne;
		$tabPersonne->close();
	}

	public function getPersonne($id) {
		$r = 'SELECT per_nom, per_prenom, per_tel, per_mail, per_mail, per_login, per_pwd FROM personne WHERE per_num = '.$id;

		$tabPersonne = $this->db->query($r);
		$personneFetch = $tabPersonne->fetch(PDO::FETCH_OBJ);
		$personne = new Personne($personneFetch);
		return $personne;
		$tabPersonne->close();
	}
}
