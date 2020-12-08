id_prochain_select = "";

var li_rah = [{id: "ZZXWEEVBD", code_produit: " ", description: "  "}];

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

function get_prices(object) 
{

    var id_win_insiri = (object.id.substr(0,7) + object.id.substr(8));

    var $id = $(object).find(":selected").val();
    
    $("#"+id_win_insiri).val($id);

    var num =(object.id.substr(8));
    
    id_type = "type"+num;

    document.getElementById(id_type).value = $(object).find(":selected").attr("class");  

    var le_type = $(object).find(":selected").attr("class")

    var new_id = "#quantite_dispo"+num;

    var prix_new_id = "#prix_prod"+num;

    var prix_liste_new_id = "#prix_liste"+num;

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
        data:{id:$id,type:le_type},
        
        success:function(data) 
        {   

            console.log(data);

            $(new_id).val(data.quantite);

            $(prix_new_id).val(data.prix_vente);  

            $(prix_liste_new_id).val(data.prix_vente);

            $("#"+object.id).prop('disabled', true);             

            //
        }
    }); 

    return 0;

    // body...
}

function get_stock(object) 
{
    
    var num =(object.id.substr(13))
    
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
                                .attr("class", value.nom.substr(0,7))
                                .text(value.nom + ' | ' + value.description)); 
        });

        //
    }, 100);
    


    // body...
}


