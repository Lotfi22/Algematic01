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

      <h1 style="text-align: center;" ><B>Liste Des TVA </B></h1>
         <!-- Button trigger modal -->
                    
     <br>
     <br>

    <div>
        <table class="table table-striped table-dark" id="table_id">
          <thead>
            <tr>
              <th scope="col"><B>Valeur TVA</B></th>
              <th scope="col"><B>Date d'Ajout</B></th>
              <th scope="col"><B>Modifier</B></th>
             
            </tr>
          </thead>

          <tbody>
            @foreach($tvas as $tva)
            <tr  >
              <td scope="row"><B>{{$tva->tva}} %</B></td>

              <td>{{$tva->date_ajout}}</td>
              
                 <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalModifiertva{{$tva->id}}">
                       Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalModifiertva{{$tva->id}}" tabindex="-1" aria-labelledby="exampleModalLabelModifier{{$tva->id}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelModifier{{$tva->id}}">Voulez vous vraiment Modifier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/parametres/ModifierTVA/{{$tva->id}}" method="POST" id="editFormId">
                        {{ csrf_field()}}
             



                        <div class="modal-body">
                              <div class="form-row">

                                  <div class="col-md-6 mb-3">
                                        <label for="validationTooltip02"><B>Nouvelle Valeur TVA</B></label>
                                        <input type="text" name="tva"class="form-control" id="tva"  value="{{$tva->tva}}" required>
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

         
              
    
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>



@endsection