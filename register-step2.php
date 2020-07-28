<?php session_start(); ?>
<?php require 'Config/Config_Server.php'; ?>
<?php require 'MyDynamicForm.class.php'; ?>

<?php use App\MyDynamicForm; ?>

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

                    <div class="form-wrapper">
                        <div class="wow fadeInRight animated" data-wow-duration="2s" data-wow-delay="0.2s"
                             style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">

                            <div class="panel panel-skin">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Souscription -
                                        Etape Finale <small> (c'est gratuit !)</small></h3>
                                </div>
                                <div class="panel-body">

                                    <form role="form" id="registerDetailActivity" class="contact-form" method="post"
                                          onsubmit="return false;" accept-charset="UTF-8" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <div class="input-field first-wrap">
                                                <div class="input-select">
                                                    <label for="activity_user">Secteur d'Activité</label>
                                                    <select id="activity_user" name="activity_user"
                                                            class="form-control">
                                                        <option placeholder="Activite">Toutes les Activités</option>
                                                        <?php
                                                        foreach (App::getDB()->query('SELECT id, libelle FROM activity_users ORDER BY id DESC') as $activite):
                                                            echo '<option value="' . $activite->id . '">' . $activite->libelle . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">


                                            <?php
                                            $enregistrement = new MyDynamicForm($_POST);

                                            echo '<!-------------------------INFORMATION DE BASE-------------------------------->';

                                            echo '<fieldset id="form_infoDeBase">';

                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                      <div class="form-group">
                                                      <label for="structure_name">Nom de La Structure *</label>' . $enregistrement->input('text', 'structure_name', 'Nom_de_la_structure', '', 'structure_name') . '
                                                       <em><small id="output_structure_name"></small></em>
                                                       </div>
                                                       </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="responsable_name">Nom du Responsable *</label>' . $enregistrement->input('text', 'responsable_name', 'Nom_du_Responsable', '', 'responsable_name') . '
                                                    <em><small id="output_responsable_name"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="pays">Pays *</label>' . $enregistrement->input('text', 'pays', 'Pays', '', 'pays') . '
                                                    <em><small id="output_pays"></small></em>
                                                </div>
                                            </div>';

                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="ville">Ville *</label>' . $enregistrement->input('text', 'ville', 'Ville', '', 'ville') . '
                                                    <em><small id="output_ville"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="quartier">Quartier *</label>' . $enregistrement->input('text', 'quartier', 'Quartier', '', 'quartier') . '
                                                    <em><small id="output_quartier"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="rue">Rue *</label>' . $enregistrement->input('text', 'rue', 'Rue', '', 'rue') . '
                                                    <em><small id="output_rue"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="number">Contact Téléphonique *</label>' . $enregistrement->input('number', 'number', 'Téléphone', '', 'number') . '
                                                    <em><small id="output_phone"></small></em>
                                                </div>
                                            </div>';

                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="bp">BP *</label>' . $enregistrement->input('text', 'bp', 'BP', '', 'bp') . '
                                                    <em><small id="output_bp"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="website">Site web (ex: http://www.search.com)</label>' . $enregistrement->input('url', 'website', 'http://www.search.com', '', 'website') . '
                                                    <em><small id="output_website"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="date_creation">Date de Création *</label>' . $enregistrement->input('date', 'date_creation', 'Date de Création', '', 'date_creation') . '
                                                    <em><small id="output_date_creation"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="logo">Importer votre Logo *</label>' . $enregistrement->input('file', 'logo', '', '', 'logo') . '
                                                    <em><small id="output_logo"></small></em>
                                                </div>
                                            </div>';

                                            echo '</fieldset>';

                                            echo '<!------------------------TRANSPORTEURS TERRESTRES--------------------------------->';

                                            echo '<fieldset id="form_TransporteurTerrestre" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="type_vehicule">Type Vehicule *</label>' . $enregistrement->input('text', 'type_vehicule', 'Type de Véhicule', '', 'type_vehicule') . '
                                                    <em><small id="output_type_vehicule"></small></em>
                                                </div>
                                            </div>';

                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="agent_ravito_carburant1">Agent Ravito Carburant </label>' . $enregistrement->input('text', 'agent_ravito_carburant1', 'Agent Ravito Carburant', '', 'agent_ravito_carburant1') . '
                                                    <em><small id="output_agent_ravito_carburant1"></small></em>
                                                </div>
                                            </div>';

                                            echo '</fieldset>';

                                            echo '<!-------------------------TRANSPORTEUR AERIEN-------------------------------->';

                                            echo '<fieldset id="form_TransporteurAerien" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="agent_ravito_carburant">Agent Ravito Carburant </label>' . $enregistrement->input('text', 'agent_ravito_carburant', 'Agent Ravito Carburant', '', 'agent_ravito_carburant') . '
                                                    <em><small id="output_agent_ravito_carburant"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre_pilotes">Nombre de Pilote *</label>' . $enregistrement->input('number', 'nombre_pilotes', 'Nombre de Pilotes', '', 'nombre_pilotes') . '
                                                    <em><small id="output_nombre_pilotes"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="type_avion">Type d\'Avions *</label>' . $enregistrement->input('text', 'type_avion', 'Type d\'avions', '', 'type_avion') . '
                                                    <em><small id="output_type_avion"></small></em>
                                                </div>
                                            </div>';
                                            echo '</fieldset>';

                                            echo '<!-----------------------CENTRE DE FORMATION---------------------------------->';

                                            echo '<fieldset id="form_centreFormation" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="specialites">Spécialité *</label>' . $enregistrement->input('text', 'specialites', 'specialites', '', 'specialites') . '
                                                    <em><small id="output_specialites"></small></em>
                                                </div>
                                            </div>';
                                            echo '</fieldset>';

                                            echo '<!------------------------CENTRE HOSPITALIER--------------------------------->';

                                            echo '<fieldset id="form_centreHospitalier" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="specialites1">Spécialité *</label>' . $enregistrement->input('text', 'specialites1', 'specialites', '', 'specialites1') . '
                                                    <em><small id="output_specialites1"></small></em>
                                                </div>
                                            </div>';
                                            echo '</fieldset>';

                                            echo '<!-------------------------ENTREPRISE-------------------------------->';

                                            echo '<fieldset id="form_entreprise" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="secteur_activite">Secteur d\'activité *</label>' . $enregistrement->input('text', 'secteur_activite', 'Secteur d\'activité', '', 'secteur_activite') . '
                                                    <em><small id="output_secteur_activite"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="statut_juridique">Statut juridique *</label>' . $enregistrement->input('text', 'statut_juridique', 'Statut jurique', '', 'statut_juridique') . '
                                                    <em><small id="output_statut_juridique"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="regime_fiscale">Régime Fiscale *</label>' . $enregistrement->input('text', 'regime_fiscale', 'Regime fiscale', '', 'regime_fiscale') . '
                                                    <em><small id="output_regime_fiscale"></small></em>
                                                </div>
                                            </div>';
                                            echo '</fieldset>';

                                            echo '<!--------------------------RESTAURANTS------------------------------->';

                                            echo '<fieldset id="form_restaurant" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre_etoiles">Nombre d\'étoile *</label>' . $enregistrement->input('number', 'nombre_etoiles', 'Nombre d\'étoiles', '', 'nombre_etoiles') . '
                                                    <em><small id="output_nombre_etoiles"></small></em>
                                                </div>
                                            </div>';


                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="type_plats">Type de Plats *</label>' . $enregistrement->input('number', 'type_plats', 'Type de Plats', '', 'type_plats') . '
                                                    <em><small id="output_type_plats"></small></em>
                                                </div>
                                            </div>';
                                            echo '</fieldset>';

                                            echo '<!---------------------------HOTEL------------------------------>';
                                            echo '<fieldset id="form_hotel" class="collapse">';
                                            echo '<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre_etoilesH">Nombre d\'étoile *</label>' . $enregistrement->input('number', 'nombre_etoilesH', 'Nombre d\'étoiles', '', 'nombre_etoilesH') . '
                                                    <em><small id="output_nombre_etoilesH"></small></em>
                                                </div>
                                            </div>';
                                            echo '</fieldset>';

                                            ?>
                                        </div>

                                        <div id="load_data_SingUp" style="text-align: center!important;"></div>


                                        <?php echo $enregistrement->submit('Envoyer', 'btn btn-skin btn-block btn-lg', 'souscription', 'souscription'); ?>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>


            </div>
        </div>
    </div>

</section>
<?php require('footer.php'); ?>
<script>
    $(document).ready(function () {
        //$('#select_2').hide();
        /*$('#activity_user').change(function(){
            //$('#select_2').show();
            alert("boonjour");
        });*/


        $('#activity_user').change(function () {
            var id_categorie = $('#activity_user').val();
            var selectedCountry = $("#activity_user option:selected").text();
            var conceptName = $('#activity_user').find(":selected").text();

            $('body').notif({
                title: 'Sélectionne',
                content: selectedCountry,
                img: 'img/icons/information.png',
                cls: 'alert-info'
            });

            //Pharmacies id=1
            if (id_categorie == 1) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }
            //Transport terrestre id=2
            else if (id_categorie == 2) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();

            }

            //Transport Aerien id=3
            else if (id_categorie == 3) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurAerien').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }

            // Centres de Formation id=4
            else if (id_categorie == 4) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_centreFormation').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }


            // Centres Hospitaliers id=5
            else if (id_categorie == 5) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_centreHospitalier').removeClass('collapse').delay(500).fadeIn();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }


            // Centres de visites Techniques id=6
            else if (id_categorie == 6) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }


            // Station Services id=7
            else if (id_categorie == 7) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }

            // Super Marchés id=8
            else if (id_categorie == 8) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }

            // Entreprises id=9
            else if (id_categorie == 9) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_entreprise').removeClass('collapse').delay(500).fadeIn();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }


            // Restaurants id=10
            else if (id_categorie == 10) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_restaurant').removeClass('collapse').delay(500).fadeIn();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }

            // Hôtels id=11
            else if (id_categorie == 11) {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_hotel').removeClass('collapse').delay(500).fadeIn();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
            } else {
                $('#form_infoDeBase').removeClass('collapse').delay(500).fadeIn();
                $('#form_TransporteurTerrestre').addClass('collapse').delay(500).fadeOut();
                $('#form_TransporteurAerien').addClass('collapse').delay(500).fadeOut();
                $('#form_centreFormation').addClass('collapse').delay(500).fadeOut();
                $('#form_centreHospitalier').addClass('collapse').delay(500).fadeOut();
                $('#form_entreprise').addClass('collapse').delay(500).fadeOut();
                $('#form_restaurant').addClass('collapse').delay(500).fadeOut();
                $('#form_hotel').addClass('collapse').delay(500).fadeOut();
            }

        });


    });
</script>

</body>
</html>