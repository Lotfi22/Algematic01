function modifiertv(event,objet) 
{	
	
	event.preventDefault();

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#tv"+$id;

	var id_nom="#nomtv"+$id;

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
        url:"/home/tvs/modifier/ajax",
        data:{id:$id,nom:$nom,description:$description},

        success:function(data) 
        {

        	//
		}
	})	
	// body... 
}

function supprimertv (event,objet) 
{

	event.preventDefault();

	$id=(objet.getAttribute('id'));

	$id=($id.substr(3));

	var id_hide="#tv"+$id;

	console.log(id_hide)

	$(id_hide).hide(1000);

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/tvs/supprimer/ajax",
        data:{id:$id},

        success:function(data) 
        {

        	//
		}
	});	

	// body... 
}

function ajoutertv(event,ojbet) 
{

	event.preventDefault();

	var $nom = $("#nomdutv").val();

	var $desc = $("#descdutv").val();

	var $lien = $("#liendutv").val();

	console.log($lien);

	var new_id = $(ojbet).attr('id');

	var xx=new_id;

	new_id=(new_id.substr(5));

	new_id = parseInt(new_id)+1;

	console.log(new_id);
	
	var to_append = '<tr class="alert alert-success" id="tv'+new_id+'"><form>{{ csrf_field() }} <td>'+new_id+'</td>'                                                

	to_append+= '<td colspan="2"><div class="form-group col-md-12 col-sm-12">{{'+$lien+'}}</div></td>'

	to_append+='<td colspan="2"><div class="form-group col-md-12 col-sm-12"><label><p id="nomtv'+new_id+'" value="'+$nom+'">'+$nom+'</p></label>'

	to_append+='</div></td>'

	to_append+='<td colspan="2"> <p name="description" id="description'+new_id+'" value="'+$desc+'">'+$desc+'</p></td>'

	/*to_append+='<td><button class="btn btn-success btn-sm" id="'+new_id+'" onclick="modifiertv(event,this)"> Enregistrer</button></td>'*/

	to_append+='<td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-'+new_id+'" style="color: #fff;"> supprimer</a><div id="myModalsup-'+new_id+'" class="modal fade" role="dialog">'

	to_append+='<div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Voulez-vous vraiment supprimer ce tv</h4></div>'

	to_append+='<div class="modal-body"><button class="col-md-5 btn btn-success" onclick="supprimertv(event,this)" data-dismiss="modal" id="mod'+new_id+'">OUI,je supprime</button><a data-dismiss="modal" class="col-md-6 btn btn-danger">NON,je ne veux pas supprimer</a></div><div class="modal-footer"><button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button></div></div></div></div></td></form></tr>'

	to_append=$(to_append)	

	to_append=$(to_append)	

	to_append.hide(0);

	$("#all_the_tvs").append(to_append).show(1500);

	to_append.show(1500)

	var newest=new_id+1;

	console.log('le newest : ');
	console.log(newest);

	var xxx = "#"+xx;

	console.log($(xxx));

	newest="ajout"+newest;

	$(xxx).attr('id',newest);

	$('html, body').animate({scrollTop:$(document).height()}, 'slow');

	$("#nomdutv").val("");
	$("#descdutv").val("");

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/tvs/ajouter/ajax",
        data:{nom:$nom,description:$desc,lien:$lien},

        success:function(data) 
        {

        	//
		}
	});	

	// body... 
}


