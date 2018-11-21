<?php
class AvisManager{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function delAvis($idPersonne){
        $r = $this->db->prepare(
            'DELETE FROM propose WHERE per_num = '.$idPersonne.' OR per_per_num ='.$idPersonne
        );
        $r->execute();
    }
}
?>
