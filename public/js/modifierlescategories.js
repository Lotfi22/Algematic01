function modifiercategorie(event,objet) 
{	
	
	event.preventDefault();

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#categorie"+$id;

	var id_nom="#nomcategorie"+$id;

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
        url:"/home/categories/modifier/ajax",
        data:{id:$id,nom:$nom,description:$description},

        success:function(data) 
        {

        	//
		}
	})	
	// body... 
}

function supprimercategorie (event,objet) 
{

	event.preventDefault();

	$id=(objet.getAttribute('id'));

	$id=($id.substr(3));

	var id_hide="#categorie"+$id;

	console.log(id_hide)

	$(id_hide).hide(1000);

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/categories/supprimer/ajax",
        data:{id:$id},

        success:function(data) 
        {

        	//
		}
	});	

	// body... 
}

function ajoutercategorie(event,ojbet) 
{

	event.preventDefault();

	var $nom = $("#nomducategorie").val();

	var $num = $("#numducategorie").val();

	var $desc = $("#descducategorie").val();

	var new_id = $(ojbet).attr('id');

	var xx=new_id;

	new_id=(new_id.substr(5));

	new_id = parseInt(new_id)+1;

	console.log(new_id);
	
	var to_append = '<tr class="alert alert-success" id="categorie'+new_id+'"><form>{{ csrf_field() }} <td>'+$num+'</td><td colspan="2"><div class="form-group col-md-12 col-sm-12">'

	to_append+='<label><textarea type="text" rows="4" name="nom" class=" form-control" id="nomcategorie'+new_id+'" value="'+$nom+'">'+$nom+'</textarea></label>'

	to_append+='</div></td>'

	to_append+='<td colspan="2"> <textarea type="text" rows="5" class="form-control" name="description" id="description'+new_id+'" value="'+$desc+'">'+$desc+'</textarea></td>'

	to_append+='<td><button class="btn btn-success btn-sm" id="'+new_id+'" onclick="modifiercategorie(event,this)"> Enregistrer</button></td>'

	to_append+='<td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-'+new_id+'" style="color: #fff;"> supprimer</a><div id="myModalsup-'+new_id+'" class="modal fade" role="dialog">'

	to_append+='<div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Voulez-vous vraiment supprimer ce categorie</h4></div>'

	to_append+='<div class="modal-body"><button class="col-md-5 btn btn-success" onclick="supprimercategorie(event,this)" data-dismiss="modal" id="mod'+new_id+'">OUI,je supprime</button><a data-dismiss="modal" class="col-md-6 btn btn-danger">NON,je ne veux pas supprimer</a></div><div class="modal-footer"><button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button></div></div></div></div></td></form></tr>'

	to_append=$(to_append)	

	to_append=$(to_append)	

	to_append.hide(0);

	$("#all_the_categories").append(to_append).show(1500);

	to_append.show(1500)

	var newest=new_id+1;

	console.log('le newest : ');
	console.log(newest);

	var xxx = "#"+xx;

	console.log($(xxx));

	newest="ajout"+newest;

	$(xxx).attr('id',newest);

	$('html, body').animate({scrollTop:$(document).height()}, 'slow');

	$("#nomducategorie").val("");
	$("#descducategorie").val("");

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/categories/ajouter/ajax",
        data:{nom:$nom,description:$desc},

        success:function(data) 
        {

        	//
		}
	});	

	// body... 
}


