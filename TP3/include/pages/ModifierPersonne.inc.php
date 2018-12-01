<h1>modifier une personne</h1>


<?php
$listePersonne = $managerPersonne->getList();
if (empty($_POST['per_nom']) || empty($_POST['per_prenom']) || empty($_POST['per_tel'])||empty($_POST['per_num1'])
    || empty($_POST['per_mail']) || empty($_POST['per_login']) || empty($_POST['per_pwd'])
) {
    ?>
    <form action="#" method="post" id="formulaire_modifier">

        <b> Sélectionner la personne à modifier : </b>
            <select title="SelectPersonneModifier" class="select" name="per_num1" style="
            width: 205px;">
                <?php
                foreach($listePersonne as $personne) {
                    ?>
                    <option value='<?php echo $personne->getId(); ?>'>

                        <?php echo strtoupper($personne->getNom()).' '.$personne->getPrenom(); ?>


                    </option>
                <?php }  ?>

            </select>


        <table>
            <tr>
                <td>

                </td>
            </tr>

            <tr>
                <td class="labelAlign"><label>nouveau/ancien Nom:</label></td>
                <td><input title="SaisieNouveauNom" type="text" name="per_nom" ></td>
                <td class="labelAlign"><label>nouveau/ancien Prenom:</label></td>
                <td><input title="SaisieNouveauPrenom"  type="text" name="per_prenom" ></td>
            </tr>
            <tr>
                <td class="labelAlign"><label>nouveau/ancien Téléphone:</label></td>
                <td><input title="SaisieNouveauTel" type="text" name="per_tel"></td>
                <td class="labelAlign"><label>nouveau/ancien Mail:</label></td>
                <td><input title="SaisieNouveauMail" type="text" name="per_mail" ></td>
            </tr>
            <tr>
                <td class="labelAlign"><label>nouveau/ancien Login:</label></td>
                <td><input title="SaisieNouveauLogin" type="text" name="per_login" ></td>
                <td class="labelAlign"><label>nouveau/ancien Mot de passe:</label></td>
                <td><input title="SaisieNouveauMDP" type="password" name="per_pwd" ></td>
            </tr>


            <tr>
                <td colspan=4>
                    <label>Catégorie:</label>

                    <input title="RadioBoutonEtudiant" type="radio" name="typePersonne" value="etudiant" checked
                           onchange=" document.getElementById('modifSalarie').style.display='none';
                                          document.getElementById('modifEtudiant').style.display='block';" />
                    <label>Etudiant</label>

                    <input title="RadioBoutonSalarie" type="radio" name="typePersonne" value="personnel"
                           onchange=" document.getElementById('modifSalarie').style.display='block';
                                          document.getElementById('modifEtudiant').style.display='none';" />
                    <label>Personnel</label>
                </td>
            </tr>
        </table>

        <div id="modifSalarie">
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
        </div>
        <div id="modifEtudiant">
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
        </div>
        <input type="submit" value="Valider" />
    </form>
    <?php
}

if (!empty($_POST['per_nom']) && !empty($_POST['per_prenom']) && !empty($_POST['per_tel']) && !empty($_POST['per_num1'])
    && !empty($_POST['per_mail']) && !empty($_POST['per_login'])  && !empty($_POST['per_pwd'])
    ) {


    $res = $managerPersonne->getPersonne($_POST['per_num1']);
    $nomPersonne = $res->getNom();
    $prenomPersonne = $res->getPrenom();

    if(!empty($_POST['telSalarie']) && !empty($_POST['fonctionSalarie'])){
        $newSalarie = new Salarie( array(
            'per_num' => $res->getId(),
            'sal_telprof' => $_POST['telSalarie'],
            'fon_num' => $_POST['fonctionSalarie']
        ));
        $managerEtudiant->delEtudiantPersonne($res->getId());
        $managerSalarie->delSalariePersonne($res->getId());
        $managerSalarie->add($newSalarie);

    }else{

        $newEtudiant = new Etudiant ( array(
            'per_num' => $res->getId(),
            'dep_num' => $_POST['departementEtudiant'],
            'div_num' => $_POST['anneeEtudiant']
        ));
        $managerSalarie->delSalariePersonne($res->getId());
        $managerEtudiant->delEtudiantPersonne($res->getId());
        $managerEtudiant->add($newEtudiant);

    }

    $managerPersonne->modifPers($_POST['per_nom'], $_POST['per_prenom'],
        $_POST['per_mail'], $_POST['per_tel'], $_POST['per_login'], $_POST['per_pwd'].SALT, $_POST['per_num1']);


    ?>
    <p>
        <img src="image/valid.png"/>
        La personne <b> <?php echo  $nomPersonne." ".$prenomPersonne;?> </b>a été modifier
    </p>
    <?php
}
