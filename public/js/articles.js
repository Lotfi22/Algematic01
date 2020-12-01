var id_prochain_select = "";

var nb_produits = 1;

function plus1() 
{

	nb_produits = nb_produits+1;

	// body...
}

function moins1() 
{

	nb_produits = nb_produits-1;

	// body...
}


function get_prices(object) 
{   

	var num = (object.id.substr(7));

	var id_prix_achat = "#prix"+num;

	var id_prix_vente = "#prix_vente"+num;

    var $code_produit = $(object).find(":selected").val();

    svt_num = parseInt(num)+1;

    id_prochain_select = "#produit"+(svt_num);

    (id_prochain_select);
    
    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/vente/article/GetPrice",
        data:{id:$code_produit},
        
        success:function(data) 
        {   
            
            $(id_prix_achat).val(data.prix);

            $(id_prix_vente).val(data.prix_vente);

            //
        }
    }); 

    // body...
} 

$("#benifice").hide();	

function fill_arrays(object) 
{

	var quantites = [];

	var prix_achats = [];

	var prix_ventes = [];

	var total_achats = 0;

	var total_ventes = 0;

	for (var i = 0; i < nb_produits; i++) 
	{
		quantites[i] = $("#quantite"+i).val();
		
		prix_achats[i] = $("#prix"+i).val();
		
		prix_ventes[i] = $("#prix_vente"+i).val();

		total_achats = total_achats+parseInt(quantites[i])*parseInt(prix_achats[i]); 

		total_ventes = total_ventes+parseInt(quantites[i])*parseInt(prix_ventes[i]); 
	}

	$("#Prix_propose").val(total_ventes);

	var benifice = (new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(total_ventes-total_achats));

	$("#benifice").text('Le bénifice de l\'Article est : '+ benifice +'DA');

	$("#fayda").val(total_ventes-total_achats);
	
	$("#benifice").show(1000);

	
	// body...
}

function fit_benifice(object) 
{

	var quantites = [];

	var prix_achats = [];

	var prix_ventes = [];

	var total_achats = 0;

	var total_ventes = 0;

	for (var i = 0; i < nb_produits; i++) 
	{
		quantites[i] = $("#quantite"+i).val();
		
		prix_achats[i] = $("#prix"+i).val();
		
		prix_ventes[i] = $("#prix_vente"+i).val();

		total_achats = total_achats+parseInt(quantites[i])*parseInt(prix_achats[i]); 
	}

	/*$("#Prix_propose").val(total_ventes);*/

	var prix_vente = ($("#Prix_propose").val());

	var benifice = (new Intl.NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(prix_vente-total_achats));

	$("#benifice").text('Le bénifice de l\'Article est : '+ benifice +'DA');
	
	$("#fayda").val(prix_vente-total_achats);

	$("#benifice").show(1000);



	// body...
}

/*$("#Prix_propose").bind('keyup mouseup', function () 
{
    alert("changed");            
});*/