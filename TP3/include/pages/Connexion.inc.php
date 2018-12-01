<h1>Pour vous connecter</h1>
<?php
  $nombreCaptcha1 = rand(1, 9);
  $nombreCaptcha2 = rand(1, 9);
  if(!empty($_POST['login']) && !empty($_POST['mdp']) && !empty($_POST['captcha'])) {
    if($_POST['captcha'] == ($_POST['nombreCaptcha1'] + $_POST['nombreCaptcha2'])) {
      $estReussiCaptcha = true;
    }
    else {
    ?>
      <p>Le captcha est erroné !</p>
      <?php
      $estReussiCaptcha = false;
      $nombreCaptcha1 = rand(1, 9);
      $nombreCaptcha2 = rand(1, 9);
    }
    if($estReussiCaptcha) {
      $listePersonne = $managerPersonne->getList();
      foreach ($listePersonne as $personne) {
        if($_POST['login'] == $personne->getLogin() && ($_POST['mdp'].SALT) == $personne->getMdp()) {
          $_SESSION['estConnecte'] = $personne;
          header('Location: index.php?page=0');
      		exit();
        }
      }
      if(!isset($_SESSION['estConnecte']))
      {
      ?>
        <p>Le login et/ou le mot de passe est/sont erroné(s) !</p>
      <?php
      }
    }
  }
?>
<form action="#" method="post">
  <input type="hidden" name="nombreCaptcha2" value="<?php echo $nombreCaptcha1 ?>" />
  <input type="hidden" name="nombreCaptcha1" value="<?php echo $nombreCaptcha2 ?>" />
  <label>Nom d'utilisateur:</label>
  <br>
  <input title="ConnexionNomUtilisateur" type="text" name="login">
    <br>
  <label>Mot de passe:</label>
    <br>
  <input title="ConnexionMDP" type="password" name="mdp">
    <br>
  <label id="captcha">
  <?php
    switch ($nombreCaptcha1) {
      case 1:
        ?>
        <img src="image/nb/1.jpg">
        <?php
        break;
      case 2:
        ?>
        <img src="image/nb/2.jpg">
        <?php
        break;
      case 3:
        ?>
        <img src="image/nb/3.jpg">
        <?php
        break;
      case 4:
        ?>
        <img src="image/nb/4.jpg">
        <?php
        break;
      case 5:
        ?>
        <img src="image/nb/5.jpg">
        <?php
        break;
      case 6:
        ?>
        <img src="image/nb/6.jpg">
        <?php
        break;
      case 7:
        ?>
        <img src="image/nb/7.jpg">
        <?php
        break;
      case 8:
        ?>
        <img src="image/nb/8.jpg">
        <?php
        break;
      case 9:
        ?>
        <img src="image/nb/9.jpg">
        <?php
        break;
    }
    ?>
    +
    <?php
    switch ($nombreCaptcha2) {
      case 1:
        ?>
        <img src="image/nb/1.jpg">
        <?php
        break;
      case 2:
        ?>
        <img src="image/nb/2.jpg">
        <?php
        break;
      case 3:
        ?>
        <img src="image/nb/3.jpg">
        <?php
        break;
      case 4:
        ?>
        <img src="image/nb/4.jpg">
        <?php
        break;
      case 5:
        ?>
        <img src="image/nb/5.jpg">
        <?php
        break;
      case 6:
        ?>
        <img src="image/nb/6.jpg">
        <?php
        break;
      case 7:
        ?>
        <img src="image/nb/7.jpg">
        <?php
        break;
      case 8:
        ?>
        <img src="image/nb/8.jpg">
        <?php
        break;
      case 9:
        ?>
        <img src="image/nb/9.jpg">
        <?php
        break;
    }
  ?>
  =
  </label>
    <br>
  <input title="captcha" type="text" name="captcha">
    <br>
  <input type="submit" value="Valider">
</form>
