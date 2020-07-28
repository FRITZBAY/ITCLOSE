

$(function () {

    //creation de mon plugin JQuery avec le template de ma notification
    $.fn.notif = function(options){
        var options = $.extend({
            html: '    <div class="alert_notification add animated fadeInLeft {{cls}}">\n' +
                '        <div class="left1">\n' +
                '            <div class="img1" style="background-image: url({{img}});">  \n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="right1">\n' +
                '            <h2 class="alert_title">{{title}}</h2>\n' +
                '            <p class="alert_p">{{content}}</p>\n' +
                '        </div>\n' +
                '    </div>'
        }, options);

        //permet de garder l'objet JQuery en mémoire et permet aussi d'enchainner les arguments juste apres
        return this.each(function () {
            var $this = $(this);
            var $notifs = $('> #alert_notifications', this);
            var $notif = $(Mustache.render(options.html,
                options));

            if($notifs.length == 0){
                $notifs = $('<div id="alert_notifications"/>'
                );
                $this.append($notifs);
            }
            $notifs.append($notif);
            setTimeout(function () {
                $notif.addClass('.fadeOutLeft').delay(500).slideUp(300, function () {
                    $notif.remove();
                });
            }, 6000);
        });
    };

    //apres le click
    $('.add').click(function(e){
        e.preventDefault();
        $('body').notif({
            title: 'Mon titre',
            content: 'Mon contenu',
            img: 'img/success-notif.jpg',
            cls: 'success1'
        });
    });

});

/* ==========================================================================
       GESTION DU SYSTEME DE SOUSCRIPTION
   ========================================================================== */

$(function () {
    /* ==========================================================================
GESTION DU SYSTEME D'INSCRIPTION
========================================================================== */

    $('#singUp input').focus(function () {
        $('#rapport').fadeOut(800);
    });

    //verification si le Nom est ok ou a déjà été utilisé
    $('#nomSingUp').keyup(function () {
        nomSingUp();
    });

    $('#prenomSingUp').keyup(function () {
        prenomSingUp();
    });

    $('#birthSingUp').keyup(function () {
        birthSingUp();
    });

    $('#telSingUp').keyup(function () {
        telSingUp();
    });

    $('#emailSingUp').keyup(function () {
        emailSingUp();
    });

    $('#emailConfirmSingUp').keyup(function () {
        emailConfirmSingUp();
    })

    $('#passwordSingUp').keyup(function () {
        passwordSingUp();
    });

    $('#passwordConfirmSingUp').keyup(function () {
        passwordConfirmSingUp();
    });

    //fonction de verification du Nom en ajax
    function nomSingUp() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'nomSingUp': $('#nomSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_nomSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_nomSingUp').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial'
                    }).html(data);
                }
            }
        });


    }

    //fonction de verification du Prenom en ajax
    function prenomSingUp() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'prenomSingUp': $('#prenomSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_prenomSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_prenomSingUp').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de la date de naissance en ajax
    function birthSingUp() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'birthSingUp': $('#birthSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_birthSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_birthSingUp').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de la profession en ajax
    function telSingUp() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'telSingUp': $('#telSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_telSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_telSingUp').css('color', 'red').html(data);
                }
            }
        });
    }



    //fonction de verification du password en ajax
    function emailSingUp() {

        if($('#emailSingUp').val().length < 4){
            $('#output_emailSingUp').css('color', 'red').html("<br>Votre email est trop court (5 caractères minimum.)");
        }else if($('#emailSingUp').val()!='' && $('#emailSingUp').val()!= $('#emailConfirmSingUp').val()){
            $('#output_emailSingUp').css('color', 'red').html('<br>Les deux addresses emails sont différentes');
            $('#output_emailConfirmSingUp').css('color', 'red').html('<br>Les deux adresses emails sont différentes');
        }else{
            $('#output_emailSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            if($('#emailConfirmSingUp').val()!=''){
                $('#output_emailConfirmSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            }
        }
    }

    //fonction de verification de l'email de confirmation en ajax
    function emailConfirmSingUp() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'emailSingUp': $('#emailSingUp').val(),
                'emailConfirmSingUp': $('#emailConfirmSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_emailSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    $('#output_emailConfirmSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_emailConfirmSingUp').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification du password en ajax
    function passwordSingUp() {

        if($('#passwordSingUp').val().length < 5){
            $('#output_passwordSingUp').css('color', 'red').html("<br>Trop court (5 caractères minimum.)");
        }else if($('#passwordConfirmSingUp').val()!='' && $('#passwordConfirmSingUp').val()!= $('#passwordSingUp').val()){
            $('#output_passwordSingUp').css('color', 'red').html('<br>Les deux mots de passe sont différents');
            $('#output_passwordConfirmSingUp').css('color', 'red').html('<br>Les deux mots de passe sont différents');
        }else{
            $('#output_passwordSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            if($('#passwordConfirmSingUp').val()!=''){
                $('#output_passwordConfirmSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            }
        }
    }



    //fonction de verification du password confirme en ajax
    function passwordConfirmSingUp() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'passwordSingUp': $('#passwordSingUp').val(),
                'passwordConfirmSingUp': $('#passwordConfirmSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_passwordSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    $('#output_passwordConfirmSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_passwordConfirmSingUp').css('color', 'red').html(data);
                }
            }
        });


    }



    $('#singUp').submit(function () {
        var statut1 = $('#rapport');
        var nom = $('#nomSingUp').val(),
            prenom = $('#prenomSingUp').val(),
            birth = $('#birthSingUp').val(),
            telephone = $('#telSingUp').val(),
            email1 = $('#emailSingUp').val(),
            password1 = $('#passwordSingUp').val();


        if (nom == '' || prenom == '' || birth == ''|| telephone == '' || email1 == '' || password1 == '') {
            statut1.html('Veuillez Remplir Tous les Champs').fadeIn(400);
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir Tous les Champs !',
                img: 'img/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: 'Controller/submit.php?singUp=singUp',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg').attr('value', 'En cours...');
                    $('#load_data_SingUp').html('<div style="display: block;">\n' +
                        '                                    <span class="loader loader-circle"></span>\n' +
                        '                                    Chargement......\n' +
                        '                                </div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        statut1.html(data).fadeIn(400);
                        $('#enreg').attr('value', 'Envoyer');
                        $('#load_data_SingUp').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg').attr('value', 'Envoyer');
                        $('#load_data_SingUp').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singUp').hide();

                        $('body').notif({
                            title: 'Courrier Electronique',
                            content: 'Votre compte utilisateur a été créée à cette Adresse: ' + email1,
                            img: 'img/email.png',
                            cls: 'alert-info'
                        });
                        setTimeout(function () {
                            location.href='register-step2.php';
                        }, 6000);
                        /* $('#nomSingUp').val("");
                         $('#prenomSingUp').val("");
                         $('#emailSingUp').val("");
                         $('#passwordSingUp').val("");*/

                    }
                }

            });

        }


    });

});


