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
    <div>
      <h1 style="text-align: center;" ><B>Liste Des Produits</B></h1>
         <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalNVProduit">
                      Ajouter Un Produit
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
          <div class="modal fade" id="exampleModalNVProduit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Informations du Nouveau Produit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               <form class="needs-validation" novalidate action="/home/produits/AddProduit" method="POST" enctype="multipart/form-data">
                  {{ csrf_field()}}
                    <div class="modal-body">


                      <div class="form-row">

                         <h4><B>Type Produit</B></h4>


                          <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="BienOui" name="ProduitBien" value="yes" checked   >
                          <label class="custom-control-label" for="BienOui">Bien</label>
                        </div>

                        <!-- Default checked -->
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="BienNon" name="ProduitBien" value="non"  >
                          <label class="custom-control-label" for="BienNon">Préstation</label>
                        </div>

                      </div>

                      <br>
                      <hr>

                        <div class="form-row">

                          <div class="col-md-6 mb-3">
                            <label for="validationTooltip01"><B>Code Produit</B></label>
                            <input type="text"  name="code" class="form-control" placeholder="A001" required>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label for="validationTooltip02"><B>Description</B></label>
                            <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
                          </div>
                        </div>

                        

                        <div class="form-row">

                          <div class="col-md-6 mb-3">
                            <label for="validationTooltip02"><B>Model</B></label>
                            <input type="text" name="model"class="form-control"  placeholder="EL HAMIZ" required>
                          </div>

                          <div class="col-md-6 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Unité</B></label>
                                    <select name="unite" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($unites as $unite)
                                     <option value="{{$unite->id}}"> {{  $unite->description  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>
                            </div>

                          

                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Sous Famille</B></label>
                                    <select name="sfamille" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($sfamilles as $sfamille)
                                     <option value="{{$sfamille->id}}"> {{  $sfamille->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>
                            </div>

                              

                          </div>
                        <br>
                        <hr>


                             <!-- ajouter une piece jointe-->


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
                          <select class='form-control produits' class="js-example-basic-single" name='typepiece' id="typepiece" >
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
                              <input type="text" class="form-control quantites" name="facture" id="facture" placeholder="FP001/2020, Contrat 001, BL001 ....";>
                          </div>
                    

                    

                  </div>


                  

                  <div class="form-row" style="margin-left: 100px">

                       <div class="col-md-3">
                        <label class="small mb-1" for="inputEmailAddress">Date pièce </label>
                        <input type="date" class="form-control quantites" name="date" id="date" placeholder="02/05/2018";>
                    </div>

                     
                    <div class="col-md-3">
                        <label class="small mb-1" for="inputEmailAddress">Pièce Jointe </label>
                        <input type="file"  class="form-control-file" name="photoPiece" id="photoPiece" >
                    </div>

                  
                </div>

              </div>

        </div>

                       
     </div>
<br>
<hr>
                              
              

                              

        </div>

                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Ajouter</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

    </div>

     <br>
     <br>

    <div>
        <table  id="table_id" class="display">
          <thead>
            <tr>
              <th scope="col"><B>Code</B></th>
              <th scope="col"><B>Type</B></th>
              <th scope="col"><B>Description</B></th>
              <th scope="col"><B>Informations</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($produits as $produit)
            <tr>

              <td>{{$produit->code_produit}}</td>

              <td>
                  @if($produit->prestation =='non')

                          Préstation
                  @endif
                  @if($produit->prestation =='yes')

                          Bien
                  @endif
              </td>

              <td>{{$produit->description}}</td>


              <td>

                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2{{$produit->IdProduit}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Infos
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                    
                    

                  <!-- Button Information -->
                     <button type="button"  class="dropdown-item" data-toggle="modal" data-target="#InfosPlus{{$produit->IdProduit}}"><B>Infos</B></button>
                     
                    

                     @if($produit->ficheYN =='yes')
                     <button type="button" class="dropdown-item" data-toggle="modal" data-target="#caracteristique{{$produit->IdProduit}}"><B>Caracteristiques Techniques</B></button>
                     @endif

                </div>
              </div>

                

                  <!-- Modal de informations supp-->
                   <div class="modal fade" id="InfosPlus{{$produit->IdProduit}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations Suplémentaires</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p><B>Model:</B> {{$produit->model}}</p>
                            <p><B>Prix Achat:</B> 
                                    @if($produit->prix_achat == 0)
                                          Pas encore
                                    @endif
                                    @foreach($prix as $pri)
                                    @if( ($produit->prix_achat != 0) && ($produit->IdProduit == $pri->id_produit) )
                                          
                                          {{$pri->prix}}

                                    @endif
                                    @endforeach
                            </p>
                            <p><B>Unité: </B>{{$produit->UniteDescription}}</p>
                            <p><B>Sous_Famille:</B> {{$produit->NomFamille}}</p>
                       
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-succes" data-dismiss="modal">Fermer</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    
                  <!-- Modal caracteriqtiques-->

                  <div class="modal fade" id="caracteristique{{$produit->IdProduit}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Fiche techniques</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                           <table   style="width:100%">
                                      <thead>
                                        <tr>
                                          <th scope="col"><B>Type Document</B></th>
                                          <th scope="col"><B>Joint</B></th>
                               

                                         
                                        </tr>
                                      </thead>
                                      <tbody>

                                        @foreach($proprietes as $propriete)

                                        @if($propriete->id_produit == $produit->IdProduit)
                                          <tr>
                                                
                                              
                                                <td scope="row">{{$propriete->type}}</td>

                                                <td scope="row"><a class="btn btn-primary" href="/TelechargerProduitFicheProduit/{{$propriete->IdPropriete}}" role="button">Télécharger</a>
                                                 </td>
                                              

                                                
                                             

                                            </tr>
                                          @endif
                                        @endforeach
                                       
                                       
                              </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>

              </td>
             
 

              <td>

                <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFproduit{{$produit->IdProduit}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFproduit{{$produit->IdProduit}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/produits/ModifProduit/{{$produit->IdProduit}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                           <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Code Produit</B></label>
                                  <input type="text"  name="nvcode" class="form-control" value="{{$produit->code_produit}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Description</B></label>
                                  <input type="text" name="nvdescription"class="form-control" value="{{$produit->description}}" required>
                                </div>
                              </div>

                              

                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Model</B></label>
                                  <input type="text" name="nvmodel"class="form-control" value="{{$produit->model}}"  required>
                                </div>

                                <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect1"><B>Unité</B></label>
                                          <select name="nvunite" class="form-control" id="exampleFormControlSelect1">
                                            <option value="{{$produit->id_unite}}"> Ancienne Unité </option>
                                           @foreach($unites as $unite)
                                           <option value="{{$unite->id}}"> {{  $unite->description  }} </option>
                                            @endforeach
                                           
                                          </select>
                                        </div>
                                  </div>

                                

                              </div>

                              <div class="form-row">
                                  <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect1"><B>Sous Famille</B></label>
                                          <select name="nvsfamille" class="form-control" id="exampleFormControlSelect1">
                                            <option value="{{$produit->id_sous_famille}}"> Ancienne S_Famille </option>
                                           @foreach($sfamilles as $sfamille)
                                           <option value="{{$sfamille->id}}"> {{  $sfamille->nom  }} </option>
                                            @endforeach
                                           
                                          </select>
                                        </div>
                                  </div>

                                   

                                </div>
                           
                             

                              

                              </div>
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Modifier</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERproduit{{$produit->IdProduit}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERproduit{{$produit->IdProduit}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/produits/SupprimerProduit/{{$produit->IdProduit}}" method="POST">
                        {{ csrf_field()}}
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-danger">Supprimer</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>




@endsection