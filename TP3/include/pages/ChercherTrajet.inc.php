<h1>Rechercher un trajet</h1>
<?php
$estDouble = false;
$listePropose = $managerPropose->getList();
if(!isset($_POST['vil_depart']) && !isset($_POST['vil_arrive'])) {
  if(isset($_SESSION['vilvil_depart'])) {
    unset($_SESSION['vil_depart']);
  }
  ?>
  <form action="#" method="post" id="proposer_parcours">
    <label>Ville de départ :</label>
      <br>
    <select class="select" name="vil_depart" onChange='document.getElementById("proposer_parcours").submit()'>
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
        $listeBanParcours[] = $parcours;
        if($propose->getSens() == 0) {
          $listeBanVille[] = $ville1;
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
          $listeBanVille[] = $ville2;
        }
      }
      $estDouble = false;
    }
    ?>
    </select>
  </form>
<?php
}
else if(!isset($_POST['vil_arrive']) && !isset($_POST['date'])
&& !isset($_POST['precision']) && !isset($_POST['temp_depart'])) {
  $_SESSION['vil_depart'] = $_POST['vil_depart'];
  $villeDepart = $managerVille->getVille($_SESSION['vil_depart']);
  ?>
  <form action="#" method="post">
    <table>
      <tr>
        <td class="formulaireProposerTrajet">
          <label>Ville de départ : <?php echo $villeDepart->getNom();   ?></label>
        </td>
        <td class="labelAlign">
          <label>Ville d'arrivée :</label>
          <select class="select" name="vil_arrive">
          <?php
            $listeParcoursBinomeVille = $managerParcours->getListPairVille($_SESSION['vil_depart']);
            foreach($listeParcoursBinomeVille as $parcours) {
              if($parcours->getVille2() != $_SESSION['vil_depart']) {
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
          <input type="date" name="date" value="<?php echo date('Y') ?>-<?php echo date('m') ?>-<?php echo date('d') ?>"/>
        </td>
        <td>
          <label>Précision : </label>
          <select class="select" name="precision">
            <option value="0">Ce jour</option>
            <option value="1">+/- 1 jour</option>
            <option value="2">+/- 2 jours</option>
            <option value="3">+/- 3 jours</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label>A partir de : </label>
          <select class="select" name="temp_depart">
            <?php
            for ($cpt = 0; $cpt <= 24; $cpt++) {
            ?>
              <option value="<?php echo $cpt; ?>">
                <?php echo $cpt.'h'; ?>
              </option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>
    </table>
    <input type="submit" value="Valider" />
  </form>
<?php
}
else {
  $listePropose = $managerPropose->getProposeAroundDate($_POST['date'], $_POST['precision']);
  foreach ($listePropose as $propose) {
    $parcours = $managerParcours->getParcours($propose->getIdParcours());
    $heure = explode(":", $propose->getTime())[0];
    if($_SESSION['direction'] == 0) {
      if($parcours->getVille1() == $_SESSION['vil_depart']
      && $parcours->getVille2() == $_POST['vil_arrive']
      && $heure >= $_POST['temp_depart']) {
        $listeProposeAfficher[] = $propose;
      }
    }
    else {
      if($parcours->getVille1() == $_SESSION['vil_arrive']
      && $parcours->getVille2() == $_POST['vil_depart']
      && $heure >= $_POST['temp_depart']) {
        $listeProposeAfficher[] = $propose;
      }
    }
  }
  if(isset($listeProposeAfficher)) {
  ?>
    <table class="collapseTableau">
      <tr>
        <th>
          Ville départ
        </th>
        <th>
          Ville arrivée
        </th>
        <th>
          Date départ
        </th>
        <th>
          Heure départ
        </th>
        <th>
          Nombre de place(s)
        </th>
        <th>
          Nom du convoitureur
        </th>
      </tr>
      <?php
      foreach($listeProposeAfficher as $proposeAfficher) {
        $ville1 = $managerVille->getVille($_SESSION['vil_depart']);
        $ville2 = $managerVille->getVille($_POST['vil_arrive']);
        $personne = $managerPersonne->getPersonne($proposeAfficher->getIdPersonne());
        $dateFr = getFrenchDate($proposeAfficher->getDate());
        $listeAvis = $managerAvis->getAvis($personne->getId());
        $cptAvis = 0.0;
        $noteAvis = 0.0;
        foreach ($listeAvis as $avis) {
          $cptAvis++;
          $noteAvis += $avis->getNote();
          $dernierCommentaire = $avis->getComm();
        }
        if(!empty($listeAvis)) {
          $moyenneNote = divideFloat($noteAvis, $cptAvis);
        }
        ?>
        <tr>
          <td class="elementTableau2">
            <?php echo $ville1->getNom(); ?>
          </td>
          <td class="elementTableau2">
            <?php echo $ville2->getNom(); ?>
          </td>
          <td class="elementTableau2">
            <?php echo $dateFr; ?>
          </td>
          <td class="elementTableau2">
            <?php echo $proposeAfficher->getTime(); ?>
          </td>
          <td class="elementTableau2">
            <?php echo $proposeAfficher->getPlace(); ?>
          </td>
          <td class="elementTableau2"
          <?php
          if(!empty($listeAvis)) {
          ?>
            id="avis"
            title="Moyenne des avis : <?php echo $moyenneNote ?> Dernier avis : <?php echo $dernierCommentaire ?>"
          <?php
          }
          ?>
          >
            <?php echo $personne->getPrenom().' '.$personne->getNom(); ?>
          </td>
        </tr>
      <?php
      }
      ?>
    </table>
    <?php
  }
  else {
  ?>
    <p>
      <img src="image/erreur.png" />
      Désolé, aucun trajet n'a été trouvé !
    </p>
  <?php
  }
}
?>
