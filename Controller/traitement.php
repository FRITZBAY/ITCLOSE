<?php

require '../Config/Config_Server.php';
$connexion = App::getDB();

function nettoieProtect()
{

    foreach ($_POST as $k => $v) {
        $v = strip_tags(trim($v));
        $_POST[$k] = $v;
    }

    foreach ($_GET as $k => $v) {
        $v = strip_tags(trim($v));
        $_GET[$k] = $v;
    }

    foreach ($_REQUEST as $k => $v) {
        $v = strip_tags(trim($v));
        $_REQUEST[$k] = $v;
    }

}

/* ==========================================================================
SYSTEME DE VERIFICATION DU FORMULAIRE INSCRIPTION
   ========================================================================== */
if (isset($_GET['singUp'])) {
    if (isset($_POST['nomSingUp'])) {

        nettoieProtect();
        extract($_POST);
        $nomSingUp = preg_replace('#[^a-z0-9-_ ]#i', '', $nomSingUp); //filter everything

        if (strlen($nomSingUp) < 4 || strlen($nomSingUp) > 50) {
            echo '<br>Le Nom est compris entre 3 et 50 caractères';
            exit;
        }

        if (is_numeric($nomSingUp[0])) {
            echo '<br>Le Nom doit commencer par une lettre';
            exit;
        }

        $nbre = $connexion->rowCount('SELECT id FROM users WHERE lastname="' . $nomSingUp . '"');
        if ($nbre > 0) {
            echo '<br> Ce Nom est déjà utilisé';
            exit;
        } else {
            echo 'success';
        }
    }

    if (isset($_POST['prenomSingUp'])) {

        nettoieProtect();
        extract($_POST);
        $prenomSingUp = preg_replace('#[^a-z0-9-_ ]#i', '', $prenomSingUp); //filter everything

        if (strlen($prenomSingUp) < 4 || strlen($prenomSingUp) > 50) {
            echo '<br>Le Prenom est compris entre 3 et 50 caractères';
            exit;
        }

        if (is_numeric($prenomSingUp[0])) {
            echo '<br>Le Prenom doit commencer par une lettre';
            exit;
        }

        /*$nbre = $connexion->rowCount('SELECT id FROM users WHERE firstname="'.$prenomSingUp.'"');
        if($nbre > 0){
            echo '<br> Ce Prenom est déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }*/

        echo 'success';
    }


    if (isset($_POST['birthSingUp'])) {

        nettoieProtect();
        extract($_POST);
        //$birthSingUp = preg_replace('#[^a-z0-9-_ ]#i', '', $birthSingUp);

        /*if(YEAR($birthSingUp) < 1990 ){
            echo '<br>La date de naissance est compris entre 1990 et 2020 caractères';
            exit;
        }*/

        echo 'success';

    }


    if (isset($_POST['telSingUp'])) {

        nettoieProtect();
        extract($_POST);
        $telSingUp = preg_replace('#[^0-9-_ ]#i', '', $telSingUp); //filter everything

        if (strlen($_POST['telSingUp']) < 9 || strlen($_POST['telSingUp']) > 14) {
            echo '<br>Le numéro de téléphone doit avoir minimun 9 chiffres';
            exit;
        }

        if (!is_numeric($telSingUp[0])) {
            echo '<br>votre téléphone doit être en chiffre';
            exit;
        }

        $nbre = $connexion->rowCount('SELECT id FROM users WHERE phone="' . $telSingUp . '"');
        if ($nbre > 0) {
            echo '<br> Ce numéro est déjà utilisé';
            exit;
        } else {
            echo 'success';
        }
    }

    if (isset($_POST['emailSingUp'])) {

        nettoieProtect();
        extract($_POST);

        if (strlen($_POST['emailSingUp']) < 4 || strlen($_POST['emailSingUp']) > 50) {
            echo '<br>L\'adresse Email est compris entre 3 et 50 caractères';
            exit;
        }

        if (is_numeric($_POST['emailSingUp'][0])) {
            echo '<br>L\'adresse email doit commencer par une lettre';
            exit;
        }

        if (!filter_var($_POST['emailSingUp'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }


        $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="' . $_POST['emailSingUp'] . '"');
        if ($nbre > 0) {
            echo '<br> Cet Email est déjà utilisé';
            exit;
        } else {
            echo 'success';
        }
    }


    if (isset($_POST['emailSingUp']) && isset($_POST['passwordSingUp'])) {

        nettoieProtect();
        extract($_POST);


        if (strlen($passwordConfirmSingUp) < 5 || strlen($passwordSingUp) < 5) {
            echo '<br>Trop court (5 caractères Minimum)';
            exit;
        }

        if ($passwordConfirmSingUp != $passwordSingUp) {
            echo '<br>Les deux mots de passe sont différents';
            exit;
        } else {
            echo 'success';
        }
    }

    if (isset($_POST['passwordConfirmSingUp']) && isset($_POST['passwordSingUp'])) {

        nettoieProtect();
        extract($_POST);
        /* $passwordConfirmSingUp = preg_replace('#[^a-z0-9]#i', '', $passwordConfirmSingUp); //filter everything
         $monfichier = fopen("password.txt", "r+");
         $mdp = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
         fclose($monfichier);*/


        if (strlen($passwordConfirmSingUp) < 5 || strlen($passwordSingUp) < 5) {
            echo '<br>Trop court (5 caractères Minimum)';
            exit;
        }

        if ($passwordConfirmSingUp != $passwordSingUp) {
            echo '<br>Les deux mots de passe sont différents';
            exit;
        } else {
            echo 'success';
        }
    }
}


/* ==========================================================================
SYSTEME DE VERIFICATION DU FORMULAIRE D'AUTHENTIFICATION
   ========================================================================== */
if (isset($_GET['singIn'])) {
    if (isset($_POST['emailSingIn'])) {

        nettoieProtect();
        extract($_POST);

        if (strlen($_POST['emailSingIn']) < 4 || strlen($_POST['emailSingIn']) > 50) {
            echo '<br>L\'adresse Email est compris entre 3 et 50 caractères';
            exit;
        }

        if (is_numeric($_POST['emailSingIn'][0])) {
            echo '<br>L\'adresse email doit commencer par une lettre';
            exit;
        }

        if (!filter_var($_POST['emailSingIn'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }


        //$connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="' . $_POST['emailSingIn'] . '"');
        if ($nbre <= 0) {
            echo '<br>Votre Email n\'existe pas';
            exit;
        } else {
            echo 'success';
        }
    }


    /*if (isset($_POST['passwordSingIn'])) {

        nettoieProtect();
        extract($_POST);
        $passwordSingIn = preg_replace('#[^a-z0-9_-]#i', '', $passwordSingIn); //filter everything
        // Connexion à la base de données

        $connexion = App::getDB();
        if (strlen($passwordSingIn) < 4 || strlen($passwordSingIn) > 30) {
            echo '<br>Le Mot de Passe est compris entre 4 et 30 caractères';
            exit;
        }

        $passwordSingIn = sha1($passwordSingIn);
        $nbre = $connexion->rowCount('SELECT id FROM users WHERE password="' . $passwordSingIn . '"');
        if ($nbre <= 0) {
            echo '<br>Ce Mot de Passe n\'existe pas';
            exit;
        } else {
            echo 'success';
        }
    }*/

}


/* ==========================================================================
SYSTEME DE RECUPERATION DU MOT DE PASSE
   ========================================================================== */
if (isset($_GET['getEmail'])) {

    if (isset($_POST['getEmail'])) {

        nettoieProtect();
        extract($_POST);

        if (strlen($_POST['getEmail']) < 4 || strlen($_POST['getEmail']) > 50) {
            echo '<br>L\'adresse Email est compris entre 3 et 50 caractères';
            exit;
        }

        if (!filter_var($_POST['getEmail'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }

        //$connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="' . $_POST['getEmail'] . '"');
        if ($nbre <= 0) {
            echo '<br>Votre Adresse Email n\'existe pas dans nos données';
            exit;
        } else {
            echo 'success';
        }
    }
}


/* ==========================================================================
SYSTEME DE GESTION DE RECHERCHES INSTANTANEES
========================================================================== */

if (isset($_GET['search_contenu'])) {

    //Communincation avec l'api
    $result = '';
    $_GET['search_contenu'] = htmlentities((stripslashes(htmlspecialchars($_GET['search_contenu']))), ENT_QUOTES);
    $_GET['search_contenu'] = strip_tags(trim($_GET['search_contenu'])); //supprimes balises html et supprime les espaces

    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,'http://185.247.116.176:9090/api/refdata/filter/'.$_GET['search_contenu']);
     //Set the GET method by giving 0 value and for POST set as 1
     //curl_setopt($curl_handle, CURLOPT_POST, 0);
    curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $query = curl_exec($curl_handle);
    $data = json_decode($query, true);
    curl_close($curl_handle);


   if(empty($data)){
       $result .= 'Aucun';
   } else{
       if (count($data)!=0) {

           $result .= '<div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <h5><strong>A LA UNE</strong></h5>
                        <div class="card card-cascade narrower">';

           for($i=0; $i<count($data);$i++){

               $result .= '  <div class="col-lg-12 view view-cascade gradient-card-header purple-gradient">
                                    <div class="col-lg-2 wow fadeInDown animated" data-wow-duration="3s" data-wow-delay="0.3s" style="padding: initial; margin: initial; visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: fadeInDown;">
                                        <img src="';
               $result .= "img/homme.png";
               $result .= '" alt="" width="150" height="150">
                                    </div>
                                    <div class="col-lg-10 wow fadeInDown animated" style="padding: initial; margin: initial; visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: fadeInDown;">
                                        <h4 class="col-lg-12" style="color: #1a0dab; line-height: 1.58; font-size: 20px; margin-top: initial">' . strtoupper($data[$i]["nomStructure"]) . '</h4>
                                        <!--<h4 class="col-lg-12" style="color: #1a0dab; line-height: 1.58; font-size: 20px; margin-top: initial">' . strtoupper($data[$i]["nomStructure"]) . '</h4>-->
                                        <div class="col-lg-12 info">Nom du Responsable: <strong>' . $data[$i]["nomPrenomResponsable"] . '</strong></div>
                                         <div class="col-lg-12 info">Pays: ' . $data[$i]["pays"] . '</div>
                                        <div class="col-lg-12 info">Ville: ' . $data[$i]["ville"] . '</div>
                                        <div class="col-lg-12 info">Spécialité: ' . $data[$i]["specialites"] . '</div>
                                        <div class="col-lg-12 info">Quartier: ' . $data[$i]["quartier"] . '</div>
                                        <div class="col-lg-12 info">Téléphone: ' . $data[$i]["telephone"] . '</div>
                                        <div class="col-lg-12 info">BP: ' . $data[$i]["boitePostale"] . '</div>
                                        <div class="col-lg-12 info"> <a href="' . $data[$i]["siteWeb"] . '" title="' . $data[$i]["siteWeb"] . '">' . $data[$i]["siteWeb"] . ' </a></div>
                                        <div class="col-lg-12 info" style="font-style: italic">Créee le '. $data[$i]["dateCreation"] .'</div>
                                    </div>
                                </div>';
           }
           $result .= '  </div>
                    </div>
                     <div class="col-lg-2"></div>';

       }
       else {
           $result .= 'Aucun';
       }
   }

    $data1 = array(
        'resultat' => $result,
        'compteur' => isset($data) ? count($data) : 0,
        'mysearch' => $_GET['search_contenu']
    );
    echo json_encode($data1);




    /*$result = '';
    $_GET['search_contenu'] = htmlentities((stripslashes(htmlspecialchars($_GET['search_contenu']))), ENT_QUOTES);
    $_GET['search_contenu'] = strip_tags(trim($_GET['search_contenu'])); //supprimes balises html et supprime les espaces
    //$connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT * FROM detailactivity_users
                                                    WHERE nom_structure LIKE "%' . $_GET['search_contenu'] . '%" OR 
                                                          nom_responsable  LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          ville LIKE "%' . $_GET['search_contenu'] . '%" OR 
                                                          phone  LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          quartier LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          rue LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          bp LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          web_site LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          pays LIKE "%' . $_GET['search_contenu'] . '%" ');

    if ($nbre <= 0) {
        $result .= 'Aucun';
    } else {
        $result .= '<div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <h5><strong>A LA UNE</strong></h5>
                        <div class="card card-cascade narrower">';

        foreach (App::getDB()->query('SELECT * FROM detailactivity_users
                                                    WHERE nom_structure LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          nom_responsable  LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          ville LIKE "%' . $_GET['search_contenu'] . '%" OR 
                                                          phone  LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          quartier LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          rue LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          bp LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          web_site LIKE "%' . $_GET['search_contenu'] . '%" OR
                                                          pays LIKE "%' . $_GET['search_contenu'] . '%"
                                                     ORDER BY id DESC ') as $article_item):

            $result .= '  <div class="col-lg-12 view view-cascade gradient-card-header purple-gradient">
                                    <div class="col-lg-2 wow fadeInDown animated" data-wow-duration="3s" data-wow-delay="0.3s" style="padding: initial; margin: initial; visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: fadeInDown;">
                                        <img src="';
            $result .= (!empty($article_item->logo)) ? str_replace('../', '', $article_item->logo) : "img/homme.png";
            $result .= '" alt="" width="150" height="150">
                                    </div>
                                    <div class="col-lg-10 wow fadeInDown animated" style="padding: initial; margin: initial; visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: fadeInDown;">
                                        <h4 class="col-lg-12" style="color: #1a0dab; line-height: 1.58; font-size: 20px; margin-top: initial">' . strtoupper($article_item->nom_responsable) . '</h4>
                                        <!--<h4 class="col-lg-12" style="color: #1a0dab; line-height: 1.58; font-size: 20px; margin-top: initial">' . strtoupper($article_item->nom_structure) . '</h4>-->
                                        <div class="col-lg-12 info">Pays: ' . $article_item->pays . '</div>
                                        <div class="col-lg-12 info">Ville: ' . $article_item->ville . '</div>
                                        <div class="col-lg-12 info">Spécialité: ' . $article_item->specialites . '</div>
                                        <div class="col-lg-12 info">Quartier: ' . $article_item->quartier . '</div>
                                        <div class="col-lg-12 info">Téléphone: ' . $article_item->phone . '</div>
                                        <div class="col-lg-12 info">BP: ' . $article_item->bp . '</div>
                                        <div class="col-lg-12 info"> <a href="' . $article_item->web_site . '" title="' . $article_item->web_site . '">' . $article_item->web_site . ' </a></div>
                                        <div class="col-lg-12 info" style="font-style: italic">Posté le '. date("d/m/Y, h:i:s", $article_item->create_at) .'</div>
                                    </div>
                                </div>';
        endforeach;
        $result .= '  </div>
                    </div>
                     <div class="col-lg-2"></div>';


    }
    $data = array(
        'resultat' => $result,
        'compteur' => $nbre,
        'mysearch' => $_GET['search_contenu']
    );
    echo json_encode($data);*/

}

