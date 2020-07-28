<?php session_start(); ?>
<?php require 'Config/Config_Server.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'head.php' ?>

<style>
    a:link, .q:active, .q:visited {
        cursor: pointer;
    }

    .card {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 2px 5px 0px, rgba(0, 0, 0, 0.12) 0px 2px 10px 0px;
        font-weight: 400;
        border-width: 0px;
        border-style: initial;
        border-color: initial;
        border-image: initial;
    }

    .card {
        position: relative;
        /*display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;*/
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .55rem;
    }

    .card {
        -webkit-box-shadow: 0 5px 1px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
        box-shadow: 0 5px 1px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
        border: 0;
        font-weight: 400;
    }

    .card.card-cascade .view.view-cascade.gradient-card-header {
        padding: 1.6rem 1rem;
        text-align: left;
    }

    .card.card-cascade .view.view-cascade {
        -webkit-box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15);
        box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15);
        -webkit-border-radius: .25rem;
        border-radius: .55rem;
    }

    .view {
        position: relative;
        overflow: hidden;
        cursor: default;
    }

    .view {
        margin: 10px;
        float: left;
        border: 10px solid #fff;
        overflow: hidden;
        position: relative;
        text-align: center;
        box-shadow: 1px 1px 2px #e6e6e6;
        cursor: default;
    }
</style>

<body>

<section>
    <div class="container">
        <div class="row col-lg-offset-10" style="margin-top: 20px;">

            <?php if(isset($_COOKIE['ID_USER']) || isset($_SESSION['ID_USER'])){
                ?>
                <span> <a href="login.php">Espace Profil</a> </span>
                <span style="margin-left: 20px;"> <a href="logout.php">Déconnexion</a> </span>
            <?php
            } else{
                ?>
                <span> <a href="login.php">Connexion</a> </span>
                <span style="margin-left: 20px;"> <a href="register.php">Souscription</a> </span>
            <?php
            } ?>
        </div>
    </div>

</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 s130">
                <form id="search_sujet" action="#" method="get" class="col-lg-12" role="search"
                      onsubmit="return false;">
                    <div class="inner-form">
                        <div class="input-field first-wrap">
                            <div class="svg-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                </svg>
                            </div>
                            <input id="search_contenu" type="text" name="search_contenu"
                                   placeholder="Recherchez-vous une entreprise ?"
                                   value="<?php if (isset($_GET['search_contenu'])) echo $_GET['search_contenu']; ?>"/>
                        </div>
                        <div class="input-field second-wrap">
                            <button id="enreg_search" class="btn-search" type="submit">RECHERCHE</button>
                        </div>
                    </div>
                    <span id="output_search" class="info">ex. Pharmacie, Entreprise, super marché, école</span>
                </form>

                <div class="loader_articles" style="display: none; position: relative; text-align: center">
                    <span class="loader loader-circle"></span>
                    Chargement......
                </div>
                <article id="articles"></article>
            </div>

        </div>
    </div>
</section>

<?php require('footer.php'); ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->


</html>