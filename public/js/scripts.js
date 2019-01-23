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


	//PHOTO DE PROFIL 
	$('.input-file').change(function(){
		$('#form-img-profil').submit();
	});

	// AJAX HEADER
	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	//AJAX RESULTATS
	$(".submitProno").on('click',function(e){
		var $form = $(this).parent().parent().parent().parent();
		$form.off('submit').on('submit',function(e){
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
              		if(!message.success){
	              		$btn.html(message.message);
	           			$btn.css({'background-color':'#dc6868'});
           			}else{
	              		$btn.html(message.message);
	              		$btn.css({'background-color':'#68dc86'});
	           		}
	           },
	           error:function(e){
	           		$btn.html(message.message);
	           		$btn.css({'background-color':'#dc6868'});
	           }
	        });
	    });

	});

	//AJAX FAVORIS
	$(document).on('click', '.submitFavoris', function(e){

		var $form = $(this).parent();

		$form.off('submit').on('submit',function(e){
			e.preventDefault();	        
	        var $form = $(this);

	        var $url = document.location.href;
	        var $btn = $(this).find('.submitFavoris');

	        var id = $form.find("input[name=id_user]").val();

	        $.ajax({
	           type:'POST',
	           url:$url,
	           data:{
	           	id_user:id,
	           },
	           success:function(message){
	           		if($btn.find('i').hasClass('fas')){
           				$btn.html('<i class="far fa-star"></i>');
	           		}else{
	           			$btn.html('<i class="fas fa-star color-orange"></i>');
	           		}
	           },
	           error:function(e){
	           		
	           }
	        });
	    });

	});

	// AJAX SEARCH FRIENDS
	$("#searchFriends").on('keyup',function(e){
		var $form = $(this).parent().parent();
        var $url = $form.attr('action');
        var user_name = $form.find("input[name=searchFriends]").val();

        if(user_name.length > 2){

	        $.ajax({
	           type:'POST',
	           url:$url,
	           data:{
	           	user_name:user_name
	           },
	           success:function(data){
	           		//console.log(data);
	           		var $users_list = $('#searchFriendsResults');
	           		var html ="";
	           		var csrf = $('meta[name="csrf-token"]').attr('content');
	           		$url = window.location.href;

           			var users = data[0];
           			var favoris = data[1].favoris_ids.split(",");

	           		$users_list.empty();
	           		
	           		for(var i = 0 ; i < users.length ; i++){
	           			//console.log(data[i]);
	           			html += "<tr class='searchResultsList'>";
	           			html += "<td style='padding:5px; width:100%;'>"+users[i].name+"</td>";
           				html += "<td style='padding:5px;'>";
           				html += "<form class='form-favoris' action='' method='POST'>";
           				html += "<input type='hidden' name='_token' value='"+csrf+"'>";
           				html += "<input type='hidden' name='id_user' value='"+users[i].id+"'>";
           				html += "<button type='submit' name='submitFavoris' class='submitFavoris'>";
	           			if(favoris.includes(users[i].id.toString())){
	           				html += "<i class='fas fa-star color-orange'></i>";
	           			}else{
           					html += "<i class='fas fa-star'></i>";
	           			}
	           			html += "</button>";
	           			html += "</form>";
           				html += "</td>";
           				html += "</tr>";
	           		}

	           		$users_list.html(html);

	           		// ON INIT LA BARRE DE SCROLL PERSO
	           		var el = new SimpleBar(document.getElementById('searchFriendsResults'));
	           },
	           error:function(data){
	           }
	        });

        }


	});

	//_______________________________
	//
	//            UX
	//_______________________________

	//Page switching loader

	$('a').not('.no-loader').on('click',function(ev){
		//ev.preventDefault();
		$('body').prepend('<div class="pageLoader"><i class="fas fa-spinner"></i></div>');

	});

	//Gestion de l'affichage ou non du la searchBox
	$( "#searchFriends" )
		.focus(function() {
			$('#searchFriendsResults').show();
		})
		.focusout(function() {
			$('#searchFriendsResults').hide();
		});

});