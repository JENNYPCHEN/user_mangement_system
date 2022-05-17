$().ready(function() {

    $("#user_form").validate({
        rules: {
            name: {
                required: true,
                minlength: 5,
                maxlength:10
            },
            email: {
                required: true,
                email:true,
            },
            password: {
                required: true,
                minlength: 5,
            },
            password_confirmation: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
        },
        messages: {

            name : "Veuillez saisir un nom d'utilisateur entre 5 et 10 caractères.",
       
            email:  "Veuillez saisir une adresse email valide",
        
             password: {
                required: "veuillez entrer un mot de passe d'au moins 5 caractères",
                minlength:"veuillez entrer un mot de passe d'au moins 5 caractères"
            },
            password_confirmation: {
                required: "veuillez entrer un mot de passe d'au moins 5 caractères",
                minlength:"veuillez entrer un mot de passe d'au moins 5 caractères",
                equalTo: "Veuillez entrer le même mot de passe "
            },
            submitHandler: function (form) {
                alert('valid form');
                return false;
              }
        },
    })
});