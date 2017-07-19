$(document).ready(function(){
    $(".buttonComment").click(function(){
    	$('.formComment').hide();
        $(this).next('.formComment').toggle();
    });
});
$(document).ready(function(){
	$(".buttonDisplay").click(function(){
		$(this).next('.children').slideToggle();
		if ($(this).text() === 'Afficher réponses') {
			$(this).text('Cacher réponses');
		}else{
			$(this).text('Afficher réponses');
		}
	});
});




