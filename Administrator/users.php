<?php

require '../Config/Config_Server.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<?php require 'header.php'; ?>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <?php require 'Sidebar.php'; ?>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper" style="padding: initial;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-3"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a></div>

                </div>
                <!-- /#page-content-wrapper -->
                <?php
                if (isset($_GET['modif'])) {
                    foreach (App::getDB()->query('SELECT role.libelle, activity_users.libelle, profession.libelle, users.id, lastname, firstname, birth, 
                                                                                      phone, email, password, etat_compte, users.create_at, users.update_at
                                                                               FROM users
                                                                               INNER JOIN role
                                                                               ON users.role_id=role.id
                                                                               INNER JOIN profession
                                                                               ON users.profession_id=profession.id
                                                                               INNER JOIN activity_users
                                                                               ON users.activity_users_id=activity_users.id
                                                                               WHERE users.id='.$_GET['modif']) as $ccompte):
                        ?>
                        <article class="col-lg-7">
                            <h1>MODIFICATION DES UTILISATEURS</h1>
                            <form id="modif_compte" method="post" accept-charset="UTF-8" action="traitement.php">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="nomSingUp">Nom *</label>
                                                <input type="text" name="nomSingUp" id="nomSingUp"
                                                       class="form-control input-md" required="required"
                                                       placeholder="Nom" value="<?= $ccompte->lastname; ?>">
                                                <input type="hidden" name="id2" value="<?= $ccompte->id; ?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="prenomSingUp">Prenom *</label>
                                                <input type="text" name="prenomSingUp" id="prenomSingUp"
                                                       class="form-control input-md" required="required"
                                                       placeholder="Prenom" value="<?= $ccompte->firstname; ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="professionSingUp">Profession *</label>
                                                <select id="professionSingUp" name="professionSingUp"
                                                        class="form-control">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT id, libelle FROM profession ORDER BY id DESC') as $profession):
                                                        echo '<option value="'.$profession->id.'">'.$profession->libelle.'</option>';
                    endforeach; ?>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="categorie">Categorie *</label>
                                                <select id="categorie" name="categorie"
                                                        class="form-control">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM activity_users ORDER BY id DESC') as $categorie):
                                                        echo '<option value="'.$categorie->id.'">'.$categorie->libelle.'</option>';
                    endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="role_id">Privilèges *</label>
                                                <select id="role_id" name="role_id"
                                                        class="form-control">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM role ORDER BY id DESC') as $role):
                                                        echo '<option value="'.$role->id.'">'.$role->libelle.'</option>';
                    endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="etat_compte">ETAT COMPTE *</label>
                                                <select id="etat_compte" name="etat_compte"
                                                        class="form-control">
                                                    <option value="0">Inactif</option>
                                                    <option value="1">actif</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="prenomSingUp">Date de Naissance *</label>
                                                <input type="date" name="birthSingUp" id="birthSingUp"
                                                       class="form-control input-md" required="required"
                                                       value="<?= $ccompte->birth; ?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="passwordSingUp">Mot de passe *</label>
                                                <input type="password" name="passwordSingUp" id="passwordSingUp"
                                                       class="form-control input-md" required="required"
                                                       placeholder="Mot de passe" value="<?= $ccompte->password; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="telSingUp">Telephone *</label>
                                                <input type="number" name="telSingUp" id="telSingUp"
                                                       class="form-control input-md" required="required"
                                                       placeholder="Téléphone" value="<?= $ccompte->phone; ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="emailSingUp">Email *</label>
                                                <input type="email" name="emailSingUp" id="emailSingUp"
                                                       class="form-control input-md" required="required"
                                                       placeholder="Email" value="<?= $ccompte->email; ?>">
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-12"><input type="submit" value="Envoyer"></div>
                                </div>
                            </form>
                        </article>

                    <?php
                    endforeach;
                } else {
                    if (isset($_GET['supp'])) {
                        App::getDB()->delete('DELETE FROM users WHERE id=:compte', ['compte' => $_GET['supp']]);
                    } ?>
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading"
                                 style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                TABLEAU DE BORD
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th width="2%">LAST NAME</th>
                                            <th width="5%">FIRST NAME</th>
                                            <th width="5%">BIRTH</th>
                                            <th width="5%">PHONE</th>
                                            <th width="5%">EMAIL</th>
                                            <th width="5%">PASSWORD</th>
                                            <th width="5%">ETAT COMPTE</th>
                                            <th width="3%">PROFESSION</th>
                                            <th width="3%">ROLE</th>
                                            <th width="3%">CATEGORY</th>
                                            <th width="1%">DATE_ENREG</th>
                                            <th width="1%">DATE_MODIF</th>
                                            <th width="3%">MODIFIER</th>
                                            <th width="3%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT role.libelle, activity_users.libelle AS descript, profession.libelle AS job, users.id, lastname, firstname, birth, 
                                                                                      phone, email, password, etat_compte, users.create_at, users.update_at
                                                                               FROM users
                                                                               INNER JOIN role
                                                                               ON users.role_id=role.id
                                                                               INNER JOIN profession
                                                                               ON users.profession_id=profession.id
                                                                               INNER JOIN activity_users
                                                                               ON users.activity_users_id=activity_users.id
                                                                               ORDER BY id DESC') as $ccompte):
                                            echo '<tr>
                                                        <td title="ID">'.$ccompte->id.'</td> 
                                                         <td title="LAST NAME">'.$ccompte->lastname.'</td>
                                                        <td title="FIRST NAME">'.$ccompte->firstname.'</td> 
                                                        <td title="BIRTH">'.$ccompte->birth.'</td> 
                                                        <td title="PHONE">'.$ccompte->phone.'</td> 
                                                        <td title="EMAIL">'.$ccompte->email.'</td> 
                                                        <td title="PASSWORD">'.$ccompte->password.'</td> 
                                                        <td title="ETAT COMPTE">'.$ccompte->etat_compte.'</td> 
                                                        <td title="PROFESSION">'.$ccompte->job.'</td> 
                                                        <td title="ROLE">'.$ccompte->libelle.'</td>
                                                        <td title="CATEGORY">'.$ccompte->descript.'</td>
                                                        <td title="DATE_ENREG">'.date('d/m/Y H:m:s', $ccompte->create_at).'</td> 
                                                        <td title="DATE_MODIF">'.date('d/m/Y H:m:s', $ccompte->update_at).'</td>                 
                                                        <td title="MODIFIER"><a href="users.php?modif='.$ccompte->id.'"  class="modifElementTab">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="users.php?supp='.$ccompte->id.'"  class="suppElementTab">SUPPRIMER</a></td>
                                                   </tr>';
                    endforeach; ?>
                                        </tbody>
                                        <!---------------------------------------------------------------------------------------------------------------------------------->
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <?php
                }
                ?>


            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
    $(function () {
        <!-- Menu Toggle Script -->
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    });
</script>

</body>

</html>

