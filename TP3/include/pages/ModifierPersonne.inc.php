<h1>modifier une personne</h1>
<?php


$listePersonne = $managerPersonne->getList();


 if (empty($_POST['per_nom']) || empty($_POST['per_prenom']) || empty($_POST['per_tel'])||empty($_POST['per_num1'])
        || empty($_POST['per_mail']) || empty($_POST['per_login']) || empty($_POST['per_pwd'])) {
    ?>




        <form action="#" method="post" id="formulaire_modifier">
            <table>
                <tr>

                </tr>
                    <label> Sélectionner la personne à modifier : </label>
                    <select class="select" name="per_num1" style="
                    width: 205px;
                    ">
                        <option value="-1" onChange='document.getElementById("formulaire_modifier").submit()'> Choisissez une personne </option>
                        <?php

                        foreach($listePersonne as $personne) {
                            ?>
                            <option value='<?php echo $personne->getId(); ?>'>

                                <?php echo strtoupper($personne->getNom()); ?>  <?php echo $personne->getPrenom(); ?>


                            </option>
                            <?php
                            $_SESSION['nomPersonne']=$personne->getNom();
                            $_SESSION['prenomPersonne']=$personne->getPrenom();
                            $_SESSION['mailPersonne']=$personne->getMail();
                            $_SESSION['telPersonne']=$personne->getTel();
                            $_SESSION['loginPersonne']=$personne->getLogin();
                            $_SESSION['pwdPersonne']=$personne->getMdp();
                        }
                        ?>
                    </select>
                <tr>
                    <td class="labelAlign"><label>nouveau/ancien Nom:</label></td>
                    <td><input type="text" name="per_nom" value="<?php $_SESSION['nomPersonne'] ?>"></td>
                    <td class="labelAlign"><label>nouveau/ancien Prenom:</label></td>
                    <td><input type="text" name="per_prenom" value="<?php $_SESSION['prenomPersonne'] ?>"></td>
                </tr>
                <tr>
                    <td class="labelAlign"><label>nouveau/ancien Téléphone:</label></td>
                    <td><input type="text" name="per_tel" value="<?php $_SESSION['telPersonne'] ?>"></td>
                    <td class="labelAlign"><label>nouveau/ancien Mail:</label></td>
                    <td><input type="text" name="per_mail" value="<?php $_SESSION['mailPersonne'] ?>"></td>
                </tr>
                <tr>
                    <td class="labelAlign"><label>nouveau/ancien Login:</label></td>
                    <td><input type="text" name="per_login" value="<?php $_SESSION['loginPersonne'] ?>"></td>
                    <td class="labelAlign"><label>nouveau/ancien Mot de passe:</label></td>
                    <td><input type="password" name="per_pwd" ></td>
                </tr>
                <tr>
                <td colspan=4>
                    <input type="submit" value="Valider"/>
                </td>
                </tr>
            </table>
        </form>

        </select>
        <?php

    }



if (!empty($_POST['per_nom']) && !empty($_POST['per_prenom']) && !empty($_POST['per_tel']) && !empty($_POST['per_num1'])
    && !empty($_POST['per_mail']) && !empty($_POST['per_login']) && !empty($_POST['per_pwd'])) {


    $res = $managerPersonne->getPersonne($_POST['per_num1']);

    $nomPersonne = $res->getNom();
    $prenomPersonne = $res->getPrenom();
    $managerPersonne->modifPers($_POST['per_nom'], $_POST['per_prenom'],
        $_POST['per_mail'], $_POST['per_tel'], $_POST['per_login'], $_POST['per_pwd'].SALT, $_POST['per_num1']);
    ?>
    <p>
        <img src="image/valid.png"/>
        La personne <b> <?php echo  $nomPersonne." ".$prenomPersonne;?> </b>a été modifier
    </p>
    <?php
}

?>

