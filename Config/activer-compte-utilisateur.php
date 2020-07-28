<?php
 require_once('page_number.php');
// Redirige l'utilisateur s'il est déjà identifié
if(isset($_COOKIE["EMAIL_USER"]) || isset($_SESSION['EMAIL_USER']))
{
     header("Location: index.php");
}
else
{
     
     // Vérifie que de bonnes valeurs sont passées en paramètres
     if(!preg_match('/^[0-9]+$/', $_GET["numero_id"]) || !preg_match('/^[a-f0-9]{8}$/', strtolower($_GET["clef"])))
     {
          header("Location: index.php");
     }
     else
     {
          
          // Connexion à la base de données
         $connexion = App::getDB();
         $etat_compte = '';
         $nbre = $connexion->rowCount('SELECT id_compte FROM compte 
          WHERE id_compte="'.$_GET['numero_id'].'" 
          AND clef_activation="'.strtolower($_GET["clef"]).'"');

         // Si aucun enregistrement n'est trouvé
          if($nbre<=0)
          {
              header("Location: index.php");
          }
          else
          {
                    // Récupération du tableau de données retourné
                    //$row = mysql_fetch_array($result);
					$row = $connexion->prepare_request('SELECT etat_compte FROM compte 
                           WHERE id_compte=:id AND clef_activation=:clef', ['id'=>$_GET['numero_id'], 'clef'=>strtolower($_GET["clef"])]);

                    
                    // Vérification que le compte ne soit pas déjà activé
                    if($row["etat_compte"] != 0)
                    {
                         $message = "Votre compte utilisateur a déjà été activé<br> Connectez-vous Simplement !";
                         $etat_compte=$row["etat_compte"];
                    }
                    else
                    {
                       $connexion->update('UPDATE compte SET etat_compte=:etat WHERE id_compte=:id AND clef_activation=:clef', array('etat'=>1, 'id'=>$_GET["numero_id"], 'clef'=>strtolower($_GET["clef"])));
                              $message = "Votre compte utilisateur a correctement été activé<br> Vous pouvez vous Connecter !";
                        $etat_compte=$row["etat_compte"];
                    }
          

               
          }
          
    
     }
     
}

?>

    <section id="content" style="margin-bottom: 130px;">
  <div class="container">
    <div class="row">
    
    <!--Contenu: MENU VERTICAL version mobile, tablets et PC-->
        

                <!--Contenu: Informations sur le site provenant du lien cliqu� sur le menu vertical accordeon-->
      <div class="col-xs-12 col-md-12 col-lg-12">
        
        <div style="text-align: center!important;">
        <article>
		<?php if(isset($etat_compte) AND $etat_compte == '0'){
		?>
	  <div style="text-align: center!important; display: block">
          <div class="status alert alert-success" style="display: block"><?php echo $message; ?></div><br>
          <div class="text-center">
              <a id="compte_active" role="button" href="index.php" class="btn btn-primary" title="PAGE D'ACCUEIL "><span class="glyphicon glyphicon-home"></span> PAGE D'ACCUEIL</a>
          </div>
      </div>
		<?php
		}
		?>
		
         <?php if(isset($etat_compte) AND $etat_compte == 1){?>
         <div style="text-align: center!important; display: block">
             <div class="status alert alert-danger" style="display: block"><?php echo $message; ?></div>
             <div class="text-center">
                 <a role="button" href="index.php" class="btn btn-primary" title="PAGE D'ACCUEIL"><span class="glyphicon glyphicon-home"></span> RETOURNER A LA PAGE D'ACCUEIL</a>
             </div>
         </div>
             <?php
         }
         ?>
        </article>
        </div>
        </div>

       

        </div>
  </div>
  </section>

