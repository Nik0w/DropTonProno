//FB API
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '259319921558324',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.1'
    });
      
    FB.AppEvents.logPageView();
    
    FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

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

});