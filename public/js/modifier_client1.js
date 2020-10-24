$("#info2").hide(0);
$("#info3").hide(0);




function f_affich1() 
{

	$("#info2").hide(1000, function() 
	{

		
		$("#info1").show(1000);

		
		//	
	});


	// body...
}

function f_affich2() 
{

	$("#info1").hide(1000, function() 
	{

				
		
		$("#info2").show(1000);

		
		//	
	});


	// body...
}

function f_affich3() 
{

	$("#info1").hide(1000, function() 
	{

		$("#info2").hide('slow/400/fast', function() 
		{
			
			$("#info3").show(1000);

			//	
		});
		
		//	
	});


	// body...
}

function changer() 
{
	
	if($("#client_inter_fact").val() == "OUI")
	{

		$("#to_display").show(1000)

		//
	}
	else
	{

		$("#to_display").hide(1000)		

		//
	}		

	// body...
}

function Valider_info2(e) 
{

	e.preventDefault();

	nis = $("#NISduclient").val()
	nif = $("#NIF").val()
	RC = $("#RC").val()
	n_art_imp = $("#n_art_imp").val()
	taux_remise_spec = $("#taux_remise_spec").val()
	client_inter_fact = $("#client_inter_fact").val()
	motif_interd = $("#motif_interd").val()
	type = $("#formulaire2 input[type='radio']:checked").val();
	id_client = $("#id_client").val()
    
    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/clients/modifier/ajax",
        data:{nis:nis,nif:nif,RC:RC,n_art_imp:n_art_imp,taux_remise_spec:taux_remise_spec,client_inter_fact:client_inter_fact,motif_interd:motif_interd,type:type,id_client:id_client},

        success:function(data) 
        {
        	$("#info2").fadeToggle(1000, function() 
        	{
        		
        		$("#info2").addClass("alert alert-success");
        		$("#info2").fadeToggle(1000);	
        		//
        	});

        	//
		},
		error: function(xhr, status, error) 
		{

        	$("#info2").fadeToggle(1000, function() 
        	{
        		
        		$("#info2").addClass("alert alert-warning");
        		$("#info2").fadeToggle(1000);	
        		$("#icierreur").text(xhr.responseJSON.errors.taux_remise_spec[0])
        		//
        	});

        	//
		}
	})	


	// body...
}