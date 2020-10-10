$(document).ready(function() 
{
	
	$('html, body').animate({scrollTop:$(document).height()}, 2000) 

	$('html, body').animate({scrollTop:0}, 1000) 
	

	/**/	
});


for(var j = 1;j < 5; j++)
{
    
    var iden = "#le_select";

    iden = iden + j;

    console.log(iden);

    $(iden).prop('disabled', true);

    /*array[j]*/
}


function f_affich (e,objet) 
{
    
    var identifiant = (e.target.id);

    var $element_id = ($("#"+e.target.id+" option:selected").val());

    console.log($element_id);

    identifiant = identifiant.substr(9);    

    identifiant = parseInt(identifiant)+1;

    var identifiant_prochain = "#le_select"+identifiant;

    console.log(identifiant_prochain);

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/recettes/elements_restants/ajax",
        data:{id:$element_id},
        
        success:function(data) 
        {

            console.log(data)

            $(identifiant_prochain).html("");

            var to_append = '<option value="------">----------------</option>';                    

            for(var j = 0 ; j < data.length ; j++)
            {

                to_append +='<option value='+data[j].id+'>'+data[j].nom+'</option>'; 

                //
            }

            $(identifiant_prochain).append(to_append);

            $(identifiant_prochain).prop('disabled', false);

            //
        }
    })  


    // body... 
}



var l = 0;

var les_identificateurs = [];

var les_selected = [];

$("select").on('change', function(evenement) 
{

	/*console.log(evenement.target.id);*/

	var identificateur = ($("#"+evenement.target.id+" option:selected").attr('id'));

	les_selected[l] = "#"+evenement.target.id;

	les_identificateurs[l]=($("#"+identificateur).val());

	console.log(les_identificateurs[l]);

	l++;

	/* Act on the evenement */
});


function modifierrecette(event,objet) 
{	
	event.preventDefault();

	console.log(les_identificateurs);

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#recette"+$id;

	var $id=(($(objet)).attr('id'));

	var id_to_hide = "#recette"+$id;

	var id_nom="#nomrecette"+$id;

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

		console.log(les_selected);

	    $.ajax({
	        headers: 
	        {
	           'X-CSRF-TOKEN': $('input[name="_token"]').val()
	        },                    
	        type:"POST",
	        url:"/home/recettes/modifier/ajax",
	        data:{id:$id,nom:$nom,description:$description,duree:l_heure,ingredients:$ingredients,preparation:$preparation,cuisson:l_heure_cuisson,categs:les_identificateurs},
	        
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

		/**/
	}
	// body... 
}




	
