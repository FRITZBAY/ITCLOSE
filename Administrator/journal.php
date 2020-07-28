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



<div class="col-lg-12">
    <div class="panel panel-default" style="background-color: initial;">
        <div class="panel-heading"
             style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
            JOURNAL DE L'APPLICATION
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th width="1%">ID</th>
                        <th width="2%">LIBELLE</th>
                        <th width="5%">IP</th>
                        <th width="1%">DATE_ENREG</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tbody id="tabdynamique">
                    <?php
                    foreach (App::getDB()->query('SELECT * FROM journal ORDER BY id DESC') as $ccompte):
                        echo '<tr>
                                                        <td title="ID">' . $ccompte->id . '</td> 
                                                         <td title="LAST NAME">' . $ccompte->libelle . '</td>
                                                        <td title="FIRST NAME">' . $ccompte->ip . '</td>
                                                        <td title="DATE_ENREG">' . date('d/m/Y H:m:s', $ccompte->create_at) . '</td>                
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


</div>
</div>
</div>
</div>


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