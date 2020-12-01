@extends('../layouts.admin')
@section('content')         
    
    <style type="text/css">
            
        /* Chrome, Safari, Edge, Opera */

        {{--  --}}
    </style>

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
   
    <!-- ajouter un aricle 2-->

       
<div>
    
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalNVArticle2">
        <i class="mdi mdi-plus"></i> Ajouter Un Article            
    </button>

    <div class="modal fade" id="exampleModalNVArticle2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <div class="modal-dialog modal-lg">
    
            <div class="modal-content">
    
                <div class="modal-header">
    
                    <h5 class="modal-title" id="exampleModalLabel">Informations du Nouvel Article</h5>
    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                
                <form class="needs-validation" action="/AddArticle/" method="POST" enctype="multipart/form-data">

                    {{ csrf_field()}}

                        
                    <div class="modal-body">
                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <label for="validationTooltip01">
                                    <B>Réferance</B>
                                </label>
                                <input type="text" required name="Réferance" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationTooltip02">
                                    <B>Description</B>
                                </label>
                                <input type="text" required name="description_article"class="form-control" required>
                            </div>

                        </div>
                                  

                        {{--  --}}          
                    </div>
                            
                    <div class="form-group items" id="dynamic_form">
                        
                        <div class="row">
                        
                            <div class="button-group" style="padding: 27px;">
                                <a href="javascript:void(0)" class="btn btn-primary le_plus" onclick="plus1();" id="plus5">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger" onclick="moins1();" id="minus5">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>

                            <div class="col-md-3">
                        
                                <label class="small mb-1" for="inputFirstName">Produit: </label>
                        
                                <select onchange="get_prices(this)" class='form-control produits' class="js-example-basic-single" name='produit' id="produit" >
                                    <option value=""></option>
                                
                                    @foreach($produits as $produit)
                                        
                                        
                                        <option  value="{{$produit->id}}">
                                            {{$produit->code_produit}} | {{$produit->description}}
                                        </option>
                                    @endforeach 

                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="small mb-1" for="quantite">Qte : </label>
                                <input type="number" onchange="fill_arrays(this)" class="form-control quantites" name="quantite" id="quantite" min="1" required>
                            </div>
                            
                            <div class="col-md-2">
                                <label class="small mb-1" for="prix">Prix Achat H.T</label>
                                <input type="number" disabled class="form-control prixs" required name="prix" id="prix">
                            </div>

                            <div class="col-md-2">
                                <label class="small mb-1" for="prix_vente">PU H.T </label>
                                <input type="number" disabled class="form-control prix_ventes" required name="prix_vente" id="prix_vente">
                            </div>


                        </div>
                    </div>

                    <hr>
                    
                    <div style="margin: 0% 25%;" class="col-md-6 mb-3">
                        <label for="validationTooltip02">
                            <B>Prix Unitaire H.T Proposé</B>
                        </label>

                        <div style="display: none;" class="col-md-12">
                            
                            <label class="small mb-1" for="fayda">PU H.T </label>
                            <input type="number"  class="form-control" name="fayda" id="fayda">
                        </div>
                        
                        <input type="number" onkeyup="fit_benifice(this)" onchange="fit_benifice(this)" style="font-size: 2em;" {{-- onclick="fill_arrays(this)" --}} placeholder="Prix suggéré" id="Prix_propose" name="Prix_propose"class="form-control" required>


                    </div>

                    <b><h4 id="benifice"  style="text-align: center;" class="alert alert-success"></h4></b>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary col-md-6">Ajouter</button>
                        <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal">Fermer</button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- fin d'ajout num 2-->

    <br>
    <br>

<div>
    
    <table class="table table-striped display table-dark" id="table_id">
        
        <thead>
            <tr>
                <th scope="col">
                    <B>Référance</B>
                </th>
                <th scope="col">
                    <B>description</B>
                </th>
{{--                 <th scope="col">
                    <B>Infos</B>
                </th>
 --}}                <th scope="col">
                    <B>Date</B>
                </th>

                <th scope="col">
                    <B>Cout de l'article</B>
                </th>

                <th scope="col">
                    <B>Prix de vente</B>
                </th>
                <th scope="col">
                    <B>Bénifice</B>
                </th>                
            </tr>
        </thead>
        
        <tbody>

            @foreach($articles as $article)
        
            <tr id="Infos{{$article->id}}" data-toggle="modal" data-target="#infos{{$article->id}}" style="cursor: pointer;">
                
                <td scope="row">
                    <B>{{$article->nom}}</B>
                </td>
                
                <td>{{$article->description}}</td>
                                   
                <td>{!! substr($article->created_at,0,10) !!} - {!! substr($article->created_at,10,6) !!}</td>
                
                    
                <td style="text-align: center;">{!! number_format($article->total-$article->benifice) !!}</td> 
                <td style="text-align: center;">{!! number_format($article->total) !!}</td> 
                
                @if($article->benifice>0)
    
                    <td class="alert alert-success" style="text-align: center;">
                        
                 @else
                    <td class="alert alert-warning" style="text-align: center;">
                        

                @endif
                    {!! number_format($article->benifice) !!}
                </td> 
            </tr>
        @endforeach
        
    </tbody>
</table>
</div>

@foreach($articles as $article)

    <div class="modal fade" id="infos{{$article->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-lg">
        
            <div class="modal-content" >
        
                <div class="modal-header">
        
                    <h5 class="modal-title" id="staticBackdropLabel" >Informations de l'article - 
                        <B>Total =  {{$article->total}}  DA</B>
                    </h5>
        
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <table class="table table-striped table-dark">
                        
                        <thead>
                            <tr>
                                <th scope="col">
                                    <B>Code_Produit</B>
                                </th>
                                
                                <th scope="col">
                                    <B>Description</B>
                                </th>

                                <th scope="col">
                                    <B>Quantité</B>
                                </th>
                            </tr>
                        </thead>                                            
                           
                        <tbody>

                            @foreach($produit_article as $prod)

                                @if( $prod->id_article == $article->id )

                                    <tr>
                                        <td scope="row">
                                            <B>{{$prod->code_produit}}</B>
                                        </td>
                                        
                                        <td>{{$prod->description}}</td>
                                        
                                        <td>{{$prod->quantite}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                        {{--  --}}
                    </table>
                </div>

                <form class="needs-validation" action="/Supprimerarticle/{{$article->id}}" method="POST">

                    {{ csrf_field()}}

                    <div class="modal-footer">

                        <button style="margin: 0% 25%;" type="submit" class="btn btn-outline-danger col-md-6">Supprimer</button>
                    </div>
                </form>

                @if($article->benifice>0)
                    
                    <p class="alert alert-success" style="text-align: center;"> 
                        <b> Sur cet Article vous bénificiez de {!! $article->benifice !!} DA </b> 
                 @else                           
                    <p class="alert alert-warning" style="text-align: center;"> 
                        <b> Sur cet Article vous déficitez de {!! $article->benifice !!} DA </b> 
                    {{--  --}}
                @endif
                
                </p>                    

                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endforeach    


<script src="{{ asset('../js/articles.js') }}"></script>




@endsection