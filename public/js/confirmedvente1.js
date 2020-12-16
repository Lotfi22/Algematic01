$(".RDG").hide(0);

$("#les_docccs").hide();    

function show_d_f2(object) 
{

    if($(object).find(":selected").val() == "OUI")
    {

        $("#les_docccs").show(1000);        

        //
    }
    else
    {

        $("#les_docccs").hide(1000);        

        //
    }    

    // body...
}


function affiche_RDG() 
{
	
	$(".RDG").show(1000);	

	//	
}

function hide_RDG() 
{
	
	$(".RDG").hide(1000);

	//	
}

var total_total = 0;

function get_preventes(object) 
{
	var num = parseInt(object.id.substr(8));

	var la_prevente = "#la_prevente"+num;
	
	var id_prevente = ($(object).find(":selected").val());
	
	$(la_prevente).val(id_prevente);

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/vente/VenteConfirmed/GetPrice",
        data:{id:id_prevente},
        
        success:function(data) 
        {   

            console.log(data);

            total_total = parseInt(total_total) + parseInt(data.montant);

            $("#reste").val(total_total);

            $(object).prop('disabled', true);

            //
        }
    }); 

	// body...
}

var i = 0;

var restes = [];

function fit_reste(object) 
{

	var avance = parseInt($("#avance").val());

	if (isNaN(avance)) 
	{
		
		avance = 0;
		
		//
	}
	
	restes[i] = parseInt($("#reste").val());
	i++;
	
	var fit_reste = restes[1]-avance;

	$("#reste").val(parseInt(fit_reste));

	// body...
}

function fit_rdg(object) 
{	

	var pourcentage = parseInt($(object).val());

	var reste = ($("#reste").val());

	var avance = ($("#avance").val());
	
	var total = parseInt(reste) + parseInt(avance);
	
	var rdg = total*(pourcentage/100); 
	
	$("#RDG").val(rdg);
	// 
}