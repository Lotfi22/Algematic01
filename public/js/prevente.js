function clin() 
{
    
    $(".encours")./*parent().parent().*/fadeToggle('slow');

    clin();
    // 
}

clin();

function remplir_comment(objet) 
{

	id_commentaire = (objet.id.substr(11));
	
    setTimeout(function()
    { 

		$("#commentaire_accept"+id_commentaire).val($(objet).val());

		$("#commentaire_refus"+id_commentaire).val($(objet).val());

		//
	}, 100);
	// body...
}

function eventFire(el, etype)
{
  	if (el.fireEvent) 
  	{
    	el.fireEvent('on' + etype);
  	} 
  	else 
  	{
	    var evObj = document.createEvent('Events');
	    evObj.initEvent(etype, true, false);
	    el.dispatchEvent(evObj);
	}
}


function simulate_click(objet) 
{
	id = objet.id.substr(3);

	id_modal = "info_demande"+id;

	eventFire(document.getElementById(id_modal),'click');

	// body...
}