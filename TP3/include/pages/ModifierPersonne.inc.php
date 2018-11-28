<h1>modifier une personne</h1>
<?php


$listePersonne = $managerPersonne->getList();


 if (empty($_POST['per_nom']) && empty($_POST['per_prenom']) && empty($_POST['per_tel']) && empty($_POST['per_num1'])
        && empty($_POST['per_mail']) && empty($_POST['per_login']) && empty($_POST['per_pwd'])) {
    ?>




        <form action="#" method="post">
            <table>
                <tr>

                </tr>
                    <label> Sélectionner la personne à modifier : </label>
                    <select class="select" name="per_num1" style="
                    width: 205px;
                    ">
                        <?php

                        foreach($listePersonne as $personne) {
                            ?>
                            <option value='<?php echo $personne->getId(); ?>'>

                                <?php echo strtoupper($personne->getNom()); ?>  <?php echo $personne->getPrenom(); ?>
                            </option>
                            <?php


                        }
                        ?>
                    </select>
                <tr>
                    <td class="labelAlign"><label>nouveau/ancien Nom:</label></td>
                    <td><input type="text" name="per_nom"></td>
                    <td class="labelAlign"><label>nouveau/ancien Prenom:</label></td>
                    <td><input type="text" name="per_prenom"></td>
                </tr>
                <tr>
                    <td class="labelAlign"><label>nouveau/ancien Téléphone:</label></td>
                    <td><input type="text" name="per_tel"></td>
                    <td class="labelAlign"><label>nouveau/ancien Mail:</label></td>
                    <td><input type="text" name="per_mail"></td>
                </tr>
                <tr>
                    <td class="labelAlign"><label>nouveau/ancien Login:</label></td>
                    <td><input type="text" name="per_login"></td>
                    <td class="labelAlign"><label>nouveau/ancien Mot de passe:</label></td>
                    <td><input type="password" name="per_pwd"></td>
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
        $_POST['per_mail'], $_POST['per_tel'], $_POST['per_login'], $_POST['per_pwd'], $_POST['per_num1']);
    ?>
    <p>
        <img src="image/valid.png"/>
        La personne <b> <?php echo  $nomPersonne." ".$prenomPersonne;?> </b>a été modifier
    </p>
    <?php
}

?>

