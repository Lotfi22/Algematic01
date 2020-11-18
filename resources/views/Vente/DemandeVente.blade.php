@extends('../layouts.admin')
@section('content')         
    
     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p style="text-align: center;">{{ \Session::get('success') }}</p>
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
              
              <h1 style=" text-align: center; " ><B>Demande De Vente</B></h1>     <br>
             


                <form class="needs-validation" novalidate action="/AddDemandeVente" method="POST" enctype="multipart/form-data">

                        {{ csrf_field()}}

                    <div class="modal-body">

                            <div class="form-row">
                               <div class="col-md-12 mb-6" >
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B >Client</B></label>
                                    <select name="client" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($clients as $client)
                                     <option value="{{$client->id}}"> {{  $client->code_client  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>

                        
                           
                             

                              
                </div>


                      <div class="form-group items" id="dynamic_form">
                      <div class="row">
                      <div class="button-group" style="padding: 27px;">
                              <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                              <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                          </div>

                          <div class="col-md-3">
                              <label class="small mb-1" for="inputFirstName">Article : </label>
                              <select class='form-control produits' class="js-example-basic-single" name='produit' id="produit" >
                                  <option value=""></option>
                                  @foreach($articles as $article)
                                  <option  value="{{$article->id}}">
                                      {{$article->nom}} -*-  {{  $article->description }} -*- Total _Vente:  {{ $article->total}} 
                                  </option>
                                  @endforeach 
                              </select>   
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Quantité : </label>
                              <input type="number" class="form-control quantites" name="quantite" id="quantite" placeholder="2";>
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Prix Unitaire : </label>
                              <input type="number" class="form-control prixs" name="prix" id="prix" placeholder="8000"; >
                          </div>
                      </div>
            </div>

             <div class="modal-footer">
                           
                        <button type="submit" class="btn-sm btn btn-primary">Valier La Demande</button>
                        <a class="btn-sm btn btn-dark" href="/home" aria-expanded="false">Annuler</span></a>
             </div>

        </form>


@endsection