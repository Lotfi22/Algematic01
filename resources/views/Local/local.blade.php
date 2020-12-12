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

       <h1 style="text-align: center;" ><B>Liste Des Locaux </B></h1>
      <br>
         <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalNVLOCAL">
                      Ajouter Un Local
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalNVLOCAL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouveau Local</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/AddLocal" method="POST">
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

                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Supérficie</B></label>
                                  <input type="text" name="superficie"class="form-control" placeholder="30 m2" required>
                                </div>
                              
                            <div class="col-md-6 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Dépot</B></label>
                                    <select name="depot" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($depots as $depot)
                                     <option value="{{$depot->id}}"> {{  $depot->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
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
        <table class="table table-striped table-dark" id="table_id">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Nom</B></th>
              <th scope="col"><B>description</B></th>
              <th scope="col"><B>Sepérficie</B></th>
              <th scope="col"><B>Num_Dépot</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($locals as $local)
            <tr>
              <td scope="row"><B>{{$local->id}}</B></td>
              <td>{{$local->nom}}</td>
              <td>{{$local->description}}</td>
              <td>{{$local->superficie}}</td>
              <td>{{$local->id_depot}}</td>
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFLOCAL{{$local->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFLOCAL{{$local->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelle Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/ModifLocal/{{$local->id}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nouveau Nom</B></label>
                                  <input type="text" value="{{$local->nom}}"  name="nom" class="form-control" placeholder="CAMERA ET CABLES" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Nouvelle Description</B></label>
                                  <input type="text" value="{{$local->description}}"  name="description"class="form-control"  placeholder="EL HAMIZ" required>
                                </div>
                              </div>

                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Nouvelle Supérficie</B></label>
                                  <input type="text" value="{{$local->superficie}}" name="superficie"class="form-control" placeholder="30 m2" required>
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERLOCAL{{$local->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERLOCAL{{$local->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/SupprimerLocal/{{$local->id}}" method="POST">
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