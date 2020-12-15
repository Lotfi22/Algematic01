@extends('../layouts.admin')
@section('content')         
    
                  @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div>
                    @endif

                    @if (count($errors)>0)
                        <ul>
                          @foreach($errors->all() as $error)
                          <li class="alert alert-danger">{{$error}}</li>
                          @endforeach
                        </ul>
                    @endif
                    <div class="container">
                      @if(session()->has('notif'))
                      <div class="row">
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
                          <strong>Notification</strong>{{session()->get('notif') }}
                        </div>
                      </div>
                      @endif
              
              <h1 style=" text-align: center; " ><B>Demande d'Achat </B></h1>     <br>
              <B><hr></B>
             
   
                <form class="needs-validation" novalidate action="/home/achats/AddDemandeAchatPrestation/" method="POST" enctype="multipart/form-data" id="MaForm">

                        {{ csrf_field()}}

                    <div class="modal-body">

                            
                            <h3 ><h3><B>Type d'achat </B></h3></h3>
                             <div class="form-row">
                              
                                  <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="TypeBien" name="TypeAchat" value="bien"    >
                                  <label class="custom-control-label" for="TypeBien">Achat Bien</label>
                                </div>

                                <!-- Default checked -->
                                <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="TypePrestation" name="TypeAchat" checked value="prestation" >
                                  <label class="custom-control-label" for="TypePrestation">Achat Préstation</label>
                                </div>
                            </div>

                            <br>
                            <B><hr></B>

                            

                       
                           
                            
                            
                            <br>


                            <div class="form-row" id="fournisseurdeclare">
                               <div class="col-md-6 mb-3" >
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><h3><B >Fournisseur</B></h3></label>
                                    <select name="fournisseur" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($fournisseurs as $fournisseur)
                                     <option value="{{$fournisseur->id}}"> {{  $fournisseur->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>

                         

                          <B><hr></B>


                          <br>



                       <h3 ><B>Ajouter des pièces jointes</B></h3>
      
       <div class="form-row">
            
            <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="Joint" name="joint" value="yes" checked  onclick="yesnoCheckJoint()" >
            <label class="custom-control-label" for="Joint">Oui</label>
          </div>

          <!-- Default checked -->
          <div class="custom-control custom-radio">
            
            <input type="radio" class="custom-control-input" id="NonJoint" name="joint" value="non" onclick="yesnoCheckJoint()">
            <label class="custom-control-label" for="NonJoint">Non</label>
        
          </div>

      </div>
      <br> 

                           
      <div class="form-row" id="Monjoint">


          <div class="form-group items" id="dynamic_form2">

                  <div class="row">
                  <div class="button-group" style="padding: 27px;">
                          <a href="javascript:void(0)" class="btn btn-primary" id="plus55"><i class="fa fa-plus"></i></a>
                          <a href="javascript:void(0)" class="btn btn-danger" id="minus55"><i class="fa fa-minus"></i></a>
                      </div>

                  <div class="form-row">

                      <div class="col-md-12 mb-6">
                          <label class="small mb-1" for="inputFirstName">Type Pièce: </label>
                          <select class='form-control ' class="js-example-basic-single" name='typepiece' id="typepiece" >
                              <option value=""></option>
                              @foreach($types as $type)
                              <option id="{{$type->type}}"  value="{{$type->id}}">
                                  <B>{{$type->type}} </B>
                              </option>
                              @endforeach 
                          </select>   
                      </div>

                          <div class="col-md-12 mb-6">
                              <label class="small mb-1" for="inputEmailAddress">Numéro/Dénomination</label>
                              <input type="text" class="form-control " name="facture" id="facture" placeholder="FP001/2020, Contrat 001, BL001 ....";>
                          </div>
                    

                    

                  </div>


                  

                  <div class="form-row" style="margin-left: 100px;">

                       <div class="col-md-12 mb-6">
                        <label class="small mb-1" for="inputEmailAddress">Date pièce </label>
                        <input type="date" class="form-control " name="date" id="date" placeholder="02/05/2018";>
                    </div>

                     
                    <div class="col-md-12 mb-6">
                        <label class="small mb-1" for="inputEmailAddress">Pièce Jointe </label>
                        <input type="file"  class="form-control-file" name="photo" id="photo" >
                    </div>

                  
                </div>

              </div>

        </div>

                       
     </div>

     <br>

     <B><hr></B>
                          

                          <br>

                         <div class="form-row" >
                               <div class="col-md-6 mb-3"  >
                                  <div class="form-group">
                                    <label  for="TVASELECT"><h3><B >TVA</B></h3></label>
                                    <select name="tva" class="form-control" id="TVASELECT">
                                      <option value="0">Non</option>
                                     @foreach($tvas as $tva)
                                     
                                     <option value="{{$tva->tva}}"> {{$tva->tva}}  % </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>

                         

                          
                          

                          <br>
                              
                        <B><hr></B>
                        <br>
                        <h3 ><B>Remise ?</B></h3>


                              <div class="form-row">
                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="yesCheck" name="RemiseYN" value="yes" checked  onclick="yesnoCheck()" >
                                <label class="custom-control-label" for="yesCheck">Avec Remise</label>
                              </div>

                              <!-- Default checked -->
                              <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="noCheck" name="RemiseYN" value="non" onclick="yesnoCheck()">
                                <label class="custom-control-label" for="noCheck">Sans Remise</label>
                              </div>
                            </div>

                              <B><hr></B>
                               <br>

                            <div id="myDIV">


                              <div class="form-row">
                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="pourcentageyes" name="typepourcentage" value="pourcentage" checked  onclick="poucentage()" >
                                <label class="custom-control-label" for="pourcentageyes">Remise %</label>
                              </div>

                              <!-- Default checked -->
                              <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="pourcentagenon" name="typepourcentage" value="montant" onclick="poucentage()">
                                <label class="custom-control-label" for="pourcentagenon">Remise Montant</label>
                              </div>
                            </div>

                            

                              <div class="form-row" id="pourcentage" >
                                <div class="col-md-6 mb-3" >
                                      <label for="validationTooltip03"><B>Remise</B></label>
                                      <input type="text" name="remise" id="taux" class="form-control" >
                                </div>
                              </div>

                              


                           </div>

                              
                </div>

          <B><hr></B>

                       <br>

                        <h3><B>Ajoutez des Produits</B></h3>

                        
                              <div class="form-row">

                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="YesProduit" name="ProduitYN" value="yes" checked  onclick="yesnoCheckProduit()" >
                                <label class="custom-control-label" for="YesProduit">Oui</label>
                              </div>

                              <!-- Default checked -->
                              <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="NoProduit" name="ProduitYN" value="non"  onclick="yesnoCheckProduit()">
                                <label class="custom-control-label" for="NoProduit">Non</label>
                              </div>

                            </div>
                             

              <div class="form-group items" id="dynamic_form">

                      <div class="row">
                      <div class="button-group" style="padding: 27px;">
                              <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                              <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                          </div>

                          <div class="col-md-3">
                              <label class="small mb-1 produitsLabels" for="inputFirstName">Produit: </label>
                              <select class='form-control produits' class="js-example-basic-single" name='produit' id="produit" >
                                  
                                  @foreach($produits as $produit)
                                  <option  value="{{$produit->code_produit}}">
                                      {{$produit->code_produit}} -- {{$produit->description}}
                                  </option>
                                  @endforeach 
                              </select>   
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Quantité : </label>
                              <input type="number" class="form-control quantites" name="quantite" id="quantite" >

                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Prix Unitaire : </label>
                              <input type="number" class="form-control prixs" name="prix" id="prix" >
                          </div>
                      </div>
            </div>

             <div class="modal-footer">

                
                <button type="submit" id="validerDemande" style="visibility: hidden;"  class="btn-sm btn btn-primary">Valier La Demande</button>
 
                <button type="button"  class="btn-sm btn btn-success" onclick="generate_table()" >Verifiez Le Total</button>


                <a class="btn-sm btn btn-dark" href="/home" aria-expanded="false">Annuler</span></a>

             </div>

        </form>

        <div id="creation" style="margin:auto;"></div>




 <script type="text/javascript">


   
   function generate_table() 
   {  


          var valeurTVA= parseFloat(document.getElementById('TVASELECT').value)
  
          var body = document.getElementsByTagName("body")[0];

          var tbl = document.createElement("table");

          tbl.className = "table table-striped table-dark";

          var tblBody = document.createElement("tbody");

          var thead = document.createElement("thead");

          var trth = document.createElement("tr");

          var th0 = document.createElement("th");

          var cellText = document.createTextNode(" Produit");

          th0.appendChild(cellText);

          trth.appendChild(th0);

          var th1 = document.createElement("th");

          var cellText = document.createTextNode(" Quantité");

          th1.appendChild(cellText);

          trth.appendChild(th1);

          var th2 = document.createElement("th");

          var cellText = document.createTextNode(" Prix U.HT");

          th2.appendChild(cellText);
          
          trth.appendChild(th2);

          var th3 = document.createElement("th");

          var cellText = document.createTextNode(" Montant HT");

          th3.appendChild(cellText);
          
          trth.appendChild(th3);

          thead.appendChild(trth);

          tbl.appendChild(thead);

           var qts = document.getElementsByClassName("quantites");

           var price = document.getElementsByClassName("prixs");
          
            var somme=0;

          for(var i = 0; i < qts.length; i++)
           {
                  
                  somme=somme+parseFloat(qts[i].value)*parseFloat(price[i].value);

                  var row = document.createElement("tr");

                  var cel = document.createElement("td");

                  var celText = document.createTextNode(i+1);

                  cel.appendChild(celText);

                  row.appendChild(cel);

                  var cell = document.createElement("td");

                  var cellText = document.createTextNode(qts[i].value);

                  cell.appendChild(cellText);

                  row.appendChild(cell);

                  var celll = document.createElement("td");

                  var celllText = document.createTextNode(price[i].value);

                  celll.appendChild(celllText);

                  row.appendChild(celll);

                  var cellll = document.createElement("td");

                  var cellllText = document.createTextNode(parseFloat(qts[i].value)*parseFloat(price[i].value));

                  cellll.appendChild(cellllText);

                  row.appendChild(cellll);
         
             
                tblBody.appendChild(row);
          }

          var creation= document.getElementById('creation');
         
         

          tbl.appendChild(tblBody);

          creation.appendChild(tbl);

           if (document.getElementById('yesCheck').checked) 
              {
                  if (document.getElementById('pourcentageyes').checked) 
                  {
                      
                      
                      var Pourcentage = parseFloat(document.getElementById('taux').value);

                      Somme_Remise=somme-somme*Pourcentage/100;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Total Ht = "+somme);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Remise = "+Pourcentage+ " %");

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Net Ht = "+Somme_Remise);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      TVA=Somme_Remise*valeurTVA/100;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Montant TVA "+valeurTVA+" % = "+TVA);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      TTC=Somme_Remise+TVA;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("TOTAL TTC = "+TTC);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                     
                  }

                  if (document.getElementById('pourcentagenon').checked) 
                  {
                      
                      var Pourcentage = parseFloat(document.getElementById('taux').value);

                      Somme_Remise=somme-Pourcentage;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Total Ht = "+somme);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Montant Remise = "+Pourcentage);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Net Ht = "+Somme_Remise);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      TVA=Somme_Remise*valeurTVA/100;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Montant TVA "+valeurTVA+" % = "+TVA);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      TTC=Somme_Remise+TVA;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("TOTAL TTC = "+TTC);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                  }
              }

              else
              {
                     var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Total Ht = "+somme);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      TVA=somme*valeurTVA/100;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("Montant TVA "+valeurTVA+" % = "+TVA);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);

                      TTC=somme+TVA;

                      var ht = document.createElement("h4");

                      var totalht = document.createTextNode("TOTAL TTC = "+TTC);

                      ht.appendChild(totalht);

                      creation.appendChild(ht);
              }

          

          tbl.setAttribute("border", "2");

            document.getElementById('validerDemande').style.visibility = "visible";

}

 </script>

              

@endsection


  



