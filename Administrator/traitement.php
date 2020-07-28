<?php
session_start();
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


$message = '';
$success = '';
$i = 0;

// Connexion à la base de données
require '../Config/Config_Server.php';


//GESTION DES MODIFICATIONS APPORTEES A UN COMPTE
if (isset($_POST['id'])) {


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
                    echo "Aucune image déplacé";
                }
            } else {
                echo "extension de votre image invalide";
            }
        } else {
            echo "taille de votre image invalide";
        }
    } else {
        echo "image indéfinie";
    }


    App::getDB()->update('UPDATE detailactivity_users SET logo=:logo, nom_structure=:nom_structure, nom_responsable=:nom_responsable,
 pays=:pays, ville=:ville, quartier=:quartier,
                  rue=:rue, phone=:number, bp=:bp, web_site=:website, date_creation=:date_creation,
                  type_vehicule=:type_vehicule, agent_ravito_carburant=:agent_ravito_carburant1, type_avion =:type_avion, nombre_pilotes=:nombre_pilotes, specialites=:specialites
                   ,secteur_activite =:secteur_activite, statut_juridique=:statut_juridique, regime_fiscale=:regime_fiscale
                    ,nombre_etoiles =:nombre_etoiles, type_plats=:type_plats, update_at=:update_at 
                    WHERE id=:id',
        array('logo' => $chemin, 'nom_structure' => $_POST['structure_name'], 'nom_responsable' => $_POST['responsable_name'],
            'pays' => $_POST['pays'], 'ville' => $_POST['ville'], 'quartier' => $_POST['quartier'],
            'rue' => $_POST['rue'], 'number' => $_POST['number'], 'bp' => $_POST['bp'], 'website' => $_POST['website'], 'date_creation' => $_POST['date_creation'],
            'type_vehicule' => $_POST['type_vehicule'], 'agent_ravito_carburant1' => $_POST['agent_ravito_carburant1'], 'type_avion' => $_POST['type_avion'], 'nombre_pilotes' => $_POST['nombre_pilotes'], 'specialites' => $_POST['specialites'],
            'secteur_activite' => $_POST['secteur_activite'], 'statut_juridique' => $_POST['statut_juridique'], 'regime_fiscale' => $_POST['regime_fiscale'],
            'nombre_etoiles' => $_POST['nombre_etoiles'], 'type_plats' => $_POST['type_plats'], 'update_at' => time(),
            'id' => $_POST['id']));

    header('Location: index.php');
}

// Une fois le formulaire envoyé pour la souscription
if (isset($_POST['id2'])) {


    $_POST['nomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['nomSingUp'])));
    $_POST['prenomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['prenomSingUp'])));
    $_POST['birthSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['birthSingUp'])));
    $_POST['telSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['telSingUp'])));
    $_POST['emailSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingUp'])));
    //$_POST['passwordSingUp'] = stripslashes(htmlspecialchars($_POST['passwordSingUp']));
    //$_POST['passwordSingUp'] = sha1($_POST['passwordSingUp']);


    App::getDB()->update('UPDATE users SET lastname=:nomSingUp, firstname=:prenomSingUp, birth=:birthSingUp,
 phone=:telSingUp, email=:emailSingUp, etat_compte=:etat_compte,
                  role_id=:role_id, profession_id=:profession_id, activity_users_id=:activity_users_id,      
                  update_at=:update_at 
                    WHERE id=:id',
        array('nomSingUp' => $_POST['nomSingUp'], 'prenomSingUp' => $_POST['prenomSingUp'], 'birthSingUp' => $_POST['birthSingUp'],
            'telSingUp' => $_POST['telSingUp'], 'emailSingUp' => $_POST['emailSingUp'], 'etat_compte' => $_POST['etat_compte'],
            'role_id' => $_POST['role_id'], 'profession_id' => $_POST['professionSingUp'], 'activity_users_id' => $_POST['categorie'],
            'update_at' => time(),
            'id' => $_POST['id']));

    header('Location: users.php');
}


if (isset($_POST['libelleCate'])) {


    $_POST['libelleCate'] = strtolower(stripslashes(htmlspecialchars($_POST['libelleCate'])));
    $nbre = App::getDB()->rowCount('SELECT id FROM activity_users WHERE libelle="' . $_POST['libelleCate'] . '" ');
    if ($nbre <= 0) {
        App::getDB()->insert('INSERT INTO activity_users(libelle, create_at) 
                                               VALUES(?, ?)', array($_POST['libelleCate'], time()));
        echo 'Ajout éffectué avec succès';
    } else {
        echo 'cette catégorie existe déjà';
    }

}


if (isset($_POST['libelleJob'])) {


    $_POST['libelleJob'] = strtolower(stripslashes(htmlspecialchars($_POST['libelleJob'])));
    $_POST['descriptionJob'] = nl2br(strtolower(stripslashes(htmlspecialchars($_POST['descriptionJob']))));
    $nbre = App::getDB()->rowCount('SELECT id FROM profession WHERE libelle="' . $_POST['libelleJob'] . '" ');
    if ($nbre <= 0) {
        App::getDB()->insert('INSERT INTO profession(libelle, description, create_at) 
                                               VALUES(?, ?, ?)', array($_POST['libelleJob'], $_POST['descriptionJob'], time()));
        echo 'Ajout éffectué avec succès';
    } else {
        echo 'cette profession existe déjà';
    }

}