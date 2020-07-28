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
                  if(isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER'])){
                      $myId = (isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : $_COOKIE['ID_USER']);
                      if(isset($_GET['profil'])){
                          foreach (App::getDB()->query('SELECT *
                          FROM users
                          WHERE users.id=' . $myId) as $user):
                          ?>
                          <div class="form-wrapper">
                              <div class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="0.2s"
                                   style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">

                                  <div class="panel panel-skin">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> MODIFIER -
                                              COMPTE<small>(c'est Facile !)</small></h3>
                                      </div>
                                      <div class="panel-body">

                                          <form role="form" id="singUp1" class="contact-form" method="post"
                                                onsubmit="return false;" accept-charset="UTF-8" enctype="multipart/form-data">
                                              <div class="row">
                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="nomSingUp1">Nom *</label>
                                                          <input type="text" name="nomSingUp1" id="nomSingUp1"
                                                                 class="form-control input-md" required="required"
                                                                 placeholder="Nom"
                                                                 value="<?= $user->lastname?>">
                                                          <input type="hidden" name="id3" value="<?= $myId; ?>">
                                                          <em><small id="output_nomSingUp1"></small></em>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="prenomSingUp1">Prenom *</label>
                                                          <input type="text" name="prenomSingUp1" id="prenomSingUp1"
                                                                 class="form-control input-md" required="required"
                                                                 placeholder="Prenom"
                                                                 value="<?= $user->firstname?>">
                                                          <em><small id="output_prenomSingUp"></small></em>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="telSingUp1">Telephone *</label>
                                                          <input type="number" name="telSingUp1" id="telSingUp1"
                                                                 class="form-control input-md" required="required"
                                                                 placeholder="Téléphone"
                                                                 value="<?= $user->phone?>">
                                                          <em><small id="output_telSingUp1"></small></em>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="professionSingUp1">Profession *</label>
                                                          <select id="professionSingUp1" name="professionSingUp1"
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
                                                          <label for="prenomSingUp1">Date de Naissance *</label>
                                                          <input type="date" name="birthSingUp1" id="birthSingUp11"
                                                                 class="form-control input-md" required="required" value="<?= $user->birth?>">
                                                          <em><small id="output_birthSingUp"></small></em>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 col-sm-6 col-md-6"></div>
                                              </div>

                                              <div id="load_data_SingUp" style="text-align: center!important;"></div>

                                              <div class="row">

                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="emailSingUp1">Email *</label>
                                                          <input type="email" name="emailSingUp1" id="emailSingUp1"
                                                                 class="form-control input-md" required="required"
                                                                 placeholder="Email"
                                                                 value="<?= $user->email ?>">
                                                          <em><small id="output_emailSingUp1"></small></em>
                                                      </div>
                                                  </div>

                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="emailConfirmSingUp1">Email de Confirmation *</label>
                                                          <input type="email" name="emailConfirmSingUp1"
                                                                 id="emailConfirmSingUp1" class="form-control input-md"
                                                                 required="required" placeholder="Email de Confirmation"
                                                                 value="<?= $user->email?>">
                                                          <em><small id="output_emailConfirmSingUp1"></small></em>
                                                      </div>
                                                  </div>

                                                  <!--<div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="passwordSingUp1">Mot de passe *</label>
                                                          <input type="password" name="passwordSingUp1" id="passwordSingUp1"
                                                                 class="form-control input-md" required="required"
                                                                 placeholder="Mot de passe"
                                                                 value="<?= $user->password?>">
                                                          <em><small id="output_passwordSingUp1"></small></em>
                                                      </div>
                                                  </div>

                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                          <label for="passwordConfirmSingUp1">Mot de passe de confirmation
                                                              *</label>
                                                          <input type="password" name="passwordConfirmSingUp1"
                                                                 id="passwordConfirmSingUp1" class="form-control input-md"
                                                                 required="required"
                                                                 placeholder="Mot de passe de confirmation"
                                                                 value="<?= $user->password?>">
                                                          <em><small id="output_passwordConfirmSingUp1"></small></em>
                                                      </div>
                                                  </div>-->

                                              </div>

                                              <input id="enreg" type="submit" title="Modification" value="Modification"
                                                     class="btn btn-skin btn-block btn-lg">
                                              </p>

                                          </form>
                                      </div>
                                  </div>

                              </div>
                          </div>
                              <?php
                          endforeach;
                      }  else{
                          foreach (App::getDB()->query('SELECT *
                          FROM users
                          WHERE users.id=' . $myId) as $user):
                          ?>
                          <div class="form-wrapper">
                              <div class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="0.2s"
                                   style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">
                                  <div class="panel panel-skin">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><span class="fa fa-sign-in"></span> Bienvenue <small><?= strtoupper($user->lastname) .' '. strtoupper($user->firstname); ?></small></h3>
                                          <center><img src="img/homme.png" class="img-circle" alt=""></center>
                                      </div>

                                      <div class="panel-body">
                                          <div class="row">
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <p><a href="members.php?profil=profil">Modifier Profil</a></p>
                                                  <p><a href="index.php">Accueil</a></p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                    <?php
                    endforeach;
                      }
                  } else{
                      header('Location: index.php');
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