<?php session_start(); ?>
<?php require 'Config/Config_Server.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<?php require 'head.php' ?>
<body>

<section id="intro" class="intro">

    <div class="intro-content">
        <div class="container">
            <div class="row">

                <div class="col-lg-2"></div>
                <div class="col-lg-8">

                    <div id="rapport" class="alert alert-danger wow fadeInDown animated" style="display:block;">
                        Veuillez-remplir tous les champs
                    </div>
                    <?php
                    if(isset($_COOKIE['ID_USER']) || isset($_SESSION['ID_USER'])){
                        header('Location: index.php');
                    }
                    else{
                        ?>
                        <div class="form-wrapper">
                            <div class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="0.2s"
                                 style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">

                                <div class="panel panel-skin">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Souscription -
                                            ETAPE 1<small>(c'est gratuit !)</small></h3>
                                    </div>
                                    <div class="panel-body">

                                        <form role="form" id="singUp" class="contact-form" method="post"
                                              onsubmit="return false;" accept-charset="UTF-8" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="nomSingUp">Nom *</label>
                                                        <input type="text" name="nomSingUp" id="nomSingUp"
                                                               class="form-control input-md" required="required"
                                                               placeholder="Nom"
                                                               value="<?php if (isset($_POST['nomSingUp'])) {
                                                                   echo $_POST['nomSingUp'];
                                                               } ?>">
                                                        <em><small id="output_nomSingUp"></small></em>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="prenomSingUp">Prenom *</label>
                                                        <input type="text" name="prenomSingUp" id="prenomSingUp"
                                                               class="form-control input-md" required="required"
                                                               placeholder="Prenom"
                                                               value="<?php if (isset($_POST['prenomSingUp'])) {
                                                                   echo $_POST['prenomSingUp'];
                                                               } ?>">
                                                        <em><small id="output_prenomSingUp"></small></em>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="telSingUp">Telephone *</label>
                                                        <input type="number" name="telSingUp" id="telSingUp"
                                                               class="form-control input-md" required="required"
                                                               placeholder="Téléphone"
                                                               value="<?php if (isset($_POST['telSingUp'])) {
                                                                   echo $_POST['telSingUp'];
                                                               } ?>">
                                                        <em><small id="output_telSingUp"></small></em>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="professionSingUp">Profession *</label>
                                                        <select id="professionSingUp" name="professionSingUp"
                                                                class="form-control">
                                                            <?php
                                                            foreach (App::getDB()->query('SELECT id, libelle FROM profession ORDER BY id DESC') as $profession):
                                                                echo '<option value="' . $profession->id . '">' . $profession->libelle . '</option>';
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="prenomSingUp">Date de Naissance *</label>
                                                        <input type="date" name="birthSingUp" id="birthSingUp"
                                                               class="form-control input-md" required="required">
                                                        <em><small id="output_birthSingUp"></small></em>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6"></div>
                                            </div>

                                            <div id="load_data_SingUp" style="text-align: center!important;"></div>

                                            <div class="row">

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailSingUp">Email *</label>
                                                        <input type="email" name="emailSingUp" id="emailSingUp"
                                                               class="form-control input-md" required="required"
                                                               placeholder="Email"
                                                               value="<?php if (isset($_POST['emailSingUp'])) {
                                                                   echo $_POST['emailSingUp'];
                                                               } ?>">
                                                        <em><small id="output_emailSingUp"></small></em>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailConfirmSingUp">Email de Confirmation *</label>
                                                        <input type="email" name="emailConfirmSingUp"
                                                               id="emailConfirmSingUp" class="form-control input-md"
                                                               required="required" placeholder="Email de Confirmation"
                                                               value="<?php if (isset($_POST['emailConfirmSingUp'])) {
                                                                   echo $_POST['emailConfirmSingUp'];
                                                               } ?>">
                                                        <em><small id="output_emailConfirmSingUp"></small></em>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passwordSingUp">Mot de passe *</label>
                                                        <input type="password" name="passwordSingUp" id="passwordSingUp"
                                                               class="form-control input-md" required="required"
                                                               placeholder="Mot de passe"
                                                               value="<?php if (isset($_POST['passwordSingUp'])) {
                                                                   echo $_POST['passwordSingUp'];
                                                               } ?>">
                                                        <em><small id="output_passwordSingUp"></small></em>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passwordConfirmSingUp">Mot de passe de confirmation
                                                            *</label>
                                                        <input type="password" name="passwordConfirmSingUp"
                                                               id="passwordConfirmSingUp" class="form-control input-md"
                                                               required="required"
                                                               placeholder="Mot de passe de confirmation"
                                                               value="<?php if (isset($_POST['passwordConfirmSingUp'])) {
                                                                   echo $_POST['passwordConfirmSingUp'];
                                                               } ?>">
                                                        <em><small id="output_passwordConfirmSingUp"></small></em>
                                                    </div>
                                                </div>

                                            </div>

                                            <input id="enreg" type="submit" title="Souscription" value="Souscription"
                                                   class="btn btn-skin btn-block btn-lg">

                                            <p class="lead-footer"><a href="login.php" title="se connecter">Se connecter</a>
                                            </p>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-2"></div>


            </div>
        </div>
    </div>

</section>
<?php require('footer.php'); ?>
</body>
</html>