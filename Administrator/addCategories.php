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

                <article class="col-lg-7">
                    <h1>AJOUT DES CATEGORIES</h1>
                    <form id="" method="post" accept-charset="UTF-8" action="traitement.php">
                        <div class="row">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="libelleCate">CATEGORIE *</label>
                                        <input type="text" name="libelleCate" id="libelleCate"
                                               class="form-control input-md" required="required"
                                               placeholder="Libelle Categorie">
                                    </div>
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
