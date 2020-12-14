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

        <h1 style="text-align: center;" ><B>Liste Des Etagères </B></h1>
      <br>
    <div>


         <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalNVETAGERE">
                      Ajouter Une Etagère
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalNVETAGERE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouvelle Etagère</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/AddEtagere" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Num_Etage</B></label>
                                  <input type="number"  name="num_etage" class="form-control" placeholder="13" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
                                </div>
                              </div>

                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Rayon</B></label>
                                    <select name="rayon" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($rayons as $rayon)
                                     <option value="{{$rayon->id}}"> {{  $rayon->nom  }} </option>
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
        <table   id="table_id">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Num_rayon</B></th>
              <th scope="col"><B>description</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($etageres as $etagere)
            <tr>
              <td scope="row"><B>{{$etagere->num_etage}}</B></td>

              <td>{{$etagere->id_rayon}}</td>
              
              <td>{{$etagere->description}}</td>
            
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFetagere{{$etagere->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFetagere{{$etagere->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/ModifEtagere/{{$etagere->id}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Nouvelle Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>NV_Num_Etage</B></label>
                                  <input type="number" min="0" name="num_etage"class="form-control"  placeholder="12" required>
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERetagere{{$etagere->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERetagere{{$etagere->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/SupprimerEtagere/{{$etagere->id}}" method="POST">
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