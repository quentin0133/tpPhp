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
                <option value="-1" > Choisissez une personne </option>
                <?php
                foreach($listePersonne as $personne) {
                    ?>
                    <option value='<?php echo $personne->getId(); ?>'>

                        <?php echo strtoupper($personne->getNom()); ?>  <?php echo $personne->getPrenom(); ?>


                    </option>
                <?php }  ?>

            </select>
            <tr>
                <td class="labelAlign"><label>nouveau/ancien Nom:</label></td>
                <td><input type="text" name="per_nom" ></td>
                <td class="labelAlign"><label>nouveau/ancien Prenom:</label></td>
                <td><input type="text" name="per_prenom" ></td>
            </tr>
            <tr>
                <td class="labelAlign"><label>nouveau/ancien Téléphone:</label></td>
                <td><input type="text" name="per_tel" "></td>
                <td class="labelAlign"><label>nouveau/ancien Mail:</label></td>
                <td><input type="text" name="per_mail" ></td>
            </tr>
            <tr>
                <td class="labelAlign"><label>nouveau/ancien Login:</label></td>
                <td><input type="text" name="per_login" ></td>
                <td class="labelAlign"><label>nouveau/ancien Mot de passe:</label></td>
                <td><input type="password" name="per_pwd" ></td>
            </tr>

            <br>



            <tr>
                <td colspan=4>
                    <label>Catégorie:</label>

                    <input type="radio" name="typePersonne" value="etudiant"
                           onclick=" document.getElementById('modifSalarie').style.display='none';
                                          document.getElementById('modifEtudiant').style.display='block';" />
                    <label>Etudiant</label>

                    <input type="radio" name="typePersonne" value="personnel"
                           onclick=" document.getElementById('modifSalarie').style.display='block';
                                          document.getElementById('modifEtudiant').style.display='none';" />
                    <label>Personnel</label>
                </td>
            </tr>



            <div id="modifSalarie">

                    <form action="#" method="post">
                        <label>Téléphone professionel:</label>
                        <input type="text" name="telSalarie">
                        <br>
                        <label>Fonction:</label>
                        <select class="select" name="fonctionSalarie">
                            <?php
                            $listeFonction = $managerFonction->getList();
                            foreach($listeFonction as $fonction) {
                                ?>
                                <option value='<?php echo $fonction->getId(); ?>'>
                                    <?php echo $fonction->getLibelle(); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" value="Valider" />
                    </form>


            </div>



            <div id="modifEtudiant">

                    <form action="#" method="post">
                        <label>Année:</label>
                        <select class="select" name="anneeEtudiant">
                            <?php
                            $listeDivisions = $managerDivision->getList();
                            foreach($listeDivisions as $division) {
                                ?>
                                <option value='<?php echo $division->getId(); ?>'>
                                    <?php echo $division->getNom(); ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        <label>Département:</label>
                        <select class="select" name="departementEtudiant">
                            <?php
                            $listeDepartement = $managerDepartement->getList();
                            foreach($listeDepartement as $departement) {
                                ?>
                                <option value='<?php echo $departement->getId(); ?>'>
                                    <?php
                                    $estDouble = false;
                                    $cpt = 0;
                                    foreach($listeDepartement as $departementVerif) {
                                        if($departement->getNom() == $departementVerif->getNom()) {
                                            $cpt++;
                                        }
                                        if($cpt == 2) {
                                            $estDouble = true;
                                        }
                                    }
                                    if($estDouble) {
                                        $villeDepartement = $managerVille->getVille($departement->getIdVille());
                                        echo $departement->getNom().' ('.$villeDepartement->getNom().')';
                                    }
                                    else {
                                        echo $departement->getNom();
                                    }
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" name="valider" value="Valider" />
                    </form>

            </div>


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