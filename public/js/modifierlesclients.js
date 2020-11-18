/*function modifierclient(event,objet) 
{	
	event.preventDefault();

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#client"+$id;

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#client"+$id;

	var id_nom="#nomclient"+$id;

	var id_desc="#description"+$id;

	var id_ingred="#ingredients"+$id;

	var id_prepa="#preparation"+$id;

	var id_dureemin="#dureemin"+$id

	var id_dureeh="#dureeh"+$id

	var id_dureecuissonh="#dureecuissonh"+$id

	var id_dureecuissonmin="#dureecuissonmin"+$id

	var $nom=$(id_nom).val();

	var $description=$(id_desc).val();

	var $ingredients=$(id_ingred).val();

	var $preparation=$(id_prepa).val();

	var $heure = $(id_dureeh).val();

	var $min = $(id_dureemin).val();

	var $dureecuissonh = $(id_dureecuissonh).val();
	
	var $dureecuissonmin = $(id_dureecuissonmin).val();

	if (( ($nom.length!=0) && ($description.length!=0) && ($min.length!=0) && ($heure.length!=0 ) && ($ingredients.length!=0) && ($preparation.length!=0) && ($dureecuissonh>0))) 
	{
		
		console.log($heure.length);
		
		if ($heure.length==1){$heure="0"+$heure; $(id_dureeh).val($heure);} 

		if ($min.length==1){$min="0"+$min;$(id_dureemin).val($min);} 

		var l_heure = $heure + ":" + $min;		

		if ($dureecuissonh.length==1){$dureecuissonh="0"+$dureecuissonh; $(id_dureecuissonh).val($dureecuissonh);} 

		if ($dureecuissonmin.length==1){$dureecuissonmin="0"+$dureecuissonmin;$(id_dureecuissonmin).val($dureecuissonmin);} 

		var l_heure_cuisson = $dureecuissonh + ":" + $dureecuissonmin;

		console.log(l_heure_cuisson);
		
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
	        url:"/home/clients/modifier/ajax",
	        data:{id:$id,nom:$nom,description:$description,duree:l_heure,ingredients:$ingredients,preparation:$preparation,cuisson:l_heure_cuisson},

	        success:function(data) 
	        {

	        	//
			}
		})	
	}	
	else
	{

		$(id_to_hide).hide(500, function() 
		{
			$(id_to_hide).attr('class','alert alert-warning');

			$(id_to_hide).show(1500);	        		
		});

		
	}
	// body... 
}
*/
function supprimerclient (event,objet) 
{

	event.preventDefault();

	$id=(objet.getAttribute('id'));
	
	$id=($id.substr(3));
	
	var id_hide="#client"+$id;

	console.log(id_hide)

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/clients/supprimer/ajax",
        data:{id:$id},

        success:function(data) 
        {

			$(id_hide).hide(1000);

        	//
		}
	});	

	// body... 
}

function ajouterclient(event,ojbet) 
{

	event.preventDefault();

	var $nom = $("#nomduclient").val();

	var $desc = $("#descduclient").val();

	var dureemin = $("#dureemin").val();

	var dureeh = $("#dureeh").val();

	if ( ($nom.length==0) || ($desc.length==0) || ($dureemin.length==0) || (($dureeh.length==0)) ) 
	{



		/**/
	}
	else
	{


		if (dureeh.length==1){dureeh="0"+dureeh;} 

		if (dureemin.length==1){dureemin="0"+dureemin;} 

		var l_heure = dureeh + ":" + dureemin;

		var new_id = $(ojbet).attr('id');

		var xx=new_id;


		console.log('le 2eme');
		console.log(new_id);

		new_id=(new_id.substr(5));

		console.log(new_id);

		new_id = parseInt(new_id)+1;

		console.log("le new_id : ");
		console.log(new_id);
		
		var to_append = '<tr class="alert alert-success" id="client'+new_id+'"><form>{{ csrf_field() }} <td></td><td colspan="2"><div class="form-group col-md-12 col-sm-12">'                                                

		to_append+='<label><textarea type="text" rows="4" name="nom" class=" form-control" id="nomclient'+new_id+'" value="'+$nom+'">'+$nom+'</textarea></label>'

		to_append+='</div></td>'

		to_append+='<td colspan="2"> <textarea type="text" rows="10" class="form-control" name="description" id="description'+new_id+'" value="'+$desc+'">'+$desc+'</textarea></td>'

		to_append+='<td colspan="2"><label for="dureeh'+new_id+'"> Heures </label> <input type="number" value="'+dureeh+'" min="0" class="form-control" max="23" placeholder="23" id="dureeh'+new_id+'">'
	    	
	    to_append+='<label for="dureemin'+new_id+'"> Minutes </label> <input type="number" value="'+dureemin+'" min="00" class="form-control" max="59" placeholder="10"'	
				
		to_append+='id="dureemin'+new_id+'">'
				
		to_append+='</td>'


		to_append+='<td><button class="btn btn-success btn-sm" id="'+new_id+'" onclick="modifierclient(event,this)"> Enregistrer</button></td>'

		to_append+='<td><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-'+new_id+'" style="color: #fff;"> supprimer</a><div id="myModalsup-'+new_id+'" class="modal fade" role="dialog">'

		to_append+='<div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Voulez-vous vraiment supprimer ce client</h4></div>'

		to_append+='<div class="modal-body"><button class="col-md-5 btn btn-success" onclick="supprimerclient(event,this)" data-dismiss="modal" id="mod'+new_id+'">OUI,je supprime</button><a data-dismiss="modal" class="col-md-6 btn btn-danger">NON,je ne veux pas supprimer</a></div><div class="modal-footer"><button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button></div></div></div></div></td></form></tr>'

		to_append=$(to_append)	

		to_append.hide(0);

		$("#all_the_clients").append(to_append).show(1500);

		to_append.show(1500)

		var newest=new_id+1;

		console.log('le newest : ');
		console.log(newest);

		var xxx = "#"+xx;

		console.log($(xxx));

		newest="ajout"+newest;

		$(xxx).attr('id',newest);

		$('html, body').animate({scrollTop:$(document).height()}, 'slow');

		$("#nomduclient").val("");
		$("#descduclient").val("");

	    $.ajax({
	        headers: 
	        {
	           'X-CSRF-TOKEN': $('input[name="_token"]').val()
	        },                    
	        type:"POST",
	        url:"/home/clients/ajouter/ajax",
	        data:{nom:$nom,description:$desc,duree:l_heure},

	        success:function(data) 
	        {

	        	//
			}
		});	




		/**/
	}


	// body... 
}







