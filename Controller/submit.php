<?php
session_start();

if(isset($_SESSION['ID_USER'])) {
    $compte = intval($_SESSION['ID_USER']);
}
else if(isset($_COOKIE['ID_USER'])) {
    $compte = intval($_COOKIE['ID_USER']);
}
else {
    $compte = 0;
}


function nettoieProtect(){

    foreach($_POST as $k => $v){
        $v=strip_tags(trim($v));
        $_POST[$k]=$v;
    }

    foreach($_GET as $k => $v){
        $v=strip_tags(trim($v));
        $_GET[$k]=$v;
    }

    foreach($_REQUEST as $k => $v){
        $v=strip_tags(trim($v));
        $_REQUEST[$k]=$v;
    }

}

// Connexion à la base de données
require '../Config/Config_Server.php';
$connexion = App::getDB();
nettoieProtect();
extract($_POST);

//recuperation de la veritable adresse ip du visiteur
function get_ip(){

    //IP si internet partagé
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }


    //IP derriere un proxy
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    //IP normal
    else{
        return isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
    }
}


// Une fois le formulaire envoyé pour la souscription
if(isset($_GET['singUp'])) {

    if(is_numeric($_POST['nomSingUp'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['nomSingUp'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['prenomSingUp'][0])){
        echo 'Le Prenom doit commencer par une lettre<br>';
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['prenomSingUp'])) {
        echo "Le Prenom est Invalid";
        exit();
    }


    if (!preg_match('/^[0-9-_ ]{9}$/', $_POST['telSingUp'])) {
        echo "Le numéro est Invalid";
        exit();
    }


    /*-------------------------------*/
    if(is_numeric($_POST['emailSingUp'][0])){
        echo 'L\'email doit commencer par une lettre<br>';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['emailSingUp'])) {
        echo "Email Invalid";
        exit();
    }

    /*---------------------------------------------------*/

    if (!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['passwordSingUp'])) {
        echo "password Invalid";
        exit();
    }


    if ($_POST['passwordSingUp'] != $_POST['passwordConfirmSingUp']) {
        echo "Les Mots de Passe sont différents";
        exit();
    }

    $_POST['nomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['nomSingUp'])));
    $_POST['prenomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['prenomSingUp'])));
    $_POST['birthSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['birthSingUp'])));
    $_POST['telSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['telSingUp'])));
    $_POST['emailSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingUp'])));
    $_POST['passwordSingUp'] = stripslashes(htmlspecialchars($_POST['passwordSingUp']));
    $_POST['passwordSingUp'] = sha1($_POST['passwordSingUp']);

    // Connexion à la base de données

    $nbre = $connexion->rowCount('SELECT id FROM users WHERE phone="'.$_POST['telSingUp'].'" 
     OR email="'.$_POST['emailSingUp'].'"');

    if($nbre > 0){
        echo 'numéro ou email déjà utilisé';
        exit;
    }

    else {

        // Génération de la clef d'activation
        $caracteres = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q",
            "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q",
            "R", "S", "T", "U", "V", "W", "X", "Y", "Z", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $caracteres_aleatoires = array_rand($caracteres, 25);
        $clef_activation = "";

        foreach ($caracteres_aleatoires as $i) {
            $clef_activation .= $caracteres[$i];
        }


        nettoieProtect();
        extract($_POST);

        $nbreEmail = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['emailSingUp'].'"');

        // Si une erreur survient
        if($nbreEmail > 0)
        {
            echo "Votre Adresse Email Existe déjà<br/>";
        }
        else
        {
            //$id_forum = $connexion->prepare_request('SELECT id_blog FROM blog', array());
            $connexion->insert('INSERT INTO users(lastname, firstname, birth, phone, email, password, clef_activation, etat_compte, role_id, profession_id, create_at) 
                                      VALUES(?,?,?,?,?,?,?,?,?,?,?)', [$_POST['nomSingUp'], $_POST['prenomSingUp'], $_POST['birthSingUp'], $_POST['telSingUp'],
                $_POST['emailSingUp'], $_POST['passwordSingUp'], $clef_activation, '1', 1, intval($_POST['professionSingUp']),  time()]);

            $max = $connexion->prepare_request('SELECT Max(id) AS max_id FROM users ORDER BY id DESC LIMIT 1 ', array());

                $_SESSION['ID_USER'] = $max['max_id'];
                $_SESSION['EMAIL_USER'] = $_POST['emailSingUp'];


            echo 'success';


            // Envoi du mail d'activation
            $sujet = "Activation de votre compte utilisateur";

            $msg ='
<!doctype html>
<html lang="fr">
<head>
<title>SEARCH</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Insère les mots-clés extraits de la BD dans les meta -->
    <meta name="keywords" lang="fr" content="">
    <!-- Insère la description extraite de la DB dans les meta -->
    <meta name="description" lang="fr" content="">
    <meta name="author" content="bertin.dev, Inc">
    <meta name="copyright" content="© '.date('Y', time()).'", bertin.dev, Inc.">
</head>
<body style=" font-size: 15px; line-height: 1.42857143; font-family: \'Sansation\',\'Trebuchet MS\',Helvetica,Verdana,sans-serif,serif; color: #DDD;background: #2f2f2f url(\'Public/img/background.png\') repeat;">

<header>
    <div style="background-color: #0f6296; height: 5px;"></div>
    <nav role="navigation" style="background-color: #192730; min-height: 50px; margin-bottom: 20px; border: 1px solid transparent;">
       <div style="width: 25%; float: left;"> 
       <img src="https://'.$_SERVER['HTTP_HOST'].'/img/homme.png" alt="Logo" title="Search Enterprise" width="50px">
       <span style="font-size: 9px; position: relative; top: -8px" title="bertin.dev">Bertin</span>
       </div>
        <div style="width: 75%; float:left; font-variant: small-caps"><h1>Search Enterprise</h1></div>
    </nav>
</header>


<div style="text-align: center!important;">
    <h2>Bonjour '.$_POST['prenomSingUp'].' et Bienvenue.</h2>
    <p>Merci de vouloir être régulièrement informé des nouvelles annonces publiées
    </p>
</div>

<div style="background-color: #0f6296; color: white; text-align: center!important; padding: 30px;">
    <p>S\'il vous plait confirmer votre adresse e-mail, pour éviter toute utilisation abusive par des tiers.</p>

    <button type="button" style="display: block;
    float: right;
    position: relative;
    width: auto;
    height: auto;
    padding: 7px 15px;
    margin: 10px 0 15px 0;
    background: #192730;
    text-transform: uppercase;
    text-decoration: none;
    color: #CCC;
    font-size: 12px;
    line-height: inherit;
    border: 1px solid #1b4159;
    -webkit-transition: all .2s;
    -moz-transition: all .2s;
    -o-transition: all .2s;
    transition: all .2s;"
    ">
    <a href="https://'.$_SERVER['HTTP_HOST'].'/Public/index.php?id_page=8&amp;numero_id='.$max['max_id'].'&clef='.$clef_activation.'" role="button" style="color: white">Confirmer l\'adresse e-mail >></a>
    </button>
</div>
<br>
<!--<div style="margin-bottom: 25px; display: block">
    <small>Vous souhaitez réaliser votre projet afin d\'être plus productif dans votre activité, n\'hésiter pas à me contacter. Je reste ouvert à tout heure. </small>
</div>-->

<footer>
        <nav>
                <span style="font-variant: small-caps;" title="Consultant Développeur"><small><em>  © '.date("Y", time()).', bertin.dev, Inc.</em></small></span>
        <span title="Appels Disponible pour tous projets sérieux" style=" float: right; padding: 0; margin: 0;"><small><li style="list-style-type: none;"><em> +237 694 04 89 25</em></li></small></span>
        </nav>
</footer>
</body>
</html>
';

            //echo Send_Email::envoi($_POST['emailSingUp'], $_POST['nomSingUp'], $sujet, $msg, '', '');
            $connexion->delete('DELETE FROM users WHERE create_at <:date_expiration AND etat_compte=:etat', ['date_expiration' => (time() - 172800), 'etat' => 0]);
            /*$connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation)
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Enregistrement partiel', 'index.php', $statut, get_ip(), time()));*/

        }
    }

}


