$(document).ready(function(){
	
open();
showUsers();
});

// READ USERS
function showUsers(){
	// read and show the records after at least a second
	// we use setTimeout just to show the image loading effect when you have a very fast server
	// otherwise, you can just do: $('#pageContent').load('read.php', function(){ $('#loaderImage').hide(); });
	// THIS also hides the loader image
	setTimeout("$('#pageContent').load('http://localhost/noc/dashboard/listarUsuario', function(){ $('#loaderImage').hide(); });", 1000);
     
}




function open(){
    
    	
	$(document).on('click', '#clic', function(){ 
            var id = $(this).attr('rel');
        console.log(id);
	
		var link="http://localhost/noc/"+id;
		
		// show a loader image
		$('#loaderImage').show();

		// read and show the records after 1 second
		// we use setTimeout just to show the image loading effect when you have a very fast server
		// otherwise, you can just do: $('#pageContent').load('update_form.php?user_id=" + user_id + "', function(){ $('#loaderImage').hide(); });
		setTimeout("$('#pageContent').load('"+link+"', function(){ $('#loaderImage').hide(); });",1000);
		
	});
    
}


  