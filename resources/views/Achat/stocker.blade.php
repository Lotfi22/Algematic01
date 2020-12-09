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
                        <h1 style="text-align: center;  " >Rangement des Produit </h1>
                      </div>
                      <br>



    
        <table class="table table-striped table-dark"  id="table_id" class="display">
        <thead>
          <tr>
            <th scope="col">Produit</th>
          <th scope="col">Etagère</th>
          </tr>
        </thead>
        <tbody>
          @foreach($nvproduits as $produit)
            <tr>
                <td scope="row">{{$produit->code_produit}}</td>
                <td scope="row">
                      <!-- Button De Ranger -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$produit->id_produit}}exampleModal">
                      Ranger
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="{{$produit->id_produit}}exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment ranger</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          
                         <form id="Maform" class="needs-validation" novalidate action="/home/achats/Placement/{{$presachats->idpreachat}}/{{$produit->id_produit}}" method="POST">
                        {{ csrf_field()}}
                            
                            <div class="modal-body">

                               <div class="form-row">
                               <div class="col-md-6 mb-3" >
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B >Etagère</B></label>
                                    <select name="etagere" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($etageres as $etagere)
                                     <option value="{{$etagere->id}}"> {{  $etagere->description  }} {{  $etagere->num_etage  }} | {{  $etagere->nomRayon  }}| {{  $etagere->nomLocal  }}</option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>


                            </div>
                              
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Valider</button>
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
    








@endsection