// Une fois le formulaire envoyé pour l'authentification
if(isset($_GET['singIn'])) {

    /*-------------------------------*/
    if(is_numeric($_POST['emailSingIn'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['emailSingIn'])) {
        echo "Email Invalid";
        exit();
    }

    /*---------------------------------------------------*/

    /*if($_POST['passwordSingIn'] < 5 ){
        echo "Trop court (5 caractères Minimum)";
        exit;
    }*/

    if (!preg_match('/^[A-Za-z0-9_-]{4,30}$/', $_POST['passwordSingIn'])) {
        echo "password Invalid";
        exit();
    }

    $_POST['emailSingIn'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingIn'])));
    $_POST['passwordSingIn'] = stripslashes(htmlspecialchars($_POST['passwordSingIn']));
    $_POST['passwordSingIn'] = sha1($_POST['passwordSingIn']);



    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['emailSingIn'].'" AND password="'.$_POST['passwordSingIn'].'" AND etat_compte="1" ');

    if($nbre == 0){
        echo 'Votre Compte n\'existe pas ou alors n\'est pas activé';
        exit;
        }
    else {
        $nbre2 =  $connexion->prepare_request('SELECT role_id FROM users WHERE email=:email AND password=:pwd AND etat_compte=:etat_compte',
            ['email'=>$_POST['emailSingIn'], 'pwd'=>$_POST['passwordSingIn'], 'etat_compte'=>'1']);

        //var_dump($nbre2['role_id']);
        //die();

        if(intval($nbre2['role_id'])==2){

            $connexion->insert('INSERT INTO journal(users_id, libelle, ip, create_at) 
                                               VALUES(?, ?, ?, ?)', array($compte, 'Connexion Administrateur', get_ip(), time()));
            echo 'admin';

        } else{
            $nbre_con =  $connexion->prepare_request('SELECT id, lastname, email, number_login FROM users WHERE email=:email AND password=:pwd AND etat_compte=:etat_compte',
                ['email'=>$_POST['emailSingIn'], 'pwd'=>$_POST['passwordSingIn'], 'etat_compte'=>'1']);

            $connexion->update('UPDATE users SET last_consult=:last_consult, number_login=:nbre_connexion 
        WHERE email=:email AND password=:pwd AND etat_compte=:etat_compte', ['last_consult'=>time(), 'nbre_connexion'=>intval($nbre_con['number_login'])+1, 'email'=>$_POST['emailSingIn'], 'pwd'=>$_POST['passwordSingIn'], 'etat_compte'=>'1']);

            //gestion du checkbox qui est sur l'authentification
            if(isset($_POST['t_and_c']) && $_POST['t_and_c']=='1')
            {
                setcookie('ID_USER', $nbre_con['id'], time() + 30*24*3600, null, null, false, true);
                setcookie('NOM_USER', $nbre_con['lastname'], time() + 30*24*3600, null, null, false, true);
                setcookie('EMAIL_USER', $nbre_con['email'], time() + 30*24*3600, null, null, false, true);
            }
            else{
                $_SESSION['ID_USER'] = $nbre_con['id'];
                $_SESSION['EMAIL_USER'] = $nbre_con['email'];
            }
            $connexion->insert('INSERT INTO journal(users_id, libelle, ip, create_at) 
                                               VALUES(?, ?, ?, ?)', array($compte, 'Connexion utilisateur', get_ip(), time()));
            echo 'success';
        }
    }

}



/* ==========================================================================
SYSTEME DE RECUPERATION DU MOT DE PASSE
   ========================================================================== */
if(isset($_GET['getEmail'])){

    if(is_numeric($_POST['getEmail'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['getEmail'])) {
        echo "Email Invalid";
        exit();
    }
    $_POST['getEmail'] = strtolower(stripslashes(htmlspecialchars($_POST['getEmail'])));

    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['getEmail'].'"');

    if($nbre <= 0){
        echo 'Votre Adresse Email n\'existe pas dans notre base de données';
        exit;
    }

    else {
        //ENVOI D un EMAIL CONTENANT LE MOT DE PASSE ET L ADRESSE EMAIL DANS LA BOITE DU CORRESPONDANT
        echo 'success';
    }
}




// Une fois le formulaire envoyé pour l'enregistrement des informations
if(isset($_GET['detailActivity'])) {

    $msg = '';

    if(is_numeric($_POST['structure_name'][0])){
        $msg = 'Le Nom de la structure doit commencer par une lettre<br/>';
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['structure_name'])) {
        $msg = "Le Nom de la structure est Invalid<br/>";
    }

    /*-------------------------------*/
    if(is_numeric($_POST['responsable_name'][0])){
        $msg = 'Le nom du responsable doit commencer par une lettre<br>';
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['responsable_name'])) {
        $msg = "Le nom du responsable est Invalid<br/>";
    }

    /*-------------------------------*/
    if(is_numeric($_POST['pays'][0])){
        $msg = 'Le pays doit commencer par une lettre<br>';
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['pays'])) {
        $msg = "Le pays est Invalid<br/>";
    }


    /*-------------------------------*/
    if(is_numeric($_POST['ville'][0])){
        $msg = 'La ville doit commencer par une lettre<br>';
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['ville'])) {
        $msg = "La ville est Invalid<br/>";
    }


    /*-------------------------------*/
    if(is_numeric($_POST['quartier'][0])){
        $msg = 'Le quartier doit commencer par une lettre<br>';
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['quartier'])) {
        $msg = "Le quartier est Invalid<br/>";
    }


    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['rue'])) {
        $msg = "La rue est Invalid<br/>";
    }

    /*--------------------------------------------------------------------------------------------------*/

    $_POST['structure_name'] = strtolower(stripslashes(htmlspecialchars($_POST['structure_name'])));
    $_POST['responsable_name'] = strtolower(stripslashes(htmlspecialchars($_POST['responsable_name'])));
    $_POST['pays'] = strtolower(stripslashes(htmlspecialchars($_POST['pays'])));
    $_POST['ville'] = strtolower(stripslashes(htmlspecialchars($_POST['ville'])));
    $_POST['quartier'] = strtolower(stripslashes(htmlspecialchars($_POST['quartier'])));

    $_POST['rue'] = strtolower(stripslashes(htmlspecialchars($_POST['rue'])));
    $_POST['number'] = strtolower(stripslashes(htmlspecialchars($_POST['number'])));
    $_POST['bp'] = strtolower(stripslashes(htmlspecialchars($_POST['bp'])));
    $_POST['website'] = strtolower(($_POST['website']));
    $_POST['date_creation'] = strtolower(($_POST['date_creation']));

    //$_POST['logo'] = strtolower(stripslashes(htmlspecialchars($_POST['logo'])));

    $_POST['type_vehicule'] = strtolower(stripslashes(htmlspecialchars($_POST['type_vehicule'])));


    if(isset($_POST['agent_ravito_carburant1']) && !empty($_POST['agent_ravito_carburant1'])){
        $agent_ravito = strtolower(stripslashes(htmlspecialchars($_POST['agent_ravito_carburant1'])));;
    } else{
        $agent_ravito = strtolower(stripslashes(htmlspecialchars($_POST['agent_ravito_carburant'])));
    }

    $_POST['nombre_pilotes'] = strtolower(stripslashes(htmlspecialchars($_POST['nombre_pilotes'])));
    $_POST['type_avion'] = strtolower(stripslashes(htmlspecialchars($_POST['type_avion'])));



    if(isset($_POST['specialites']) && !empty($_POST['specialites'])){
        $speciality = strtolower(stripslashes(htmlspecialchars($_POST['specialites'])));;
    } else{
        $speciality = strtolower(stripslashes(htmlspecialchars($_POST['specialites1'])));
    }

    $_POST['secteur_activite'] = strtolower(stripslashes(htmlspecialchars($_POST['secteur_activite'])));
    $_POST['statut_juridique'] = strtolower(stripslashes(htmlspecialchars($_POST['statut_juridique'])));
    $_POST['regime_fiscale'] = strtolower(stripslashes(htmlspecialchars($_POST['regime_fiscale'])));

    if(isset($_POST['nombre_etoiles']) && !empty($_POST['nombre_etoiles'])){
        $nbr_etoiles = strtolower(stripslashes(htmlspecialchars($_POST['nombre_etoiles'])));;
    } else{
        $nbr_etoiles = strtolower(stripslashes(htmlspecialchars($_POST['nombre_etoilesH'])));
    }

    $_POST['type_plats'] = strtolower(stripslashes(htmlspecialchars($_POST['type_plats'])));


    if (isset($_FILES['logo']['name']) and !empty($_FILES['logo']['name'])) {
        //on verifi la taille de l'image
        if ($_FILES['logo']['size'] >= 1000) {
            $extensions_valides = array('jpg', 'jpeg', 'png');
            //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
            //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
            //la fonction strtolower($chaine) renvoit la chaine en minuscule
            $extension_upload = strtolower(substr(strrchr($_FILES['logo']['name'], '.'), 1));
            //on verifi si l'extension_uplod est valide

            if (in_array($extension_upload, $extensions_valides)) {
                $id_membre = md5(uniqid(rand(), true));
                $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                //on deplace du serveur au disque dur

                if (move_uploaded_file($_FILES['logo']['tmp_name'], $chemin)) {
                    // La photo est la source
                    if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                        $source = imagecreatefromjpeg($chemin);
                    } else {
                        $source = imagecreatefrompng($chemin);
                    }
                    $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                    $largeur_source = imagesx($source);
                    $hauteur_source = imagesy($source);
                    $largeur_destination = imagesx($destination);
                    $hauteur_destination = imagesy($destination);
                    $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                    // On crée la miniature
                    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                    // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                    imagejpeg($destination, $chemin0);
                    //echo $chemin0;
                } else {
                    $msg = "Aucune image déplacé<br/>";
                }
            } else {
                $msg = "extension de votre image invalide<br/>";
            }
        } else {
            $msg = "taille de votre image invalide<br/>";
        }
    } else {
        $msg = "image indéfinie<br/>";
    }
    

    // Connexion à la base de données

    $nbre1 = $connexion->rowCount('SELECT id FROM detailactivity_users WHERE nom_structure ="'.$_POST['structure_name'].'" 
     AND nom_responsable ="'.$_POST['responsable_name'].'"');

    if($nbre1 > 0){
        $msg = 'le nom de la structure et le responsable existe déjà.<br/>';
    }
    else {

        extract($_POST);

        $nbrePhone  = $connexion->rowCount('SELECT id FROM detailactivity_users WHERE phone ="'.$_POST['number'].'"');

        // Si une erreur survient
        if($nbrePhone > 0)
        {
            $msg = "Votre Numéro Existe déjà<br/>";
        }
        else
        {

          //methode 1 utiliser une API
            //Communincation avec l'api
            //API Url
            $url = 'http://185.247.116.176:9090/api/refdata/save';
            //Initiate cURL.
            $ch = curl_init($url);
            //The JSON data.
            $jsonData = array(
                "categorieReferentiel"=> null,
                "nomStructure" => $_POST['structure_name'],
                "nomPrenomResponsable" => $_POST['responsable_name'],
                "dateCreation" => $_POST['date_creation'],
                "pays" => $_POST['pays'],
                "ville" => $_POST['ville'],
                "quartier"=> $_POST['quartier'],
                "adresse"=> null,
                "rue"=> $_POST['rue'],
                "telephone" => $_POST['number'],
                "siteWeb"=> $_POST['website'],
                "boitePostale" => $_POST['bp'],
                "typeCentreHospitalier" => null,
                "Specialites" => $speciality,
                "nbEtoile" => $nbr_etoiles,
                "typesPlats" => $_POST['type_plats'],
                "secteurActivite" => $_POST['secteur_activite'],
                "statutJuridique" => $_POST['statut_juridique'],
                "régimeFiscal" => null,
                "assureur" => null,
                "Premier" => null,
                "valeurPrime"=> null,
                "dureePrime" => null,
                "typeVéhicule" => $_POST['type_vehicule'],
                "agentRavitoCarburant" => $agent_ravito,
                "typeAvion" => $_POST['type_avion'],
                "nbPilotes" => $_POST['nombre_pilotes'],
                "email" => null
            );
            //Encode the array into JSON.
            $jsonDataEncoded = json_encode($jsonData);
            //Tell cURL that we want to send a POST request.
            curl_setopt($ch, CURLOPT_POST, 1);
            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            //Execute the request
            $result = curl_exec($ch);
            // close the connection, release resources used
            curl_close($ch);

            $data = array(
                'resultat' => $msg,
                'result_api' => $result
            );
            echo json_encode($data);

            //methode 2 utiliser une base de données Locale
            /*$connexion->insert('INSERT INTO detailactivity_users(logo, nom_structure, nom_responsable, pays, ville, quartier,
             rue, phone, bp, web_site, date_creation, type_vehicule, agent_ravito_carburant, type_avion, nombre_pilotes, specialites,
             secteur_activite, statut_juridique, regime_fiscale, nombre_etoiles, type_plats, create_at) 
                                      VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                $chemin, $_POST['structure_name'], $_POST['responsable_name'], $_POST['pays'], $_POST['ville'], $_POST['quartier'],
                $_POST['rue'], $_POST['number'], $_POST['bp'], $_POST['website'], $_POST['date_creation'], $_POST['type_vehicule'], $agent_ravito, $_POST['type_avion'], intval($_POST['nombre_pilotes']), $speciality,
                $_POST['secteur_activite'], $_POST['statut_juridique'], $_POST['regime_fiscale'], intval($nbr_etoiles), $_POST['type_plats'], time()
            ]);

            $max = $connexion->prepare_request('SELECT Max(id) AS max_id FROM detailactivity_users ORDER BY id LIMIT 1', array());

            $connexion->insert('INSERT INTO activity_and_details(activity_users_id, detailactivity_users_id, create_at)
                                         VALUES(?, ?, ?)', [intval($_POST['activity_user']) ,intval($max['max_id']), time()]);

            $connexion->update('UPDATE users SET activity_users_id=:activity_users_id
                                         WHERE id=:id', array('activity_users_id' => intval($_POST['activity_user']), 'id' => intval($compte)));

            $msg = 'success<br>';*/



            //encodage en json des résultats
            /*$data = array(
                'resultat' => $msg
            );
            echo json_encode($data);*/

        }
    }



}




