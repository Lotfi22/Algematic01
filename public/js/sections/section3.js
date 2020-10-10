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


function submit4recettes(event) 
{

    event.preventDefault();

    var $titre = ($("#Titre_recette_section").val());

    var $sous_titre = ($("#sous_Titre_recette_section").val());

    var $id1 = $("#recette_choix1").find(":selected").attr('id');

    var $id2 = $("#recette_choix2").find(":selected").attr('id');

    var $id3 = $("#recette_choix3").find(":selected").attr('id');

    var $id4 = $("#recette_choix4").find(":selected").attr('id');

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec3/modifier",
        data:{titre:$titre,sous_titre:$sous_titre,id_recette1:$id1,id_recette2:$id2,id_recette3:$id3,id_recette4:$id4},
        
        success:function(data) 
        {

        
            $("#recette").fadeOut(500,function() 
            {
                
                $("#le_titre,#le_sous_titre,#recette").addClass('alert alert-success');

                $("#le_titre,#le_sous_titre,#recette").fadeIn(1000);                   


            });

            console.log(data[0])

            for (var i =0; i < data.length ; i++) 
            {
                
                var $to_append = $('<img class="col-md-2" src="../'+data[i]+'">')

                var win = "#result"+i
                
                $(win).html("");

                $(win).fadeOut(0);

                $(win).append($to_append)

                $(win).fadeIn(2000);
            }

        
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
            console.log(data)
            //
        },

    });   
    // body... 
}

$(".le_select").on('change', function(event) 
{
    event.preventDefault();

    var $id1 = $("#recette_choix1").find(":selected").attr('id');

    var $id2 = $("#recette_choix2").find(":selected").attr('id');

    var $id3 = $("#recette_choix3").find(":selected").attr('id');

    var $id4 = $("#recette_choix4").find(":selected").attr('id');

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec3/choosing",
        data:{id1:$id1,id2:$id2,id3:$id3,id4:$id4},
        
        success:function(data) 
        {
            console.log(data)

            if(event.target.id.substr(13,1) == 1)
            {
                $("#"+event.target.id).children().addClass("007");
             
                $("#"+event.target.id).children(":selected").removeClass("007");

                $("#recette_choix2").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix2").append($to_append)


                $("#recette_choix3").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix3").append($to_append)


                $("#recette_choix4").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix4").append($to_append)


                /**/
            }

            if(event.target.id.substr(13,1) == 2)
            {

                $("#"+event.target.id).children().addClass("007");
             
                $("#"+event.target.id).children(":selected").removeClass("007");


                $("#recette_choix1").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix1").append($to_append)


                $("#recette_choix3").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix3").append($to_append)


                $("#recette_choix4").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix4").append($to_append)


                /**/
            }

            if(event.target.id.substr(13,1) == 3)
            {

                $("#"+event.target.id).children().addClass("007");
             
                $("#"+event.target.id).children(":selected").removeClass("007");


                $("#recette_choix1").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix1").append($to_append)


                $("#recette_choix2").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix2").append($to_append)


                $("#recette_choix4").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix4").append($to_append)


                /**/
            }

            if(event.target.id.substr(13,1) == 4)
            {

                $("#"+event.target.id).children().addClass("007");
             
                $("#"+event.target.id).children(":selected").removeClass("007");


                $("#recette_choix1").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix1").append($to_append)


                $("#recette_choix3").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix3").append($to_append)


                $("#recette_choix2").children(".007").remove();
    
                for (var i = 0 ; i < data.length; i++) 
                {
        
                    $to_append = '<option class="007" id="'+data[i].id+'">'+data[i].nom+'</option>'
        
                }

                $("#recette_choix2").append($to_append)


                /**/
            }
            //
        },
    });   

    /* Act on the event */
});


if($("#recette_wella_categorie").val()!="kayen 4 recettes")
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



function submit4categories(event)
{

    event.preventDefault();

    var $titre = ($("#Titre_recette_section").val());

    var $sous_titre = ($("#sous_Titre_recette_section").val());

    var $id1 = $("#categorie_choix1").find(":selected").attr('id');

    var $id2 = $("#categorie_choix2").find(":selected").attr('id');

    var $id3 = $("#categorie_choix3").find(":selected").attr('id');

    var $id4 = $("#categorie_choix4").find(":selected").attr('id');

    console.log($id1,$id2,$id3,$id4)

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec3_cat/modifier",
        data:{titre:$titre,sous_titre:$sous_titre,id_categorie1:$id1,id_categorie2:$id2,id_categorie3:$id3,id_categorie4:$id4},
        
        success:function(data) 
        {

        
            $("#TV").fadeOut(500,function() 
            {
                
                $("#le_titre,#le_sous_titre,#TV").addClass('alert alert-success');

                $("#le_titre,#le_sous_titre,#TV").fadeIn(1000);                   


            });

        
            //
        },

        //
    });   

    // body... 
}

function les4dernieres(event) 
{

    event.preventDefault();

    var $id1 = $("#categorie_choix1").find(":selected").attr('id');

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec3_4categorie/modifier",
        data:{id:$id1},
        
        success:function(data) 
        {

        
            $("#ta3_les_4").fadeOut(500,function() 
            {
                
                $("#ta3_les_4").addClass('alert alert-success');

                $("#ta3_les_4").fadeIn(1000);                   

                $("#ta3_les_4").html("");

                $("#ta3_les_4").append("<p> Les 4 derinères Recettes ont été mises à jour </p>");                

            });

        
            //
        },
    });    

    // body... 
}



