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

                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <?php
                    if(isset($_COOKIE['ID_USER']) || isset($_SESSION['ID_USER'])){
                        ?>
        
                   <script> location.replace("members.php"); </script>
                        <?php
                    } else{
                        ?>
                        <div id="rapport" class="alert alert-danger wow fadeInDown animated" style="display:block;">
                            Veuillez-remplir tous les champs
                        </div>
                        <div class="form-wrapper">
                            <div class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="0.2s"
                                 style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">
                                <div class="panel panel-skin">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><span class="fa fa-sign-in"></span> SE CONNECTER <small>C'est
                                                Facile !</small></h3>
                                    </div>

                                    <div class="panel-body">
                                        <form role="form" id="singIn" class="" method="post" onsubmit="return false;"
                                              accept-charset="UTF-8">
                                            <div id="SingInForm">

                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="emailSingIn">Email *</label>
                                                            <input type="email" name="emailSingIn" id="emailSingIn"
                                                                   class="form-control input-md" required="required"
                                                                   placeholder="Email"
                                                                   value="<?php if (isset($_POST['emailSingIn'])) {
                                                                       echo $_POST['emailSingIn'];
                                                                   } ?>">
                                                            <em><small id="output_emailSingIn"></small></em>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="load_data_SingIn" style="text-align: center!important;"></div>


                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="passwordSingIn">Mot de passe *</label>
                                                            <input type="password" name="passwordSingIn" id="passwordSingIn"
                                                                   class="form-control input-md" required="required"
                                                                   placeholder="Mot de passe"
                                                                   value="<?php if (isset($_POST['passwordSingIn'])) {
                                                                       echo $_POST['passwordSingIn'];
                                                                   } ?>">
                                                            <em><small id="output_passwordSingIn"></small></em>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input id="enreg_connexion" type="submit" value="Connexion"
                                                       title="Connectez-vous" class="submit btn btn-skin btn-block btn-lg"
                                                       style="margin-bottom: 20px">

                                                <p class="col-xs-12 col-sm-12 col-md-12">
                                                <span class="lead-footer" style="float: left"><input type="checkbox"
                                                                                                     name="t_and_c"
                                                                                                     id="t_and_c"
                                                                                                     value="1"> Restez-Connecté ! </span>&nbsp
                                                    &nbsp &nbsp &nbsp
                                                    <span class="lead-footer" style="float: right"><a href="reset.php"
                                                                                                      title="Initialiser mot de passe">mot de passe oublié ?</a></span>
                                                </p>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="col-lg-3"></div>


            </div>
        </div>
    </div>

</section>
<?php require('footer.php'); ?>
</body>
</html>