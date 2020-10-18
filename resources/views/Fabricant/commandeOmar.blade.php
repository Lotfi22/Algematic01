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
              
              <h1 style=" text-align: center; " ><B>Bon de Commande</B></h1>     <br>
              @foreach($fournisseurs as $fournisseur)
              <h2 style=" text-align: center; "><B>Fournisseur : {{$fournisseur->nom}}</B></h2>  
              @endforeach

                <form class="needs-validation" novalidate action="/ADDcommande/{{$fournisseur->id}}" method="POST">
                        {{ csrf_field()}}
                      <div class="form-group items" id="dynamic_form">
                      <div class="row">
                      <div class="button-group" style="padding: 27px;">
                              <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                              <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputFirstName">Produit: </label>
                              <select class='form-control produits' class="js-example-basic-single" name='produit' id="produit" >
                                  <option value=""></option>
                                  @foreach($produits as $produit)
                                  <option  value="{{$produit->id}}">
                                      {{$produit->code_produit}} 
                                  </option>
                                  @endforeach 
                              </select>   
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Quantité : </label>
                              <input type="number" class="form-control quantites" name="quantite" id="quantite" placeholder="Entere Quantité Produit ";>
                          </div>
                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Prix : </label>
                              <input type="number" class="form-control prixs" name="prix" id="prix" placeholder="Entere Quantité Produit ";>
                          </div>
                      </div>
            </div>

             <div class="modal-footer">
                           
                            <button type="submit" class="btn-sm btn btn-primary">Ajouter</button>
                          </div>
            </form>


@endsection