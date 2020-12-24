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

      <h1 style="text-align: center;" ><B>Liste Des Tiroirs </B></h1>

           <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalNVtiroir">
                      Ajouter Un Tiroir
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalNVtiroir" tabindex="-1" aria-labelledby="exampleModalLabeltiroir" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabeltiroir">Informations du Nouveau Tiroir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/documents/Addtiroir" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">

                              <div class="form-row">

                                  <div class="col-md-6 mb-3">
                                        <label for="validationTooltip02"><B>Numéro</B></label>
                                        <input type="text" name="numero"class="form-control"  placeholder="5" required>
                                  </div>
                                

                              </div>

                            <div class="form-row">
                            <div class="col-md-6 mb-3">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Casier</B></label>
                                    <select name="casier" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($casiers as $casier)
                                     <option value="{{$casier->id}}"> {{  $casier->description  }} </option>
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
        <table  id="table_id">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Casier</B></th>
              <th scope="col"><B>Documents</B></th>
             
            </tr>
          </thead>

          <tbody>
            @foreach($tiroirs as $tiroir)
            <tr  >
              <td scope="row"><B>{{$tiroir->numero}} </B></td>

              <td scope="row"><B>{{$tiroir->description}} </B></td>

              
                 <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalModifiertiroir{{$tiroir->idtiroir}}">
                       Documents
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalModifiertiroir{{$tiroir->idtiroir}}" tabindex="-1" aria-labelledby="exampleModalLabelModifier{{$tiroir->idtiroir}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelModifier{{$tiroir->idtiroir}}">Documents du Tiroir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                    



                        <div class="modal-body">
                              <div class="form-row">

                                 
                                

                              </div>

                          
                          </div>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</button>
                            
                          </div>
                          
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