/* ==========================================================================
       GESTION DU SYSTEME DE CONNEXION
   ========================================================================== */


$(function () {

    $('#singIn input').focus(function () {
        $('#rapport').fadeOut(800);
    });

    $('#emailSingIn').keyup(function () {
        emailSingIn();
    });

    $('#passwordSingIn').keyup(function () {
        passwordSingIn();
    });

    //fonction de verification de l'email en ajax
    function emailSingIn() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singIn=singIn',
            data: {
                'emailSingIn': $('#emailSingIn').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_emailSingIn').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_emailSingIn').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification du password en ajax
    function passwordSingIn() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singIn=singIn',
            data: {
                'passwordSingIn': $('#passwordSingIn').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_passwordSingIn').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_passwordSingIn').css('color', 'red').html(data);
                }
            }
        });


    }


    $('#singIn').submit(function () {
        var email = $('#emailSingIn').val(), password = $('#passwordSingIn').val();
        var statut1 = $('#rapport');

        if (email == '' || password == '') {
            statut1.html('Veuillez Remplir Tous les Champs').fadeIn(400);
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir Tous les Champs !',
                img: 'img/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: 'Controller/submit.php?singIn=singIn',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg_connexion').attr('value', 'En cours...');
                    $('#load_data_SingIn').html('<div style="display: block;">\n' +
                        '                                    <span class="loader loader-circle"></span>\n' +
                        '                                    Chargement......\n' +
                        '                                </div>');
                },
                success: function (data) {
                    if(data === 'admin'){
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singIn').hide().fadeOut();

                        var myDate = new Date(), etat;
                        (myDate.getHours()>=0 && myDate.getHours() <= 12)? etat = 'BONJOUR': etat = 'BONSOIR';
                        //alert(myDate.getHours());
                        $('body').notif({
                            title: etat,
                            content: 'BIENVENUE ADMINISTRATEUR',
                            img: 'img/homme.png',
                            cls: 'alert-info'
                        });

                        setTimeout(function () {
                            $(location).attr('href',"Administrator/index.php");
                        }, 7000);
                    }else if(data === 'success'){
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singIn').hide().fadeOut();

                        var myDate = new Date(), etat;
                        (myDate.getHours()>=0 && myDate.getHours() <= 12)? etat = 'BONJOUR': etat = 'BONSOIR';
                        //alert(myDate.getHours());
                        $('body').notif({
                            title: etat,
                            content: 'Soyez Le Bienvenu',
                            img: 'img/homme.png',
                            cls: 'success1'
                        });

                        setTimeout(function () {
                            $(location).attr('href',"members.php");
                        }, 7000);
                    }
                    else {
                        statut1.html(data).fadeIn(400);

                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');

                        $('body').notif({
                            title: 'Message d\'Erreur',
                            content: data,
                            img: 'img/error-notif.png',
                            cls: 'error1'
                        });
                    }
                }

            });

        }


    });

});


