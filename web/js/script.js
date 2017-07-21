$(document).ready(function(){
    //Cache les éléments qui seront affichés avec jquery afin d'éviter des bug si utilisateur a désactivé javascript
    $('.formComment').hide();
    $('.children').hide();

    // Animation sur le bouton qui fait apparaitre un formulaire pour saisir un commentaire
    $(".buttonComment").click(function(){
    	$('.formComment').hide();
        $(this).next('.formComment').toggle();
    });
    // Animation sur le bouton qui fait apparaitre ou disparaitre les réponses d'un commentaire
    $(".buttonDisplay").click(function(){
    	$(this).next('.children').slideToggle();
    	if ($(this).text() === 'Afficher réponses') {
    		$(this).text('Cacher réponses');
    	}else{
    		$(this).text('Afficher réponses');
    	}
    });

    // Requête ajax qui permet de changer le statut brouillon d'un article directement en cliquant sur un bouton
    // Disponible sur la page admin/article/index
   	$(".buttonDraft").click(function(){
   		var idArticle = '#isDraft' + $(this).val();
   		var id = $(this).val();
   		$.ajax({
   			url : url+id,
   			type : 'POST',
   			data : 'id=' + id,
   			dataType : 'html',
   			success : function(statut){
          $('#divMessage').show();
   				if ($('#tr'+ id).attr('class') === 'danger') {
   					$('#tr'+ id).removeClass('danger');
   				}else{
   					$('#tr'+ id).addClass('danger');
   				}
          $('#divMessage').addClass('alert alert-success fade in');
   				var message = 'Statut de l\'article modifié';
   				$('#message').html(message);
          $('#divMessage').delay(900).fadeOut('slow');
   			    
   			},
   			error : function(statut, erreur){
          $('#divMessage').show();
          $('#divMessage').addClass('alert alert-success fade in');
          var message = 'Une erreur est survenue';
          $('#message').html(message);
          $('#divMessage').delay(900).fadeOut('slow');

   			}
   		});
   	});

    //Add scrollspy and smooth scrolling
    // Add scrollspy to <body>
    $('body').scrollspy({target: ".navbar", offset: 50});

    // Add smooth scrolling on all links inside the navbar
    $("#myNavbar a").on('click', function(event) {

      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });

      } // End if
    });  

    //Verification des champs du formulaire d'inscription utilisateur
    var $pass1 = $('#pass1');
    var $pass2 = $('#pass2');

    $pass2.keyup(function(){
        if($(this).val() != $pass1.val()){ // si la confirmation est différente du mot de passe
            $('#passError').addClass('has-error has-feedback');
            $('#glyph').show();
            $('#validation').attr('disabled', 'disabled');

        }else{
          $('#passError').removeClass('has-error has-feedback');
          $('#passError').addClass('has-success has-feedback');
          $('#glyph').hide();
          $('#validation').attr('disabled', null);
        }
    });

    //Gestion de l'id sur les boutons supprimer comment qui appel une modal pour les comments de niveau 1
    $('#modalComment1').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);// Button that triggered the modal
      var recipient = button.data('whatever'); // Extract info from data-* attributes
      var array = recipient.split('/');
      console.log(urlToDeleteComment);
      $('#modalComment1 div div div a').attr('href',urlToDeleteComment+array[0]+'&article='+array[1]);
    });

    //Gestion de l'id sur les boutons supprimer article qui appel une modal
    $('#modalArticle').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);// Button that triggered the modal
      var recipient = button.data('whatever'); // Extract info from data-* attributes
      $('#modalArticle div div div a').attr('href',urlToDeleteArticle+recipient);
    });

    //Gestion de l'id sur les boutons supprimer comment qui appel une modal pour les comments de niveau 2
    $('#modalComment2').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);// Button that triggered the modal
      var recipient = button.data('whatever'); // Extract info from data-* attributes
      var array = recipient.split('/');
      console.log(urlToDeleteComment);
      $('#modalComment2 div div div a').attr('href',urlToDeleteComment+array[0]+'&article='+array[1]);
    });

});




