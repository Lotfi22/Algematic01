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
              <hr>
             
   
                <form class="needs-validation" novalidate action="/home/achats/AddDemandeAchatPrestation/" method="POST" enctype="multipart/form-data" id="MaForm">

                        {{ csrf_field()}}

                    <div class="modal-body">

                            
                            <h4 ><B>Type d'achat </B></h4>
                             <div class="form-row">
                              
                                  <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="TypeBien" name="TypeAchat" value="bien"   onclick="TypeDAchat()" >
                                  <label class="custom-control-label" for="TypeBien">Achat Bien</label>
                                </div>

                                <!-- Default checked -->
                                <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="TypePrestation" name="TypeAchat" checked value="prestation" onclick="TypeDAchat()">
                                  <label class="custom-control-label" for="TypePrestation">Achat Préstation</label>
                                </div>
                            </div>

                            <br>
                            <hr>

                            <div class="form-row" id="InfoProduit">

                             <div class="col-md-12 mb-6" >
                            
                                 <label for="validationTooltip03"><B>Information du Produit</B></label>
                                    <input type="text" name="NomProduitPrestation"class="form-control" placeholder="Application Web" required>

                            </div> 



                          </div>

                          <br>
                          <hr>
                            <h4 ><B>Fournisseur déclaré ?</B></h4>
                            
                             <div class="form-row">
                                  <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="Fournisseur" name="anonyme" value="non" checked  onclick="yesnoCheckAnonyme()" >
                                  <label class="custom-control-label" for="Fournisseur">Oui</label>
                                </div>

                                <!-- Default checked -->
                                <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="Anonyme" name="anonyme" value="yes" onclick="yesnoCheckAnonyme()">
                                  <label class="custom-control-label" for="Anonyme">Non</label>
                                </div>
                            </div>
                            <br>


                            <div class="form-row" id="fournisseurdeclare">
                               <div class="col-md-12 mb-6" >
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B >Fournisseur</B></label>
                                    <select name="fournisseur" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($fournisseurs as $fournisseur)
                                     <option value="{{$fournisseur->id}}"> {{  $fournisseur->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>

                          <div class="form-row" id="fournisseuranonyme">
                               <div class="col-md-12 mb-6" >
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B >Fournisseur Anonyme</B></label>
                                    <select name="FournisseurNon" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($anonymes as $anonyme)
                                     <option value="{{$anonyme->id}}"> {{  $anonyme->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>

                          <hr>

                          <br>

                       <h4 ><B>Ajouter des pièces jointes</B></h4>
      
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

                      <div class="col-md-3">
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

                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Numéro/Dénomination</label>
                              <input type="text" class="form-control " name="facture" id="facture" placeholder="FP001/2020, Contrat 001, BL001 ....";>
                          </div>
                    

                    

                  </div>


                  

                  <div class="form-row" style="margin-left: 100px">

                       <div class="col-md-3">
                        <label class="small mb-1" for="inputEmailAddress">Date pièce </label>
                        <input type="date" class="form-control " name="date" id="date" placeholder="02/05/2018";>
                    </div>

                     
                    <div class="col-md-3">
                        <label class="small mb-1" for="inputEmailAddress">Pièce Jointe </label>
                        <input type="file"  class="form-control-file" name="photo" id="photo" >
                    </div>

                  
                </div>

              </div>

        </div>

                       
     </div>

                              
                        <hr>
                        <br>
                        <h4 ><B>Remise ?</B></h4>


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
                              <div class="form-row">
                                <div class="col-md-6 mb-3" id="myDIV">
                                      <label for="validationTooltip03"><B>Remise</B></label>
                                      <input type="text" name="remise" class="form-control" placeholder="3" required>
                                </div>
                              </div>


                              
                </div>

          <hr>

                       <br>

                        <h4><B>Ajoutez des Produits</B></h4>

                        
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
                                  <option value=""></option>
                                  @foreach($produits as $produit)
                                  <option  value="{{$produit->code_produit}}">
                                      {{$produit->code_produit}} -- {{$produit->description}}
                                  </option>
                                  @endforeach 
                              </select>   
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Quantité : </label>
                              <input type="number" class="form-control quantites" name="quantite" id="quantite" placeholder="2";>

                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Prix Unitaire : </label>
                              <input type="number" class="form-control prixs" name="prix" id="prix" placeholder="1000";>
                          </div>
                      </div>
            </div>

             <div class="modal-footer">

                                     
                <button type="submit"  class="btn-sm btn btn-primary">Valier La Demande</button>

                <a class="btn-sm btn btn-dark" href="/home" aria-expanded="false">Annuler</span></a>

             </div>

        </form>

              

              

@endsection






