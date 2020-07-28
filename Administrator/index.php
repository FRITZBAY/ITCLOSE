<?php

require '../Config/Config_Server.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<?php require 'header.php'; ?>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <?php require('Sidebar.php'); ?>
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
                    foreach (App::getDB()->query('SELECT * FROM detailactivity_users WHERE id=' . $_GET['modif']) as $ccompte):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION DES CATEGORIES</h1>
                            <form id="modif_compte" method="post" accept-charset="UTF-8" action="traitement.php"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $ccompte->id; ?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="structure_name">NOM DE LA STRUCTURE</label>
                                        <input id="structure_name" type="text" name="structure_name"
                                               placeholder="NOM DE LA STRUCTURE" class="form-control"
                                               value="<?= $ccompte->nom_structure; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="responsable_name">NOM DU RESPONSABLE</label>
                                        <input id="responsable_name" type="text" name="responsable_name"
                                               placeholder="NOM DU RESPONSABLE" class="form-control"
                                               value="<?= $ccompte->nom_responsable; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="pays">PAYS</label>
                                        <input id="pays" type="text" name="pays" placeholder="PAYS" class="form-control"
                                               value="<?= $ccompte->pays; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="ville">VILLE</label>
                                        <input id="ville" type="text" name="ville" class="form-control"
                                               placeholder="VILLE" value="<?= $ccompte->ville; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="quartier">QUARTIER</label>
                                        <input id="quartier" type="text" name="quartier" class="form-control"
                                               placeholder="QUARTIER" value="<?= $ccompte->quartier; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="rue">RUE</label>
                                        <input id="rue" type="text" name="rue" class="form-control"
                                               value="<?= $ccompte->rue; ?>" placeholder="RUE">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="number">CONTACT TELEPHONIQUE</label>
                                        <input id="number" type="number" name="number" class="form-control"
                                               placeholder="Contact Téléphonique" value="<?= $ccompte->phone; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="bp">BP</label>
                                        <input id="bp" type="text" name="bp" class="form-control" placeholder="BP"
                                               value="<?= $ccompte->bp; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="website">SITE WEB</label>
                                        <input id="website" type="text" name="website" class="form-control"
                                               placeholder="site web" value="<?= $ccompte->web_site; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="date_creation">DATE DE CREATION</label>
                                        <input id="date_creation" type="date" name="date_creation" class="form-control"
                                               placeholder="Date de Création" value="<?= $ccompte->date_creation; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="logo">IMPORTER VOTRE LOGO</label>
                                        <input id="logo" type="file" name="logo" class="form-control"
                                               placeholder="Importer votre Logo" value="<?= $ccompte->logo; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="type_vehicule">TYPE VEHICULE</label>
                                        <input id="type_vehicule" type="text" name="type_vehicule" class="form-control"
                                               placeholder="Type Vehicule" value="<?= $ccompte->type_vehicule; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="agent_ravito_carburant1">AGENT RAVITO CARBURANT</label>
                                        <input id="agent_ravito_carburant1" type="text" name="agent_ravito_carburant1"
                                               class="form-control" placeholder="agent ravito carburant"
                                               value="<?= $ccompte->agent_ravito_carburant; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nombre_pilotes">NOMBRE DE PILOTES</label>
                                        <input id="nombre_pilotes" type="number" name="nombre_pilotes"
                                               class="form-control" placeholder="Nombre de pilote"
                                               value="<?= $ccompte->nombre_pilotes; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="type_avion">TYPE AVION</label>
                                        <input id="type_avion" type="text" name="type_avion" class="form-control"
                                               placeholder="Type d'Avions" value="<?= $ccompte->type_avion; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="specialites">SPECIALITE</label>
                                        <input id="specialites" type="text" name="specialites" class="form-control"
                                               placeholder="Specialité" value="<?= $ccompte->specialites; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="secteur_activite">SECTEUR D'ACTIVITE</label>
                                        <input id="secteur_activite" type="text" name="secteur_activite"
                                               class="form-control" placeholder="secteur d'activité"
                                               value="<?= $ccompte->secteur_activite; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="statut_juridique">STATUT JURIDIQUE</label>
                                        <input id="statut_juridique" type="text" name="statut_juridique"
                                               class="form-control" placeholder="Statut Juridique"
                                               value="<?= $ccompte->statut_juridique; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="regime_fiscale">REGIME FISCALE</label>
                                        <input id="regime_fiscale" type="text" name="regime_fiscale"
                                               class="form-control" placeholder="Regime Fiscale"
                                               value="<?= $ccompte->regime_fiscale; ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="nombre_etoiles">Nombre d'étoile</label>
                                        <input id="nombre_etoiles" type="number" name="nombre_etoiles"
                                               class="form-control" placeholder="Nombre d'étoile"
                                               value="<?= $ccompte->nombre_etoiles; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="type_plats">Type de Plats</label>
                                        <input id="type_plats" type="text" name="type_plats" class="form-control"
                                               placeholder="Type de Plats" value="<?= $ccompte->type_plats; ?>">
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
                        App::getDB()->delete('DELETE FROM detailactivity_users WHERE id=:compte', ['compte' => $_GET['supp']]);
                    }
                    ?>
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
                                            <th width="2%">LOGO</th>
                                            <th width="5%">NOM STRUCTURE</th>
                                            <th width="5%">NOM RESPONSABLE</th>
                                            <th width="5%">PAYS</th>
                                            <th width="5%">VILLE</th>
                                            <th width="5%">QUARTIER</th>
                                            <th width="5%">RUE</th>
                                            <th width="3%">TEL</th>
                                            <th width="5%">BP</th>
                                            <th width="3%">SITE WEB</th>
                                            <th width="1%">DATE CREATION</th>
                                            <th width="3%">TYPE VEHICULE</th>
                                            <th width="3%">AGENT RAVITO</th>
                                            <th width="3%">TYPE AVION</th>
                                            <th width="5%">NBRE PILOTES</th>
                                            <th width="5%">SPECIALITES</th>
                                            <th width="3%">SECTEUR D'ACTIVITE</th>
                                            <th width="5%">STATUT JURIDIQUE</th>
                                            <th width="5%">REGIME FISCALE</th>
                                            <th width="5%">NBRE ETOILES</th>
                                            <th width="5%">TYPE PLATS</th>
                                            <th width="1%">DATE_ENREG</th>
                                            <th width="1%">DATE_MODIF</th>
                                            <th width="3%">MODIFIER</th>
                                            <th width="3%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM detailactivity_users
                                                                                     ORDER BY id DESC') as $ccompte):
                                            echo '<tr>
                                                        <td title="ID">' . $ccompte->id . '</td> 
                                                         <td title="LOGO"><img src="' . $ccompte->logo . '"></td>
                                                        <td title="NOM STRUCTURE">' . $ccompte->nom_structure . '</td> 
                                                        <td title="NOM RESPONSABLE">' . $ccompte->nom_responsable . '</td> 
                                                        <td title="PAYS">' . $ccompte->pays . '</td> 
                                                        <td title="VILLE">' . $ccompte->ville . '</td> 
                                                        <td title="QUARTIER">' . $ccompte->quartier . '</td> 
                                                        <td title="RUE">' . $ccompte->rue . '</td> 
                                                        <td title="TEL">' . $ccompte->phone . '</td> 
                                                        <td title="BP">' . $ccompte->bp . '</td> 
                                                        <td title="SITE WEB">' . $ccompte->web_site . '</td> 
                                                        <td title="DATE CREATION">' . $ccompte->date_creation . '</td>
                                                        <td title="TYPE VEHICULE">' . $ccompte->type_vehicule . '</td>
                                                        <td title="AGENT RAVITO">' . $ccompte->agent_ravito_carburant . '</td> 
                                                        <td title="TYPE AVION">' . $ccompte->type_avion . '</td> 
                                                        <td title="NBRE PILOTES">' . $ccompte->nombre_pilotes . '</td> 
                                                        <td title="SPECIALITES">' . $ccompte->specialites . '</td> 
                                                        <td title="SECTEUR D\'ACTIVITE">' . $ccompte->secteur_activite . '</td> 
                                                        <td title="STATUT JURIDIQUE">' . $ccompte->statut_juridique . '</td> 
                                                        <td title="REGIME FISCALE">' . $ccompte->regime_fiscale . '</td>
                                                        <td title="NBRE ETOILES">' . $ccompte->nombre_etoiles . '</td>
                                                        <td title="TYPE PLATS">' . $ccompte->type_plats . '</td>
                                                        <td title="DATE_ENREG">' . date('d/m/Y H:m:s', $ccompte->create_at) . '</td> 
                                                        <td title="DATE_MODIF">' . date('d/m/Y H:m:s', $ccompte->update_at) . '</td>                 
                                                        <td title="MODIFIER"><a href="index.php?modif=' . $ccompte->id . '"  class="modifElementTab">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="index.php?supp=' . $ccompte->id . '"  class="suppElementTab">SUPPRIMER</a></td>
                                                   </tr>';
                                        endforeach;
                                        ?>
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

