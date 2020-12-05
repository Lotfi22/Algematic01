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
      
        <h1 style=" text-align: center;"><B id="demandedevente">Demande De Vente</B></h1>     

        <hr>

        <form class="needs-validation" id="ventes_produits" action="/home/vente/DemandeVente/AddDemandeVente" method="POST" enctype="multipart/form-data">

            {{ csrf_field()}}
            

            <div class="form-group">
                <label for="doc">Attacher des documents ?</label>
                <select class="form-control" name="existe_doc" onchange="show_d_f2(this)" id="oui_ou_non">
                    <option value="NON">NON</option>
                    <option value="OUI">OUI</option>
              </select>
            </div>

            <div class="form-group items" id="dynamic_form2">
                
                <div class="row">
                
                    <div class="button-group" style="padding: 27px;">
                        
                        <a href="javascript:void(0)" class="btn btn-primary" id="plus55"><i class="fa fa-plus"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-danger" id="minus55"><i class="fa fa-minus"></i>
                        </a>
                    </div>

                    <div class="col-md-5">
                        <label class="small mb-1" for="type_doc">document </label>
                
                        <select class="form-control type_doc" name="type_doc" id="type_doc" >
                
                            <option value=""></option>
                    
                            @foreach($type_pieces as $type_piece)

                                <option value="{{$type_piece->id}}" class="{{$type_piece->type}}">
                                    
                                    {{$type_piece->type}} 

                                    {{--  --}}
                                </option>
                            @endforeach 
                        </select>   


                    </div>

                    <div class="col-md-5">
                        <label class="small mb-1" for="document">Document </label>
                        <input type="file" class="form-control document" name="document" id="document">
                    </div>

                </div>
            </div>



            <div class="modal-body">

                <div class="form-row">
            
                    <div class="col-md-6 mb-6" >
            
                        <div class="form-group">

                            <br>
                        
                            <label  for="exampleFormControlSelect1"><B >Client</B></label>
                            
                            <select name="client" class="form-control" id="exampleFormControlSelect1">
                            
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}"> {{  $client->code_client  }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div> 
                    
                    <div class="col-md-6 mb-6" >
            
                        <div class="form-group">

                            <br>
                        
                            <label for="valabilite"><B >Mois de valabilité</B></label>
                            <input class="form-control" min="1" value="1" type="number" name="valabilite" id="valabilite">

                            {{--  --}}
                        </div>
                    </div> 

                    <div class="col-md-12 mb-6" >
            
                        <div class="form-group">

                            <br>
                        
                            <label for="NB"><B > NB </B></label>
                            <textarea class="form-control" name="NB" rows="3" id="NB">paiement 50% à la demande. 
50% à la livraison. </textarea>

                            {{--  --}}
                        </div>
                    </div> 


                </div>
            </div>


            <div class="form-group items" id="dynamic_form">
                
                <div class="row">
                
                    <div class="button-group" style="padding: 27px;">
                        
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="fit_select();" id="plus5"><i class="fa fa-plus"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <label class="small mb-1" for="produits">Produit : </label>
                
                        <select class="form-control produits" name="produits" required id="produits" onchange="get_prices(this);">
                
                            <option value=""></option>
                    
                            @foreach($produits as $produit)

                                <option value="{{$produit->id}}" class="{{substr($produit->nom,0,7)}}">
                                    
                                    {{substr($produit->nom,0,7)}} : {{substr($produit->nom,8)}} | {{  $produit->description }} 

                                    {{--  --}}
                                </option>
                            @endforeach 
                        </select>   


                    </div>

                    <div class="col-md-2" style="display: none;">
                        <label class="small mb-1" for="produit">Prod </label>
                        <input type="number" class="form-control produit" name="produit" id="produit" readonly>
                    </div>

                    <div class="col-md-2" style="display:none;">
                        <label class="small mb-1" for="type">type </label>
                        <input type="text" class="form-control type" name="type" id="type" readonly>
                    </div>

                    <div class="col-md-2">
                        <label class="small mb-1" for="quantite_dispo">Quantité disponible : </label>
                        <input type="number" class="form-control quantites" name="quantite_dispo" id="quantite_dispo" readonly>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="small mb-1" for="quantite_prod">Quantité : </label>
                        <input type="number" required onchange="get_stock(this);" class="form-control quantites" min="1"  name="quantite_prod" id="quantite_prod">
                    </div>

                    <div class="col-md-2">
                        
                        <label class="small mb-1" for="inputEmailAddress">Prix Unitaire H.T : </label>
                        <input type="number" required="true" required class="form-control prixs" name="prix_prod" id="prix_prod">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                
                <input type="submit" class="btn btn-outline-primary col-md-6" value="Valider La Demande" name="Valider La Demande">

                 {{--<button type="submit" class="btn btn-outline-primary col-md-6">Valider La Demande</button>--}}
                <a class="btn btn-outline-danger col-md-6" href="" aria-expanded="false">
                    Refaire La Demmande
                </a>
            </div>
        </form>


        {{--  --}}
    </div>    


    <script src="{{ asset('../js/demandevente1.js') }}" ></script>

    <script type="text/javascript">
        
        var produits = ({!! $produitss !!});

        //
    </script>



    {{--  --}}
@endsection