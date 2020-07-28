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
                    <div id="rapport" class="alert alert-danger wow fadeInDown animated" style="display:block;">
                        Veuillez-remplir le champs de saisi
                    </div>
                    <div class="form-wrapper">
                        <div class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="0.2s"
                             style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">
                            <div class="panel panel-skin">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-sign-out"></span> Récuperer mot de passe
                                        <small>C'est Facile !</small></h3>
                                </div>
                                <div class="panel-body">
                                    <div id="SingInForget">
                                        <form role="form" class="" id="getPassword" method="post"
                                              onsubmit="return false;" accept-charset="UTF-8">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="getEmail">Email</label>
                                                        <input type="email" name="getEmail" id="getEmail"
                                                               class="form-control input-md" required="required"
                                                               placeholder="votre Email"
                                                               value="<?php if (isset($_POST['getEmail'])) {
                                                                   echo $_POST['getEmail'];
                                                               } ?>">
                                                        <em><small id="output_getEmail"></small></em>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="sendEmailForget" type="submit" value="Valider"
                                                   class="submit btn btn-skin btn-block btn-lg">
                                            <div id="load_data_getEmail" style="text-align: center!important;"></div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>


            </div>
        </div>
    </div>

</section>
<?php require('footer.php'); ?>
</body>
</html>