// Une fois le formulaire envoyé pour l'authentification
if(isset($_GET['search'])) {

    //methode 1 utiliser une API
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

    //methode 2 utiliser une base de données Locale
    /*$result = '';
    $_GET['search_contenu'] = htmlentities((stripslashes(htmlspecialchars($_GET['search_contenu']))), ENT_QUOTES);
    $_GET['search_contenu'] = strip_tags(trim($_GET['search_contenu'])); //supprimes balises html et supprime les espaces

    $nbre = $connexion->rowCount('SELECT * FROM detailactivity_users
                                                    WHERE nom_structure LIKE "%'.$_GET['search_contenu'].'%" OR 
                                                          nom_responsable  LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          ville LIKE "%'.$_GET['search_contenu'].'%" OR 
                                                          phone  LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          quartier LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          rue LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          bp LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          web_site LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          pays LIKE "%'.$_GET['search_contenu'].'%" ');


    if($nbre <= 0){
        $result .= 'Aucun';
    }
    else{
        $result .= '<div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <h5>A LA UNE</h5>
                        <div class="card card-cascade narrower">';

        foreach (App::getDB()->query('SELECT * FROM detailactivity_users
                                                    WHERE nom_structure LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          nom_responsable  LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          ville LIKE "%'.$_GET['search_contenu'].'%" OR 
                                                          phone  LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          quartier LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          rue LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          bp LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          web_site LIKE "%'.$_GET['search_contenu'].'%" OR
                                                          pays LIKE "%'.$_GET['search_contenu'].'%"
                                                     ORDER BY id DESC ') AS $article_item):

            $result .= '  <div class="col-lg-12 view view-cascade gradient-card-header purple-gradient">
                                    <div class="col-lg-2 wow fadeInDown animated" data-wow-duration="3s" data-wow-delay="0.3s" style="padding: initial; margin: initial; visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: fadeInDown;">
                                        <img src="';
            $result .= (!empty($article_item->logo)) ? str_replace('../', '', $article_item->logo) : "img/homme.png";
            $result .= '" alt="" width="150" height="150">
                                    </div>
                                    <div class="col-lg-10 wow fadeInDown animated" style="padding: initial; margin: initial; visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: fadeInDown;">
                                        <h4 class="col-lg-12" style="color: #1a0dab; line-height: 1.58; font-size: 20px; margin-top: initial">'. strtoupper($article_item->nom_structure) .'</h4>
                                        <div class="col-lg-12">'. $article_item->nom_responsable .'</div>
                                        <div class="col-lg-12 info">Téléphone: '. $article_item->phone .', BP:'. $article_item->bp .'</div>
                                        <div class="col-lg-12 info">'. $article_item->quartier.', '. $article_item->ville .', '. $article_item->pays .'</div>
                                        <div class="col-lg-12 info"> <a href="'. $article_item->web_site .'" title="'. $article_item->web_site .'">'. $article_item->web_site .' </a></div>
                                        <div class="col-lg-12 info" style="font-style: italic">Posté il y a 3 heures</div>
                                    </div>
                                </div>';
        endforeach;
        $result .= '  </div>
                    </div>
                     <div class="col-lg-2"></div>';


    }
    $data = array (
        'resultat' => $result,
        'compteur' => $nbre,
        'mysearch' => $_GET['search_contenu']
    );
    echo json_encode($data);*/

}


