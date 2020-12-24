function modifieractivite(event,objet) 
{	
	
	event.preventDefault();

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#activite"+$id;

	var id_nom="#nomactivite"+$id;

	var id_desc="#description"+$id;

	var $nom=$(id_nom).val();

	var $description=$(id_desc).val();

	$(id_to_hide).hide(500, function() 
	{
		$(id_to_hide).attr('class','alert alert-success');

		$(id_to_hide).show(1500);	        		
	});

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/activites/modifier/ajax",
        data:{id:$id,nom:$nom,description:$description},

        success:function(data) 
        {

        	//
		}
	})	
	// body... 
}
