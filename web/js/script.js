$(document).ready(function(){
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
 			url : 'http://localhost/Projet4/Projet-4-Creez-un-blog-pour-un-ecrivain/?interface=admin&controller=article&action=draft&id='+id,
 			type : 'POST',
 			data : 'id=' + id,
 			dataType : 'html',
 			success : function(statut){ // code_html contient le HTML renvoyé
 				if ($('#tr'+ id).attr('class') === 'danger') {
 					$('#tr'+ id).removeClass('danger');
 				}else{
 					$('#tr'+ id).addClass('danger');
 				}
 				var message = '<div class="alert alert-success alert-dismissable fade in">' +
                    			'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                   			'<i class="icon icon-check-circle icon-lg"></i>' +
                				'<strong>Succès !</strong> Statut de l\'article modifié' +
             				'</div>';
 				$('#message').html(message);
 			    
 			},
 			error : function(statut, erreur){
   				var message = '<div class="alert alert-danger alert-dismissable fade in">' +
                      			'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                     			'<i class="icon icon-check-circle icon-lg"></i>' +
                  				'<strong>Succès !</strong> Une erreur est survenue' +
               				'</div>';
               	$('#message').html(message);
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
});



