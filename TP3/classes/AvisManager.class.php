<?php
class AvisManager{
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getAvis($idPersonne) {
		$listeAvis = array();
		$r = $this->db->prepare(
			'SELECT * FROM avis WHERE per_num = :idPersonne'
		);
    $r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

		$r->execute();
		while($avis = $r->fetch(PDO::FETCH_OBJ)) {
			$listeAvis[] = new Avis($avis);
		}
    $r->closeCursor();
		return $listeAvis;
	}

  public function delAvisPersonne($idPersonne){
    $r = $this->db->prepare(
      'DELETE FROM avis WHERE per_num = :idPersonne OR per_per_num = :idPersonne'
    );
    $r->bindValue(':idPersonne', $idPersonne,
			PDO::PARAM_INT);

    $r->execute();
    $r->closeCursor();
  }

}
?>
