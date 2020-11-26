$("#ventes_prestations").hide();
$("#ventes_articles").hide();

function afficher_que_prestations()
{
    
    $("#ventes_produits").hide(1000, function() 
    {
        $("#ventes_articles").hide(1000, function()   
        {
            $("#demandedevente").fadeToggle();

            $("#ventes_prestations").show(500) 

            $("#demandedevente").text('Demande De Vente de Préstations')

            $("#demandedevente").fadeToggle(700);

            //    
        });                

        //    
    });                                

    // 
}

function afficher_que_produits() 
{
    
    $("#ventes_prestations").hide(1000, function() 
    {
        
        $("#ventes_articles").hide(1000, function()   
        {
            $("#demandedevente").fadeToggle();

            $("#ventes_produits").show(500)

            $("#demandedevente").text('Demande De Vente De Produits') 

            $("#demandedevente").fadeToggle(700);

            //    
        });                

        //    
    });                                

    // 
}

function afficher_que_articles() 
{
    
    $("#ventes_prestations").hide(1000, function() 
    {
        
        $("#ventes_produits").hide(1000, function()   
        {
            $("#demandedevente").fadeToggle();

            $("#ventes_articles").show(500) 

            $("#demandedevente").text('Demande De Vente D\'Articles')

            $("#demandedevente").fadeToggle(700);

            //    
        });                

        //    
    });                                
}    

id_prochain_select = "";

var li_rah = [{id: "ZZXWEEVBD", code_produit: " ", description: "  "}];

function get_prices(object) 
{

    var $id = $(object).find(":selected").val();

    var num =(object.id.substr(object.id.length-1))

    var new_id = "#quantite_dispo"+num;

    var prix_new_id = "#prix_prod"+num;

    svt_num = parseInt(num)+1;

    id_prochain_select = "#produits"+(svt_num)

    for (var i = 0; i < produits.length; i++) 
    {
        
        if (produits[i].id == $id)
        {
            
            produits.splice(i, 1);
            
            //
        }

        //
    }


    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/vente/DemandeVente/GetPrice",
        data:{id:$id},
        
        success:function(data) 
        {   

            console.log(data);

            $(new_id).val(data.quantite);

            $(prix_new_id).val(data.prix);  

            $("#"+object.id).prop('disabled', true);             

            //
        }
    }); 

    // body...
}

function get_stock(object) 
{
    
    var num =(object.id.substr(object.id.length-1))

    var new_id = "#quantite_dispo"+num;

    var qte_dispo = $(new_id).val()

    var qte_demandee = ($(object).val())
    
    if(parseInt(qte_demandee) > parseInt(qte_dispo))
    {
            
        $(new_id).parent().fadeToggle(1000).fadeToggle(1000).fadeToggle(1000).fadeToggle(1000);
        
        $(new_id).parent().removeClass("alert alert-success").addClass("alert alert-danger");

        //
    }
    else
    {

        $(new_id).parent().removeClass("alert alert-danger").addClass("alert alert-success");        

        //
    }

    // body...
}

function fit_select() 
{
    setTimeout(function()
    { 
    
        console.log(id_prochain_select);
        
        prochain = (id_prochain_select.substr(id_prochain_select.length-1))

/*        var past = parseInt(prochain) - 1;

        $("#produits"+past).prop('disabled', true);
*/
        console.log(produits);
        
        $(id_prochain_select).html(" <option value =\" \">  </option>");

        $.each(produits, function(key, value) 
        {   
            $(id_prochain_select).append($("<option></option>")
                                .attr("value", value.id)
                                .text(value.code_produit + ' | ' + value.description)); 
        });

        //
    }, 1000);
    


    // body...
}


