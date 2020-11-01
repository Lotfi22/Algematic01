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
              
              <h1 style=" text-align: center; " ><B>Demande d'Achat</B></h1>     <br>
             


                <form class="needs-validation" novalidate action="/ADDDemandeAchat/" method="POST" enctype="multipart/form-data">

                        {{ csrf_field()}}

                    <div class="modal-body">

                            <div class="form-row">
                               <div class="col-md-12 mb-6" >
                                  <div class="form-group">
                                    <label  for="exampleFormControlSelect1"><B >Fournisseur</B></label>
                                    <select name="fournisseur" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($fournisseurs as $fournisseur)
                                     <option value="{{$fournisseur->id}}"> {{  $fournisseur->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>
                           
                              <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                      <label for="validationTooltip03"><B>Numéro Facture ProForma</B></label>
                                      <input type="text" name="facture"class="form-control" placeholder="FP20600" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label for="validationTooltip03"><B>Date de La facture</B></label>
                                      <input type="date" name="date"class="form-control" placeholder="02/05/2018" required>
                                    </div>

                              </div>

                              <div class="form-row">
                                 <div class="col-md-6 mb-3">
                                  <label for="exampleFormControlFile1"><B>Photo</B></label>
                                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
                                </div>

                                <div class="col-md-6 mb-3">
                                      <label for="validationTooltip03"><B>Remise</B></label>
                                      <input type="text" name="remise" class="form-control" placeholder="3" required>
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
                              <label class="small mb-1" for="inputFirstName">Produit: </label>
                              <select class='form-control produits' class="js-example-basic-single" name='produit' id="produit" >
                                  <option value=""></option>
                                  @foreach($produits as $produit)
                                  <option  value="{{$produit->code_produit}}">
                                      {{$produit->code_produit}} -- {{$produit->description}}
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
                              <input type="number" class="form-control prixs" name="prix" id="prix" placeholder="1000";>
                          </div>
                      </div>
            </div>

             <div class="modal-footer">
                           
                        <button type="submit" class="btn-sm btn btn-primary">Valier La Demande</button>
                        <a class="btn-sm btn btn-dark" href="/home" aria-expanded="false">Annuler</span></a>
             </div>

        </form>


@endsection