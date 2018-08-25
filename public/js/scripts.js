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

	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	//AJAX RESULTATS
	$(".submitProno").click(function(e){

		var $form = $(this).parent().parent().parent().parent();
		$form.on('submit',function(e){
			e.preventDefault();	        
	        var $form = $(this);

	        var $url = document.location.href;
	        var $btn = $(this).find('#submitProno');

	        var match = $form.find("input[name=match]").val();
	        var score_equipe1 = $form.find("input[name=score_equipe1]").val();
	        var score_equipe2 = $form.find("input[name=score_equipe2]").val();
	        var score_essais = $form.find("input[name=score_essais]").val();

	    	$btn.html('<i class="fas fa-sync-alt refresh"></i>');

	        $.ajax({
	           type:'POST',
	           url:$url,
	           data:{
	           	score_equipe1:score_equipe1,
	           	score_equipe2:score_equipe2,
	           	score_essais:score_essais,
	           	match:match
	           },
	           success:function(message){
	              console.log(message);
	              if(!message.success){
	              	$btn.html(message.message);
	           		$btn.css({'background-color':'#dc6868'});
	           	}else{
	              $btn.html(message.message);
	              $btn.css({'background-color':'#68dc86'});
	           	}
	           },
	           error:function(e){
	           		console.log(e);
	           		$btn.html(message.message);
	           		$btn.css({'background-color':'#dc6868'});
	           }
	        });
	    });

	});

});