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

                       <h1 style="text-align: center;" ><B>Liste Des Catégories_Produits </B></h1>
      <br>
    <div>
         <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalcategorie">
                      Ajouter Une Catégorie
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalcategorie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations De La Nouvelle categorie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/AddCategorie" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="COMPILS" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
                                </div>

                              </div>

                              <div class="form-row">
                                 <div class="form-group">
                                  <label for="exampleFormControlFile1"><B>Photo</B></label>
                                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
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
        <table class="table table-striped table-dark"  id="table_id">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Nom</B></th>
              <th scope="col"><B>Description</B></th>
              <th scope="col"><B>Photo</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $categorie)
            <tr>
              <td scope="row"><B>{{$categorie->id}}</B></td>
              <td>{{$categorie->nom}}</td>
              <td>{{$categorie->description}}</td>
              <td>      <!-- Button Pour l'affichage de la photo -->

                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#staticBackdrop{{$categorie->id}}">
                    Photo
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop{{$categorie->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo_Categorie</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img src="{{asset('images/categorie/'.$categorie->photo ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              
              
              <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFcategorie{{$categorie->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFcategorie{{$categorie->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ModifCategorie/{{$categorie->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                         <div class="modal-body">

                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nouveau Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="{{$categorie->nom}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Nouvelle Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="{{$categorie->description}}" required>
                                </div>

                              </div>

                              <div class="form-row">
                                 <div class="form-group">
                                  <label for="exampleFormControlFile1"><B>Nouvelle Photo</B></label>
                                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
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
                
                 <td>
                    <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERcategorie{{$categorie->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERcategorie{{$categorie->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/SupprimerCategorie/{{$categorie->id}}" method="POST">
                        {{ csrf_field()}}
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Supprimer</button>
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