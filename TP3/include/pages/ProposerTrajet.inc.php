<h1>Proposer un trajet</h1>
<?php
  $estDouble = false;
  $cpt = 0;
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
      <select class="select" name="vil_num1" onChange='document.getElementById("proposer_parcours").submit()'>
      <option value=0>
        Choissisez
      </option>
      <?php
        foreach($listeParcours as $parcours) {
          $ville1 = $managerVille->getVilleParcours($parcours->getVille1());
          for($i=0; $i <= $cpt; $i++) {
            if($listeParcours[$i]->getVille1() == $parcours->getVille1()
            && $listeParcours[$i]->getId() != $parcours->getId()) {
              $estDouble = true;
            }
          }
          if(!$estDouble) {
          ?>
            <option value='<?php echo $parcours->getVille1(); ?>'>
              <?php echo $ville1->getNom(); ?>
            </option>
          <?php
          }
          $estDouble = false;
          $cpt++;
        }
      ?>
      </select>
    </form>
  <?php
  }
  else if(!isset($_POST['vil_num2']) && !isset($_POST['pro_date']) && !isset($_POST['pro_time']) && !isset($_POST['pro_place'])) {
    $_SESSION['vil_num1'] = $_POST['vil_num1'];
    $ville1 = $managerVille->getVilleParcours($_SESSION['vil_num1']);
    ?>
    <form action="#" method="post">
      <table>
        <tr>
          <td class="formulaireProposerTrajet">
            <label>Ville de départ : <?php echo $ville1->getNom();   ?></label>
          </td>
          <td class="labelAlign">
            <label>Ville d'arrivée :</label>
            <select class="select" name="vil_num2">
            <?php
              $listeParcoursBinomeVille = $managerParcours->getListPairVille($_SESSION['vil_num1']);
              foreach($listeParcoursBinomeVille as $parcours) {
                if($parcours->getVille2() != $_SESSION['vil_num1']) {
                  $ville2 = $managerVille->getVilleParcours($parcours->getVille2());
                  $_SESSION['direction'] = 0;
                }
                else {
                  $ville2 = $managerVille->getVilleParcours($parcours->getVille1());
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
            <input type="date" name="pro_date" value="<?php echo date('Y') ?>-<?php echo date('m') ?>-<?php echo date('d') ?>" />
          </td>
          <td>
            <label>Heure de départ : </label>
            <input type="time" name="pro_time" value="<?php echo date('H') ?>:<?php echo date('i') ?>:<?php echo date('s') ?>"
            step="any"
            />
          </td>
        </tr>
        <tr>
          <td>
            <label>Nombre de places : </label>
            <input type="text" name="pro_place" />
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
