$(document).ready(function(){

	// GESTION DE LA BARRE DE MENU
	var $navbar = $('#navbar');
	var $spacer = $('#menuSpacer');
	var navHeight = $('#navbar').height();

	var sticky = navbar[0].offsetTop;

	$(window).on('scroll',function(){
		if (window.pageYOffset >= sticky + navHeight) {
		    $navbar.addClass("sticky");
		    $spacer.css({'height':navHeight+'px'});
	  	} else if(window.pageYOffset == 0){
		    $navbar.removeClass("sticky");
		    $spacer.css({'height':+'0'});
	  	}
	})

	//GESTION DU CAROUSEL
	$('.carousel').carousel({
	  interval: false
	});

	//CHANGE PAGE ON SELECT CHANGE FOR MOBILE
	$(".select_journee").change(function() {
		var $link = $(this).find('option:selected').data('link');
  		window.location.href = $link;
	});

	$('.input-file').change(function(){
		$('#form-img-profil').submit();
	});

});