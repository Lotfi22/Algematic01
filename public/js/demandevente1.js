$("#ventes_prestations").hide();
$("#ventes_produits").hide();

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

function get_prices(object) 
{

    var conceptName = $(object).find(":selected").val();

        $.ajax({

            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

            type:"POST",
            url:"/home/vente/DemandeVente/GetPrice",
            data:{},

            success:function(data) 
            {
                
                var depart = data['depart']; 

                console.log(depart);
            }
        });    

    // body...
}


