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
                      <div class="modal-dialog ">
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
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Code</B></th>
              <th scope="col"><B>description</B></th>
              <th scope="col"><B>Photo</B></th>
              <th scope="col"><B>Autres Infos</B></th>
              <th scope="col"><B>douk tban</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($produits as $produit)
            <tr>
              <td scope="row"><B>{{$produit->id}}</B></td>
              <td>{{$produit->code_produit}}</td>
              <td>{{$produit->description}}</td>
              <td><!-- Button trigger modal -->
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#staticBackdrop{{$produit->id}}">
                    Photo
                  </button>

                  <!-- Modal -->
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
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#InfosPlus{{$produit->id}}">
                      Plus
                    </button>

                    <!-- Modal -->
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
                            <p><B>Prix Achat:</B> {{$produit->prix_achat}}</p>
                            <p><B>Unité: </B>{{$produit->UniteDescription}}</p>
                            <p><B>Sous_Famille:</B> {{$produit->NomFamille}}</p>
                            <p><B>Fabricant:</B> {{$produit->NomFabricant}}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-succes" data-dismiss="modal">Fermer</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
              </td>
              
              <td>Plus</td>
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFproduit{{$produit->id}}">
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