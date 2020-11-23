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
               <form class="needs-validation" novalidate action="/AddProduit" method="POST" enctype="multipart/form-data">
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

                            <div class="form-row">

                               <h4><B>Ajoutez une photo du produit ?</B></h4>

                        
                              

                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="YesPhoto" name="PhotoYN" value="yes" checked  onclick="PhotoProduit()" >
                                <label class="custom-control-label" for="YesPhoto">Oui</label>
                              </div>

                              <!-- Default checked -->
                              <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="NoPhoto" name="PhotoYN" value="non"  onclick="PhotoProduit()">
                                <label class="custom-control-label" for="NoPhoto">Non</label>
                              </div>

                            
                            


                              </div>


                             <div class="form-row" id="MaPhoto">


                                <div class="form-group" >
                                  <label for="exampleFormControlFile1"></label>
                                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
                                </div>

                             </div>

                             <!-- ajouter une piece jointe-->

                             <br>
<hr>

                            <div class="form-row">

                               <h4><B>Ajoutez une fiche technique ?</B></h4>

                        
                              

                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="YesPiece" name="PieceYN" value="yes" checked  onclick="FichePiece()" >
                                <label class="custom-control-label" for="YesPiece">Oui</label>
                              </div>

                              <!-- Default checked -->
                              <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="NoPiece" name="PieceYN" value="non"  onclick="FichePiece()">
                                <label class="custom-control-label" for="NoPiece">Non</label>
                              </div>

                            
                            


                              </div>


                             <div class="form-row" id="MaPiece">


                                <div class="form-group" >
                                  <label for="exampleFormControlFile1"></label>
                                  <input type="file" name="phototechnique"  class="form-control-file" id="exampleFormControlFile1">
                                </div>

                             </div>
<br>
<hr>
                               <div class="form-row">

                                 <h4><B>AJOUTEZ DES CARACTÉRISTIQUES TECHNIQUES ?</B></h4>

                        
                              <div class="form-row">

                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="YesFiche" name="FicheYN" value="yes" checked  onclick="FicheTechnique()" >
                                <label class="custom-control-label" for="YesFiche">Oui</label>
                              </div>

                              <!-- Default checked -->
                              <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="NoFiche" name="FicheYN" value="non"  onclick="FicheTechnique()">
                                <label class="custom-control-label" for="NoFiche">Non</label>
                              </div>

                            </div>

                          </div>
                   <br>
                   <br>          

              <div class="form-group items" id="dynamic_form">

                      <div class="row">
                      <div class="button-group" style="padding: 27px;">
                              <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                              <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                          </div>

              
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Spécficité </label>
                              <input type="text" class="form-control quantites" name="specificite" id="specificite" placeholder="";>
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Description </label>
                              <input type="text" class="form-control prixs" name="specification" id="specification" placeholder="";>
                          </div>
                      </div>
            </div>

                              

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

                          Bien
                  @endif
                  @if($produit->prestation =='yes')

                          Préstation
                  @endif
              </td>

              <td>{{$produit->description}}</td>


              <td>

                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Infos
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                    <button type="button"  class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop{{$produit->id}}"><B>Photo</B></button>
                    

                  <!-- Button Information -->
                     <button type="button"  class="dropdown-item" data-toggle="modal" data-target="#InfosPlus{{$produit->id}}"><B>Infos</B></button>
                     
                     <!-- Button Data -->
                     @if($produit->pieceYN =='yes')
                     <button type="button" class="dropdown-item" data-toggle="modal" data-target="#data{{$produit->id}}"><B>Telecharger Fiche technique</B></button>
                     @endif

                     @if($produit->ficheYN =='yes')
                     <button type="button" class="dropdown-item" data-toggle="modal" data-target="#caracteristique{{$produit->id}}"><B>Caracteristique Technique</B></button>
                     @endif

                </div>
              </div>

                <!-- modal de photo-->
                <div class="modal fade" id="staticBackdrop{{$produit->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo_Marque</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img src="{{asset('images/produit/'.$produit->photo ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal de informations supp-->
                   <div class="modal fade" id="InfosPlus{{$produit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    @if( ($produit->prix_achat != 0) && ($produit->id == $pri->id_produit) )
                                          
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

                     <!-- Modal de data-->
                  <div class="modal fade" id="data{{$produit->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo_Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img width="100%" src="{{asset('images/produit/'.$produit->data ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal caracteriqtiques-->

                  <div class="modal fade" id="caracteristique{{$produit->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Caractéristiques</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table>
                            <thead>
                              <tr>
                                  <th>Spécificité</th>
                                  <th>Caractéristique</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($proprietes as $propriete)
                                <tr>
                                  <td>{{$propriete->specificite}}</td>
                                  <td>{{$propriete->specification}}</td>
                                </tr>
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

                <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFproduit{{$produit->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFproduit{{$produit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ModifProduit/{{$produit->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                           <div class="modal-body">
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

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect1"><B>Fabricant</B></label>
                                          <select name="fabricant" class="form-control" id="exampleFormControlSelect1">
                                           @foreach($fabricants as $fabricant)
                                           <option value="{{$fabricant->id}}"> {{  $fabricant->nom  }} </option>
                                            @endforeach
                                           
                                          </select>
                                        </div>
                                  </div>

                                </div>
                            <div class="form-row">

                                <div class="form-group">
                                  <label for="exampleFormControlFile1"><B>Photo</B></label>
                                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
                                </div>

                              </div>

                             

                               <div class="form-row">

                                <div class="form-group">
                                  <label for="exampleFormControlFile1"><B>Photo_Détails</B></label>
                                  <input type="file" name="detail"  class="form-control-file" id="exampleFormControlFile1">
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERproduit{{$produit->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERproduit{{$produit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/SupprimerProduit/{{$produit->id}}" method="POST">
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