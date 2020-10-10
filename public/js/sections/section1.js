if(($("textarea").attr('name'))=="Titre_TV_section")
{

    $("#TV").show(0);

    $("#recette").hide(0);

    /**/
}
else
{
    $("#TV").hide(0);

    $("#recette").show(0);
}

$("#choix_recette").click(function () 
{

   $("#TV").hide(1000,function() 
   {

        $("#recette").show(1000);
       
       // body...
   });

   // body...
});

$("#choix_Télé").click(function () 
{

   $("#recette").hide(1000,function() 
   {

        $("#TV").show(1000);
       
       // body...
   });

   // body...
});


function submitrecette (event) 
{

    event.preventDefault();

    var $titre = ($("#Titre_recette_section").val());

    var $nom = $('#recette_choisi').find(":selected").attr('id');

    $("#le_titre,#recette").fadeOut(500,function() 
    {
        
        $("#le_titre,#recette").addClass('alert alert-success');

        $("#le_titre,#recette").fadeIn(1000);                   
    });
        

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec1/modifier",
        data:{titre:$titre,id_recette:$nom},
        
        success:function(data) 
        {
            console.log(data.photo)
            
            $("#photo_recette").attr('src', '../'+data.photo);
            //
        },

    });   
    // body... 
}


function submitTV(event)
{

    event.preventDefault();

    var $titre = ($("#Titre_recette_section").val());

    var $nom = $('#TV_choisi').find(":selected").attr('id');

    $("#le_titre,#TV").fadeOut(500,function() 
    {
        
        $("#le_titre,#TV").addClass('alert alert-success');

        $("#le_titre,#TV").fadeIn(1500);                   
    });
        

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec1/modifierTV",
        data:{titre:$titre,id_tv:$nom},
        
        success:function(data) 
        {
            console.log(data.lien)

            $("#le_titre,#TV").fadeOut(500,function() 
            {
                
                $("#le_titre,#TV").addClass('alert alert-success');
    
                $("#la_video").html(data.lien);

                $("#le_titre,#TV").fadeIn(1500);                   
            });



            //
        },

    });   
    // body... 
}



