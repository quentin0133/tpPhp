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

    /**
     * @return array
     */
    public function getList() {
		$listeEtudiant = array();
		$r = 'SELECT per_num, dep_num, div_num FROM etudiant';

		$tabEtudiant = $this->db->query($r);
		while($etudiant = $tabEtudiant->fetch(PDO::FETCH_OBJ)) {
			$listeEtudiant[] = new Etudiant($etudiant);
		}
		return $listeEtudiant;
		$tabEtudiant->close();
	}

	public function getEtudiantPersonne($idPersonne) {
		$r = 'SELECT per_num, dep_num, div_num FROM etudiant WHERE per_num = '.$idPersonne;

		$tabEtudiant = $this->db->query($r);
		$etudiantFetch = $tabEtudiant->fetch(PDO::FETCH_OBJ);
		$etudiant = new Etudiant($etudiantFetch);
		return $etudiant;
		$tabEtudiant->close();
	}
}
