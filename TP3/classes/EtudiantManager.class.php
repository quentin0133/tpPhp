<?php
class EtudiantManager{
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add($etudiant) {
		$r = $this->db->prepare(
			'INSERT INTO etudiant(per_num, dep_num, div_num) VALUES(:idPersonne, :idDepartement, :idDivision)'
		);
		$r->bindValue(':idPersonne', $etudiant->getIdPersonne(),
			PDO::PARAM_INT);
		$r->bindValue(':idDepartement', $etudiant->getIdDepartement(),
			PDO::PARAM_INT);
		$r->bindValue(':idDivision', $etudiant->getIdDivision(),
			PDO::PARAM_INT);

		$r->execute();
	}

  public function getList() {
		$listeEtudiant = array();
		$r = $this->db->prepare(
			'SELECT * FROM etudiant'
		);

		$r->execute();
		while($etudiant = $tabEtudiant->fetch(PDO::FETCH_OBJ)) {
			$listeEtudiant[] = new Etudiant($etudiant);
		}
		return $listeEtudiant;
	}

	public function getEtudiantPersonne($idPersonne) {
		$r = $this->db->prepare(
			'SELECT * FROM etudiant WHERE per_num = :idPersonne'
		);
		$r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

		$r->execute();
		$etudiantFetch = $r->fetch(PDO::FETCH_OBJ);
		return new Etudiant($etudiantFetch);
	}
}