// Une fois le formulaire envoyé pour la modification
if(isset($_GET['singUp1'])) {

    if(is_numeric($_POST['nomSingUp1'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['nomSingUp1'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['prenomSingUp1'][0])){
        echo 'Le Prenom doit commencer par une lettre<br>';
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['prenomSingUp1'])) {
        echo "Le Prenom est Invalid";
        exit();
    }


    if (!preg_match('/^[0-9-_ ]{9}$/', $_POST['telSingUp1'])) {
        echo "Le numéro est Invalid";
        exit();
    }


    /*-------------------------------*/
    if(is_numeric($_POST['emailSingUp1'][0])){
        echo 'L\'email doit commencer par une lettre<br>';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['emailSingUp1'])) {
        echo "Email Invalid";
        exit();
    }

    /*---------------------------------------------------*/

    if (!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['passwordSingUp1'])) {
        echo "password Invalid";
        exit();
    }


    if ($_POST['passwordSingUp1'] != $_POST['passwordConfirmSingUp1']) {
        echo "Les Mots de Passe sont différents";
        exit();
    }

    $_POST['nomSingUp1'] = strtolower(stripslashes(htmlspecialchars($_POST['nomSingUp1'])));
    $_POST['prenomSingUp1'] = strtolower(stripslashes(htmlspecialchars($_POST['prenomSingUp1'])));
    $_POST['birthSingUp1'] = strtolower(stripslashes(htmlspecialchars($_POST['birthSingUp1'])));
    $_POST['telSingUp1'] = strtolower(stripslashes(htmlspecialchars($_POST['telSingUp1'])));
    $_POST['emailSingUp1'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingUp1'])));
    $_POST['passwordSingUp1'] = stripslashes(htmlspecialchars($_POST['passwordSingUp1']));
    $_POST['passwordSingUp1'] = sha1($_POST['passwordSingUp1']);

    // Connexion à la base de données

    $connexion->update('UPDATE users SET lastname=:lastname, firstname=:firstname, birth=:birth,
 phone=:phone, email =:email , password=:password,
                  profession_id=:profession_id, update_at=:update_at 
                    WHERE id=:id',
        array('lastname' => $_POST['nomSingUp1'], 'firstname' => $_POST['prenomSingUp1'], 'birth' => $_POST['birthSingUp1'],
            'phone' => $_POST['telSingUp1'], 'email' => $_POST['emailSingUp1'], 'password' => $_POST['passwordSingUp1'],
            'profession_id' => $_POST['professionSingUp1'], 'update_at' => time(),
            'id' => $_POST['id3']));

    echo 'success';

}