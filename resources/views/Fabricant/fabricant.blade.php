@extends('../layouts.admin')
@section('content')         
    
     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p style=" text-align : center; ">{{ \Session::get('success') }}</p>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                      Ajouter Un Fabricant
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouveau Fabricant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/AddFabricant" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="JORDAN" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Marque</B></label>
                                  <input type="text" name="marque"class="form-control"  placeholder="NIKE" required>
                                </div>
                              </div>

                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Description</B></label>
                                  <input type="text" name="description"class="form-control" placeholder="" required>
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
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Nom</B></th>
              <th scope="col"><B>Description</B></th>
              <th scope="col"><B>Photo</B></th>
              <th scope="col"><B>Marque</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($fabricants as $fabricant)
            <tr>
              <td scope="row"><B>{{$fabricant->id}}</B></td>
              <td>{{$fabricant->nom}}</td>
              <td>{{$fabricant->description}}</td>
              <td><!-- Button trigger modal -->
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#staticBackdrop{{$fabricant->id}}">
                    Photo
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop{{$fabricant->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo_Marque</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img src="{{asset('images/fabricant/'.$fabricant->photo ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              <td>{{$fabricant->marque}}</td>
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$fabricant->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModal{{$fabricant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelle Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ModifFabricant/{{$fabricant->id}}" method="POST">
                        {{ csrf_field()}}
                         <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nouveau_Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="JORDAN" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Nouvelle_Marque</B></label>
                                  <input type="text" name="marque"class="form-control"  placeholder="NIKE" required>
                                </div>
                              </div>

                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Nouvelle_Description</B></label>
                                  <input type="text" name="description"class="form-control" placeholder="" required>
                                </div>

                              </div>
                              <div class="form-row">
                                 <div class="form-group">
                                  <label for="exampleFormControlFile1"><B>Nouvelle_Photo</B></label>
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMER{{$fabricant->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMER{{$fabricant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/SupprimerFabricant/{{$fabricant->id}}" method="POST">
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