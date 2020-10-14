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
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalNVfamille">
                      Ajouter Une Famille pour les Produits
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalNVfamille" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations de la Nouvelle Famille</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/AddFamilleProduit" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="CAMERA ET CABLES" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
                                </div>
                              </div>

                            <div class="col-md-3 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Catégorie</B></label>
                                    <select name="categorie" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($categories as $categorie)
                                     <option value="{{$categorie->id}}"> {{  $categorie->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
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
              <th scope="col"><B>Nom</B></th>
              <th scope="col"><B>description</B></th>
              <th scope="col"><B>Num_Catégorie</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($familles as $famille)
            <tr>
              <td scope="row"><B>{{$famille->id}}</B></td>
              <td>{{$famille->nom}}</td>
              <td>{{$famille->description}}</td>
              <td>{{$famille->id_categorie}}</td>
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFfamille{{$famille->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFfamille{{$famille->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ModifFamilleProduit/{{$famille->id}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nouveau Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="{{$famille->nom}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Nouvelle Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="{{$famille->description}}" required>
                                </div>
                              </div>

                              <div class="col-md-3 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Nouvelle_Catégorie</B></label>
                                    <select name="categorie" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($categories as $categorie)
                                     <option value="{{$categorie->id}}"> {{  $categorie->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERfamille{{$famille->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERfamille{{$famille->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/SupprimerFamilleProduit/{{$famille->id}}" method="POST">
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