$(document).ready(function(){

	console.log('jquery ok');

	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	//AJAX RESULTATS
	$("#searchUsers").on('keyup',function(e){
		var $form = $(this).parent().parent();
        var $url = $form.attr('action');
        var user_name = $form.find("input[name=user_name]").val();

        $.ajax({
           type:'POST',
           url:$url,
           data:{
           	user_name:user_name
           },
           success:function(data){
           		//console.log(data);
           		var users = data;
           		var $users_list = $('.content').find('tbody');
           		var html ="";
           		$url = window.location.href;

           		$users_list.empty();
           		
           		for(var i = 0 ; i < data.length ; i++){
           			console.log(data[i]);
           			html += "<tr>";
           			html += "<td>"+data[i].id+"</td>";
           			html += "<td>"+data[i].name+"</td>";
           			html += "<td>"+data[i].email+"</td>";
           			html += "<td>"+data[i].role+"</td>";
           			html += "<td>";
           			html += "<form class='inline-block' action='' method='POST'><button class='btn' type='submit'><i class='pe-7s-close'></i>Supprimer</button></form>";
           			html += '<form class="inline-block" action="'+$url+'/'+data[i].id+'" method="GET"><button class="btn" type="submit"><i class="pe-7s-edit"></i>Modifier</button></form>';
           			html += "</td";
           			html += "</tr>";
           		}

           		$users_list.html(html);
           },
           error:function(data){
           }
        });

	});

});