/* ==========================================================================
GESTION DU SYSTEME DE RECUPERATION DU MOT DE PASSE
========================================================================== */

$(function () {

    $('#getPassword input').focus(function () {
        $('#rapport').fadeOut(800);
    });

    $('#getEmail').keyup(function () {
        getEmail();
    });


    //fonction de verification de l'email en ajax
    function getEmail() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?getEmail=getEmail',
            data: {
                'getEmail': $('#getEmail').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_getEmail').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_getEmail').css({
                        'color': 'red',
                        'font-weight': 'bold'
                    }).html(data);

                    /* setTimeout(function () {
                         $('#output_email_visitor').hide();

                     }, 7000);*/
                }
            }
        });


    }




    $('#getPassword').submit(function () {
        var email = $('#getEmail').val();
        var statut1 = $('#rapport');


        if (email == '') {
            statut1.html('Veuillez Remplir le Champs').fadeIn(400);
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir le Champs !',
                img: 'img/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: 'Controller/submit.php?getEmail=getEmail',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#sendEmailForget').attr('value', 'En cours...');
                    $('#load_data_getEmail').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#sendEmailForget').attr('value', 'Envoyer');
                        $('#load_data_getEmail').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        statut1.html(data).fadeIn(400);

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#sendEmailForget').attr('value', 'Envoyer');
                        $('#load_data_getEmail').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/success-notif.jpg',
                            cls: 'success1'
                        });
                        /* setTimeout(function () {
                             $('#output_visitor').fadeOut().hide();

                         }, 7000);*/
                    }
                }

            });

        }


    });

});



/* ==========================================================================
       GESTION DU SYSTEME DE CATEGORIES
   ========================================================================== */
$(function () {
    /* ==========================================================================
GESTION DU SYSTEME D'INSCRIPTION
========================================================================== */

    $('#singUp input').focus(function () {
        $('#rapport').fadeOut(800);
    });


     $('#registerDetailActivity').submit(function () {
        var statut1 = $('#rapport');
        var structure_name = $('#structure_name').val(),
            responsable_name = $('#responsable_name').val(),
            pays = $('#pays').val(),
            ville = $('#ville').val(),
            quartier = $('#quartier').val(),
            rue = $('#rue').val(),
            number = $('#number').val(),
            bp = $('#bp').val(),
            website = $('#website').val(),
            date_creation = $('#date_creation').val(),
            logo = $('#logo').val(),
            type_vehicule = $('#type_vehicule').val(),
            agent_ravito_carburant1 = $('#agent_ravito_carburant1').val(),
            agent_ravito_carburant = $('#agent_ravito_carburant').val(),
            nombre_pilotes = $('#nombre_pilotes').val(),
            type_avion = $('#type_avion').val(),
            specialites = $('#specialites').val(),
            specialites1 = $('#specialites1').val(),
            secteur_activite = $('#secteur_activite').val(),
            statut_juridique = $('#statut_juridique').val(),
            regime_fiscale = $('#regime_fiscale').val(),
            nombre_etoiles = $('#nombre_etoiles').val(),
            type_plats = $('#type_plats').val(),
            nombre_etoilesH = $('#nombre_etoilesH').val();


        if (structure_name == '' || responsable_name == '' || pays == ''|| ville == '' || quartier == '' || rue == ''
            || number == '' || bp == '' || website == '' || date_creation == '' || logo == '') {
            statut1.html('Un ou plusieurs champs sont vides.').fadeIn(400);
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Un ou plusieurs champs sont vides',
                img: 'img/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $formulaire = $(this);
            var formdata = (window.FormData) ? new FormData($formulaire[0]) : null;
            var donnee = (formdata !== null) ? formdata : $formulaire.serialize();

            $.ajax({
                type: 'post',
                url: 'Controller/submit.php?detailActivity=detailActivity',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                dataType: 'json',
                data: donnee,
                beforeSend: function () {
                    $('#souscription').attr('value', 'En cours...');
                    $('#load_data_SingUp').html('<div style="display: block;">\n' +
                        '                                    <span class="loader loader-circle"></span>\n' +
                        '                                    Chargement......\n' +
                        '                                </div>');
                },
                success: function (data) {
                    if(data.resultat != ''){
                        statut1.html(data).fadeIn(400);
                        $('#souscription').attr('value', 'Envoyer');
                        $('#load_data_SingUp').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data.resultat,
                            img: 'img/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#souscription').attr('value', 'Envoyer');
                        $('#load_data_SingUp').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#registerDetailActivity').hide();

                        $('body').notif({
                            title: 'Notification',
                            content: structure_name + ' a été enregistré avec succès. Nous vous remercions de votre confiance.',
                            img: 'img/email.png',
                            cls: 'alert-info'
                        });
                        setTimeout(function () {
                            location.href='index.php';
                        }, 6000);
                         //$('#nomSingUp').val("");
                         //$('#prenomSingUp').val("");
                         //$('#emailSingUp').val("");
                         //$('#passwordSingUp').val("");

                    }
                }

            });

        }


    });

});


