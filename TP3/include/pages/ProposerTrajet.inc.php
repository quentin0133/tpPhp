<h1>Proposer un trajet</h1>
<?php
//Si la personne entre la index?page=9,il revient à l'accueil
if(!isset($_SESSION['estConnecte'])) {
  header('Location: index.php?page=0');
	exit();
}
$date = date("d/m/Y");
$heure = date("H:i:s");
$listeParcours = $managerParcours->getList();
if(!isset($_POST['vil_num1']) && !isset($_POST['vil_num2'])) {
  if(isset($_SESSION['vil_num1'])) {
    unset($_SESSION['vil_num1']);
  }
  ?>
  <form action="#" method="post" id="proposer_parcours">
    <label>Ville de départ :</label>
      <br>
    <select title="Ville de départ" class="select" name="vil_num1" onChange='document.getElementById("proposer_parcours").submit()'>
    <option value=0>
      Choissisez
    </option>
    <?php
      foreach($listeParcours as $parcours) {
        $estDouble = false;
        $ville1 = $managerVille->getVille($parcours->getVille1());

        foreach ($listeBanVille as $banVille) {
          if($banVille->getId() == $ville1->getId()) {
            $estDouble = true;
          }
        }

        if(!$estDouble) {
          $listeBanVille[] = $ville1;
          ?>
          <option value='<?php echo $ville1->getId(); ?>'>
            <?php echo $ville1->getNom(); ?>
          </option>
          <?php
        }

        $estDouble = false;
        $ville2 = $managerVille->getVille($parcours->getVille2());
        foreach ($listeBanVille as $banVille) {
          if($banVille->getId() == $ville2->getId()) {
            $estDouble = true;
          }
        }

        if(!$estDouble) {
          $listeBanVille[] = $ville2;
          ?>
          <option value='<?php echo $ville2->getId(); ?>'>
            <?php echo $ville2->getNom(); ?>
          </option>
          <?php
        }

      }
    ?>
    </select>
  </form>
<?php
}
else if(empty($_POST['pro_date'])) {
  if(empty($_SESSION['vil_num1'])) {
    $_SESSION['vil_num1'] = $_POST['vil_num1'];
  }
  $ville1 = $managerVille->getVille($_SESSION['vil_num1']);
  ?>
  <form action="#" method="post">
    <table>
      <tr>
        <td class="formulaireProposerTrajet">
          <label>Ville de départ : <?php echo $ville1->getNom();   ?></label>
        </td>
        <td class="labelAlign">
          <label>Ville d'arrivée :</label>
          <select title="Ville d'arrivée" class="select" name="vil_num2">
          <?php
            $listeParcoursBinomeVille = $managerParcours->getListPairVille($_SESSION['vil_num1']);
            foreach($listeParcoursBinomeVille as $parcours) {
              if($parcours->getVille2() != $_SESSION['vil_num1']) {
                $ville2 = $managerVille->getVille($parcours->getVille2());
                $_SESSION['direction'] = 0;
              }
              else {
                $ville2 = $managerVille->getVille($parcours->getVille1());
                $_SESSION['direction'] = 1;
              }
              ?>
              <option value='<?php echo $ville2->getId(); ?>'>
                <?php echo $ville2->getNom(); ?>
              </option>
            <?php
            }
          ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label>Date de départ : </label>
          <input title="SaisieDateDeDepart" type="date" name="pro_date"
          value="<?php echo date('Y') ?>-<?php echo date('m') ?>-<?php echo date('d') ?>" required/>
        </td>
        <td>
          <label>Heure de départ : </label>
          <input title="SaisieHeureDeDepart" type="time" name="pro_time"
          value="<?php echo date('H') ?>:<?php echo date('i') ?>:<?php echo date('s') ?>" required
          step="any" />
        </td>
      </tr>
      <tr>
        <td>
          <label>Nombre de places : </label>
          <input title="SaisieNombreDePLace" type="text" name="pro_place" required/>
        </td>
      </tr>
    </table>
    <input type="submit" value="Valider" />
  </form>
  <?php
}
else {
  foreach ($listeParcours as $parcours) {
    if($parcours->getVille1() == $_SESSION['vil_num1'] && $parcours->getVille2() == $_POST['vil_num2']) {
      $parcoursSelectionner = $parcours;
    }
    if($parcours->getVille1() == $_POST['vil_num2'] && $parcours->getVille2() == $_SESSION['vil_num1']) {
      $parcoursSelectionner = $parcours;
    }
  }
  $propose = new Propose(
    array('par_num' => $parcoursSelectionner->getId(),
        'per_num' => $_SESSION['estConnecte']->getId(),
        'pro_date' => $_POST['pro_date'],
        'pro_time' => $_POST['pro_time'],
        'pro_place' => $_POST['pro_place'],
        'pro_sens' => $_SESSION['direction']
    )
  );
  $managerPropose->add($propose);
  ?>
  <p>
    <img src="image/valid.png" />
    Le trajet a été ajouté avec succès !
  </p>
<?php
}
?>
