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
         <!-- Button trigger modal 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                      Ajouter Un Client
                    </button>

                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouveau client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Addclient" method="POST" enctype="multipart/form-data">
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
-->


     <br>
     <br>

    <div>
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>Code</B></th>
              <th scope="col"><B>Photo</B></th>
              <th scope="col"><B>Infos</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($clients as $client)
            <tr>
              <td scope="row"><B>{{$client->code_client}}</B></td>
              <td><!-- Photo -->
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#phot{{$client->id}}">
                    Photo
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="phot{{$client->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img src="{{asset('images/photos_clients/'.$client->photo ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>

              <td><!-- Button Infos Client -->
                  <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#infos{{$client->id}}">
                    Informations
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="infos{{$client->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Informations du Client</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul>
                            <li><B>Téléphone :  </B>  {{$client->tel}}</li>
                            <li><B>Fax :  </B>  {{$client->fax}}</li>
                            <li><B>Mobile :  </B>  {{$client->mobile}}</li>
                            <li><B>Email :  </B>  {{$client->email}}</li>
                            <li><B>NIS :  </B>  {{$client->NIS}}</li>
                            <li><B>NIF :  </B>  {{$client->NIF}}</li>
                            <li><B>RC :  </B>  {{$client->RC}}</li>
                            <li><B>N°_art_imp :  </B>  {{$client->n_art_imp}}</li>
                            <li><B>Taux_remise_spec :  </B>  {{$client->taux_remise_spec}}</li>
                            <li><B>Client_inter_fact :  </B>  {{$client->client_inter_fact}}</li>
                            <li><B>Motif_interd :  </B>  {{$client->motif_interd}}</li>
                            <li><B>Plafond_credit :  </B>  {{$client->plafond_credit}}</li>
                            <li><B>Categorie_nom :  </B>  {{$client->categorie_nom}}</li>
                            <li><B>Activite_nom :  </B>  {{$client->activite_nom}}</li>
                            <li><B>Ajouter le :  </B>  {{$client->created_at}}</li>
                          </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              
              
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#modifier{{$client->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="modifier{{$client->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelle Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Modifclient/{{$client->id}}" method="POST">
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMER{{$client->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMER{{$client->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Supprimerclient/{{$client->id}}" method="POST">
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