/* ==========================================================================
GESTION DU SYSTEME DE RECHERCHE INSTANTANE
========================================================================== */
$(function () {
    var myArticleResult = $('#articles');

    $('#search_contenu').keyup(function () {
        search();
    });

//fonction de verification du mot recherché en ajax
    function search() {
        var contenu =  $('#search_contenu').val();
        var retour = '';
        $.ajax({
            type: 'GET',
            url: 'Controller/traitement.php',
            data: {
                'search_contenu': contenu
            },
            dataType: 'json',
            success: function (data) {
                if(data.mysearch===''){
                    myArticleResult.empty();
                    $('#output_search').html("\n" +
                        "ex. Pharmacie, Entreprise, super marché, école");
                }
                else{

                    if(data.resultat=='Aucun'){
                        $('#output_search').css({
                            'font-weight': 'bold'
                        }).html('Aucun résultat trouvé pour "' + data.mysearch + '"');
                        myArticleResult.empty();
                        /*setTimeout(function () {
                            $('#output_search').hide();

                        }, 7000);*/
                    }
                    else
                    {
                        if(data.compteur <= 1)
                            retour += data.compteur + ' résultat trouvé';
                        else
                            retour += data.compteur + ' résultats trouvés';

                        myArticleResult.html(data.resultat);
                        $('#output_search').css({
                            'font-weight': 'bold'
                        }).html(retour);

                    }
                }

            }
        });

    }

    //fonction de submit
    $('#search_sujet').submit(function () {
        var search = $('#search_contenu').val();

        if (search == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir la barre de recherche !',
                img: 'img/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            $.ajax({
                type: 'GET',
                url: 'Controller/submit.php?search=search',
                data: {
                    'search_contenu': search
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#enreg_search').attr('value', 'En cours...');
                    $('#loader_articles').html('<div style="display: block;">\n' +
                        '                                    <span class="loader loader-circle"></span>\n' +
                        '                                    Chargement......\n' +
                        '                                </div>');
                },
                success: function (data) {
                    if(data.mysearch===''){
                        myArticleResult.empty();
                        $('#output_search').html("\n" +
                            "ex. Pharmacie, Entreprise, super marché, école");
                    }
                    else{

                        if(data.resultat=='Aucun'){
                            $('#enreg_search').attr('value', 'RECHERCHE');
                            $('#loader_articles').html('<div style="display: none;">\n' +
                                '                                    <span class="loader loader-circle"></span>\n' +
                                '                                    Chargement......\n' +
                                '                                </div>');

                            $('body').notif({
                                title: 'Résultats de Recherche',
                                content: 'Aucun résultat trouvé pour "' + data.mysearch + '"',
                                img: 'img/error-notif.png',
                                cls: 'error1'
                            });

                            $('#output_search').css({
                                'font-weight': 'bold'
                            }).html('Aucun résultat trouvé pour "' + data.mysearch + '"');
                            myArticleResult.empty();

                            /*setTimeout(function () {
                                $(location).attr('href',"index.php?id_page=9");
                            }, 7000);*/
                        }
                        else{

                            if(data.compteur <= 1)
                                retour += data.compteur + ' résultat trouvé';
                            else
                                retour += data.compteur + ' résultats trouvés';


                            $('body').notif({
                                title: 'Résultats de Recherche',
                                content: retour,
                                img: 'img/success-notif.jpg',
                                cls: 'success1'
                            });

                            myArticleResult.html(data.resultat);
                            $('#output_search').css({
                                'font-weight': 'bold'
                            }).html(retour);

                        }
                    }

                }

            });

        }


    });

});


