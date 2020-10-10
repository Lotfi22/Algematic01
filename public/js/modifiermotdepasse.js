$("#informations").show();

$("#password").hide();

$("#modifierinformations").hide();

$("#modifiermotdepasse").click(function () 
{

   $("#informations").hide(1500,function() 
   {

        $("#password").show(1500);
       
       // body...
   });

   $("#modifiermotdepasse").hide();

   $("#modifierinformations").show();

   // body...
});

$("#modifierinformations").click(function () 
{

   $("#password").hide(1500,function()
   {

        $("#informations").show(1500);
       // body...
   });

   $("#modifiermotdepasse").show();
   $("#modifierinformations").hide();

   // body...
});

function modifierlemotdepasse(event) 
{

    event.preventDefault();

    var $ancien_password = ($('input[name="ancien_password"]').val());

    var $password = ($('input[name="password"]').val());

    var $password_confirmation = ($('input[name="password_confirmation"]').val());



    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/modifiermotdepasse",
        data:{ancien_password:$ancien_password,password:$password,password_confirmation:$password_confirmation},
        
        success:function(data) 
        {
            console.log(data)
            
            $("#ici_le_msg").hide(0);

            $("#ici_le_msg").attr('class', 'col-md-12 alert alert-success');            

            $("#ici_le_msg").html("");

            $("#ici_le_msg").append("Mot de passe modifié avec succés");

            $("#ici_le_msg").show('slow');

            //
        },

        error:function (data) 
        {
        
            console.log("danger")

            if(data.responseJSON!=undefined)
            {

                var err = "Vérifier vos deux NOUVEAUX mots de passe";   

                //
            }
            else
            {

                var err = "Vérifier votre premier mot de passe";                   
                
                //
            }

            $("#ici_le_msg").hide(0);

            $("#ici_le_msg").attr('class', 'col-md-12 alert alert-danger');            
            
            $("#ici_le_msg").html("");
            
            $("#ici_le_msg").append(err);

            $("#ici_le_msg").show('slow');
            //
        }
    })      

    // body... 
}




