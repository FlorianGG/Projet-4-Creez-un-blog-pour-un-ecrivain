$(document).ready(function(){
    $(".buttonComment").click(function(){
    	$('.formComment').hide();
        $(this).next('.formComment').toggle();
    });
});




