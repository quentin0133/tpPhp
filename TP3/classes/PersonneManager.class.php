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
		$r = $this->db->prepare(
			'SELECT * FROM personne'
		);

		$r->execute();
		while($personne = $r->fetch(PDO::FETCH_OBJ)) {
			$listePersonne[] = new Personne($personne);
		}
		return $listePersonne;
	}

	public function getPersonne($idPersonne) {
		$r = $this->db->prepare(
			'SELECT * FROM personne WHERE per_num = :idPersonne'
		);
		$r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

		$r->execute();
		$personneFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Personne($personneFetch);
	}

    public function delPersonne($idPersonne){
        $r = $this->db->prepare(
            'DELETE FROM personne WHERE per_num = '.$idPersonne
        );
        $r->execute();
    }
}
