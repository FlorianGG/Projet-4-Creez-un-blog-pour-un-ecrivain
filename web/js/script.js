$(document).ready(function(){
    $(".buttonComment").click(function(){
    	$('.formComment').hide();
        $(this).next('.formComment').toggle();
    });
    $(".buttonDisplay").click(function(){
    	$(this).next('.children').slideToggle();
    	if ($(this).text() === 'Afficher réponses') {
    		$(this).text('Cacher réponses');
    	}else{
    		$(this).text('Afficher réponses');
    	}
    });
});

$(document).ready(function(){
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
});


