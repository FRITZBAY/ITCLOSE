<?php

require '../Config/Config_Server.php'; ?>

    <!DOCTYPE html>
    <html lang="fr">

    <?php require 'header.php'; ?>
    <body>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php require 'Sidebar.php'; ?>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper" style="padding: initial;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a>
                        </div>
                    </div>

                    <article class="col-lg-7" style="margin-left: 100px">
                        <h1>AJOUT DES PROFESSIONS</h1>
                        <form id="" method="post" accept-charset="UTF-8" action="traitement.php">
                            <div class="row">
                                <div class="row">

                                    <div class="form-group">
                                        <label for="libelleJob">PROFESSION *</label>
                                        <input type="text" name="libelleJob" id="libelleJob"
                                               class="form-control input-md" required="required"
                                               placeholder="Libelle Profession">
                                    </div>

                                    <div class="form-group">
                                            <textarea name="descriptionJob" id="descriptionJob" cols="130" rows="10">
                                                DESCRIPTION DU METIER
                                            </textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12"><input type="submit" value="Envoyer"></div>
                            </div>
                        </form>
                    </article>


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

<?php
