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
      
        <h1 style=" text-align: center;"><B id="demandedevente">Demande De Vente D'Articles</B></h1>     

        <hr>

        <form class="needs-validation" id="ventes_articles" novalidate action="/AddDemandeVente" method="POST" enctype="multipart/form-data">

            {{ csrf_field()}}

            <div class="modal-body">

                <div class="form-row">
            
                    <div class="col-md-12 mb-6" >
            
                        <div class="form-group">

                            <div class="custom-control custom-radio col-md-4" onclick="afficher_que_produits()">
                                
                                <input type="radio" class="custom-control-input" checked id="produit11" name="type_vente">
                                
                                <label class="custom-control-label" for="produit11"><B>Produit</B></label>
                            </div>             

                            <div class="custom-control custom-radio col-md-4" onclick="afficher_que_articles()">   
                                <input type="radio" class="custom-control-input" id="article" name="type_vente">
                                
                                <label class="custom-control-label" for="article"><B>Article</B></label>
                            </div>             

                            <div class="custom-control custom-radio col-md-3" onclick="afficher_que_prestations()">
                                
                                <input type="radio" class="custom-control-input" id="Préstation" name="type_vente">
                                
                                <label class="custom-control-label" for="Préstation"><B>Préstation</B></label>
                            </div>             

                            <hr>

                            <br><br>
                        
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
                        <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i>
                        </a>
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
                        <input type="number" class="form-control quantites" min="1"  name="quantite" id="quantite">
                    </div>

                    <div class="col-md-3">
                        
                        <label class="small mb-1" for="inputEmailAddress">Prix Unitaire : </label>
                        <input type="number" class="form-control prixs" name="prix" id="prix" >
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                   
                <button type="submit" class="btn btn-outline-primary col-md-6">Valider La Demande</button>
                <a class="btn btn-outline-danger col-md-6" href="" aria-expanded="false">Annuler</span></a>
            </div>
        </form>








        




























        <form class="needs-validation" id="ventes_produits" novalidate action="/AddDemandeVente" method="POST" enctype="multipart/form-data">

            {{ csrf_field()}}

            <div class="modal-body">

                <div class="form-row">
            
                    <div class="col-md-12 mb-6" >
            
                        <div class="form-group">


                            <div class="custom-control custom-radio col-md-4" onclick="afficher_que_produits()">
                                
                                <input type="radio" class="custom-control-input" checked id="produit11" name="type_vente">
                                
                                <label class="custom-control-label" for="produit11"><B>Produit</B></label>
                            </div>             

                            <div class="custom-control custom-radio col-md-4" onclick="afficher_que_articles()">   
                                <input type="radio" class="custom-control-input" id="article" name="type_vente">
                                
                                <label class="custom-control-label" for="article"><B>Article</B></label>
                            </div>             

                            <div class="custom-control custom-radio col-md-3" onclick="afficher_que_prestations()">
                                
                                <input type="radio" class="custom-control-input" id="Préstation" name="type_vente">
                                
                                <label class="custom-control-label" for="Préstation"><B>Préstation</B></label>
                            </div>             

                            <hr>

                            <br><br>
                        
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


            <div class="form-group items" id="dynamic_form2">
                
                <div class="row">
                
                    <div class="button-group" style="padding: 27px;">
                        
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="fit_select();" id="plus55"><i class="fa fa-plus"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-danger" id="minus55"><i class="fa fa-minus"></i>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <label class="small mb-1" for="inputFirstName">Produit : </label>
                
                        <select class='form-control produits' onchange="get_prices(this);" class="js-example-basic-single" name='produits' required id="produits">
                
                            <option value=""></option>
                    
                            @foreach($produits as $produit)

                                <option value="{{$produit->id}}">
                                    
                                    {{$produit->code_produit}} | {{  $produit->description }} 

                                    {{--  --}}
                                </option>
                            @endforeach 
                        </select>   
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
                        
                        <label class="small mb-1" for="inputEmailAddress">Prix Unitaire : </label>
                        <input type="number" required="true" class="form-control prixs" name="prix_prod" id="prix_prod">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                
                <input type="submit" class="btn btn-outline-primary col-md-6" value="Valider La Demande" name="Valider La Demande">

{{--                 <button type="submit" class="btn btn-outline-primary col-md-6">Valider La Demande</button>
 --}}                <a class="btn btn-outline-danger col-md-6" href="" aria-expanded="false">Refaire La Demmande</span></a>
            </div>
        </form>


















        <form class="needs-validation" id="ventes_prestations" novalidate action="/AddDemandeVente" method="POST" enctype="multipart/form-data">

            {{ csrf_field()}}

            <div class="modal-body">

                <div class="form-row">
            
                    <div class="col-md-12 mb-6" >
            
                        <div class="form-group">


                            <div class="custom-control custom-radio col-md-4" onclick="afficher_que_produits()">
                                
                                <input type="radio" class="custom-control-input" id="produit11" name="type_vente">
                                
                                <label class="custom-control-label" for="produit11"><B>Produit</B></label>
                            </div>             

                            <div class="custom-control custom-radio col-md-4" onclick="afficher_que_articles()">   
                                <input type="radio" class="custom-control-input" id="article" name="type_vente">
                                
                                <label class="custom-control-label" for="article"><B>Article</B></label>
                            </div>             

                            <div class="custom-control custom-radio col-md-3" onclick="afficher_que_prestations()">
                                
                                <input type="radio" class="custom-control-input" checked id="Préstation" name="type_vente">
                                
                                <label class="custom-control-label" for="Préstation"><B>Préstation</B></label>
                            </div>             

                            <hr>

                            <br><br>
                        
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


            <div class="form-group items" id="dynamic_form3">
                
                <div class="row">
                
                    <div class="button-group" style="padding: 27px;">
                        <a href="javascript:void(0)" class="btn btn-primary" id="plus555"><i class="fa fa-plus"></i>
                        </a>

                        <a href="javascript:void(0)" class="btn btn-danger" id="minus555"><i class="fa fa-minus"></i>
                        </a>
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
                        <input type="number" class="form-control quantites" min="1"  name="quantite" id="quantite">
                    </div>

                    <div class="col-md-3">
                        
                        <label class="small mb-1" for="inputEmailAddress">Prix Unitaire : </label>
                        <input type="number" class="form-control prixs" name="prix" id="prix" >
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                   
                <button type="submit" class="btn btn-outline-primary col-md-6">Valider La Demande</button>
                <a class="btn btn-outline-danger col-md-6" href="" aria-expanded="false">Annuler</span></a>
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