/* ==========================================================================
       GESTION DU SYSTEME DE MODIFICATION
   ========================================================================== */

$(function () {
    /* ==========================================================================
GESTION DU SYSTEME D'INSCRIPTION
========================================================================== */


    $('#emailSingUp1').keyup(function () {
        emailSingUp1();
    });

    $('#emailConfirmSingUp1').keyup(function () {
        emailConfirmSingUp1();
    })

    $('#passwordSingUp1').keyup(function () {
        passwordSingUp1();
    });

    $('#passwordConfirmSingUp1').keyup(function () {
        passwordConfirmSingUp1();
    });

    //fonction de verification du password en ajax
    function emailSingUp1() {

        if($('#emailSingUp').val().length < 4){
            $('#output_emailSingUp').css('color', 'red').html("<br>Votre email est trop court (5 caractères minimum.)");
        }else if($('#emailSingUp').val()!='' && $('#emailSingUp').val()!= $('#emailConfirmSingUp').val()){
            $('#output_emailSingUp').css('color', 'red').html('<br>Les deux addresses emails sont différentes');
            $('#output_emailConfirmSingUp').css('color', 'red').html('<br>Les deux adresses emails sont différentes');
        }else{
            $('#output_emailSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            if($('#emailConfirmSingUp').val()!=''){
                $('#output_emailConfirmSingUp').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            }
        }
    }

    //fonction de verification de l'email de confirmation en ajax
    function emailConfirmSingUp1() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'emailSingUp': $('#emailSingUp').val(),
                'emailConfirmSingUp': $('#emailConfirmSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_emailSingUp1').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    $('#output_emailConfirmSingUp1').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_emailConfirmSingUp1').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification du password en ajax
    function passwordSingUp1() {

        if($('#passwordSingUp1').val().length < 5){
            $('#output_passwordSingUp1').css('color', 'red').html("<br>Trop court (5 caractères minimum.)");
        }else if($('#passwordConfirmSingUp1').val()!='' && $('#passwordConfirmSingUp1').val()!= $('#passwordSingUp1').val()){
            $('#output_passwordSingUp1').css('color', 'red').html('<br>Les deux mots de passe sont différents');
            $('#output_passwordConfirmSingUp1').css('color', 'red').html('<br>Les deux mots de passe sont différents');
        }else{
            $('#output_passwordSingUp1').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            if($('#passwordConfirmSingUp1').val()!=''){
                $('#output_passwordConfirmSingUp1').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
            }
        }
    }



    //fonction de verification du password confirme en ajax
    function passwordConfirmSingUp1() {
        $.ajax({
            type: 'post',
            url: 'Controller/traitement.php?singUp=singUp',
            data: {
                'passwordSingUp': $('#passwordSingUp1').val(),
                'passwordConfirmSingUp': $('#passwordConfirmSingUp1').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_passwordSingUp1').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    $('#output_passwordConfirmSingUp1').html('<img src="img/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_passwordConfirmSingUp1').css('color', 'red').html(data);
                }
            }
        });


    }



    $('#singUp1').submit(function () {
        var nom1 = $('#nomSingUp1').val(),
            prenom1 = $('#prenomSingUp1').val(),
            birth1 = $('#birthSingUp1').val(),
            telephone1 = $('#telSingUp1').val(),
            email2 = $('#emailSingUp1').val(),
            password2 = $('#passwordSingUp1').val();


        if (nom1 == '' || prenom1 == '' || birth1 == ''|| telephone1 == '' || email2 == '' || password2 == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir Tous les Champs !',
                img: 'img/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form1 = $(this);
            var formdata1 = (window.FormData) ? new FormData($form1[0]) : null;
            var donnee1 = (formdata1 !== null) ? formdata1 : $form1.serialize();

            $.ajax({
                type: 'post',
                url: 'Controller/submit.php?singUp1=singUp1',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee1,
                beforeSend: function () {
                    $('#enreg').attr('value', 'En cours...');
                    $('#load_data_SingUp1').html('<div style="display: block;">\n' +
                        '                                    <span class="loader loader-circle"></span>\n' +
                        '                                    Chargement......\n' +
                        '                                </div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#enreg').attr('value', 'Envoyer');
                        $('#load_data_SingUp1').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg').attr('value', 'Envoyer');
                        $('#load_data_SingUp').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singUp1').hide();

                        setTimeout(function () {
                            location.href='members.php';
                        }, 6000);
                        /* $('#nomSingUp').val("");
                         $('#prenomSingUp').val("");
                         $('#emailSingUp').val("");
                         $('#passwordSingUp').val("");*/

                    }
                }

            });

        }


    });

});
