function submitchronique (event) 
{

    event.preventDefault();

    var $titre = ($("#Titre_chronique_section").val());

    var $nom = $('#chronique_choisi').find(":selected").attr('id');

    $("#le_titre,#chronique").fadeOut(500,function() 
    {
        
        $("#le_titre,#chronique").addClass('alert alert-success');

        $("#le_titre,#chronique").fadeIn(1000);                   
    });
        

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/Acceuil_sec4/modifier",
        data:{titre:$titre,id_chronique:$nom},
        
        success:function(data) 
        {   

            console.log(data[0].photo1)

            $("#auteur").fadeOut(500);
            $("#photo1").fadeOut(500);
            $("#photo2").fadeOut(500);
            $("#photo3").fadeOut(500,function () 
            {
            
                $("#auteur").html('Auteur :'+data[0].auteur+' ');
                $("#photo1").attr('src', '../'+data[0].photo1);
                $("#photo2").attr('src', '../'+data[0].photo2);
                $("#photo3").attr('src', '../'+data[0].photo3);

                $("#auteur").fadeIn(500);
                $("#photo1").fadeIn(500);
                $("#photo2").fadeIn(500);
                $("#photo3").fadeIn(500);            

                /* body... */
            });            

            //
        },

    });   
    // body... 
}

