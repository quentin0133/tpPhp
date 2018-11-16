<h1>Rechercher un trajet</h1>
<?php
$cpt = 0;
$cpt2 = 0;
$estDouble = false;
$listeBanPropose;
$listeBanParcours;
$listePropose = $managerPropose->getList();
if(!isset($_POST['vil_num1']) && !isset($_POST['vil_num2'])) {
  if(isset($_SESSION['vil_num1'])) {
    unset($_SESSION['vil_num1']);
  }
  ?>
  <form action="#" method="post" id="proposer_parcours">
    <label>Ville de départ :</label>
      <br>
    <select class="select" name="vil_num1" onChange='document.getElementById("proposer_parcours").submit()'>
    <option value=0>
      Choissisez
    </option>
    <?php
    foreach($listePropose as $propose) {
      $parcours = $managerParcours->getParcours($propose->getIdParcours());
      $ville1 = $managerVille->getVille($parcours->getVille1());
      $ville2 = $managerVille->getVille($parcours->getVille2());
      if(isset($listeBanPropose)) {
        foreach ($listeBanPropose as $banPropose) {
          // code...
        }
      }
      if(!$estDouble) {
        $listeBanPropose[$cpt2] = $propose;
        $listeBanParcours[$cpt2] = $parcours;
        if() {
        ?>
          <option value='<?php echo $ville1->getId() ?>'>
            <?php echo $ville1->getNom() ?>
          </option>
        <?php
        }
        else {
        ?>
          <option value='<?php echo $ville2->getId() ?>'>
            <?php echo $ville2->getNom() ?>
          </option>
        <?php
        }
        $cpt2++;
      }
      $estDouble = false;
      $cpt++;
    }
    ?>
    </select>
  </form>
<?php
}
?>
