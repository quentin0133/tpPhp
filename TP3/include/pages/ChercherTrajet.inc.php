<h1>Rechercher un trajet</h1>
<?php
$cpt = 0;
$estDouble = false;
$listeBanParcours;
$listeBanVille;
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
      if(isset($listeBanParcours)) {
        foreach ($listeBanVille as $banVille) {
          if($propose->getSens() == 0) {
            if($banVille->getId() == $ville1->getId()) {
              $estDouble = true;
            }
          }
          else {
            if($banVille->getId() == $ville2->getId()) {
              $estDouble = true;
            }
          }
        }
        foreach ($listeBanParcours as $banParcours) {
          if($banParcours->getId() == $parcours->getId()) {
            $estDouble = true;
          }
        }
      }
      if(!$estDouble) {
        $listeBanParcours[$cpt] = $parcours;
        if($propose->getSens() == 0) {
        ?>
          <option value='<?php echo $ville1->getId() ?>'>
            <?php echo $ville1->getNom() ?>
          </option>
          <?php
          $listeBanVille[$cpt] = $ville1;
        }
        else {
        ?>
          <option value='<?php echo $ville2->getId() ?>'>
            <?php echo $ville2->getNom() ?>
          </option>
          <?php
          $listeBanVille[$cpt] = $ville2;
        }
        $cpt++;
      }
      $estDouble = false;
    }
    ?>
    </select>
  </form>
<?php
}
?>
