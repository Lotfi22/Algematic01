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
   
    <!-- ajouter un aricle 2-->

       <div>
         <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalNVArticle2">
                      Ajouter Un Article
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalNVArticle2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouvel Article</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                                  <form class="needs-validation" novalidate action="/AddArticle/" method="POST" enctype="multipart/form-data">

                        {{ csrf_field()}}

                    <div class="modal-body">

                            <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Réferance</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="A001" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
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
                                      {{$produit->code_produit}} ** {{$produit->description}} ** Prix_Achat: {{$produit->prix}}** Quantité_Dispo: {{$produit->quantite}}
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>Référance</B></th>
              <th scope="col"><B>description</B></th>
              <th scope="col"><B>Infos</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($articles as $article)
            <tr>
              <td scope="row"><B>{{$article->nom}}</B></td>
              <td>{{$article->description}}</td>

             
               <td><!-- Button Infos Client -->
                  <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#infos{{$article->id}}">
                    Informations
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="infos{{$article->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel" >Informations de l'article - <B 
                             >Total =  {{$article->total}}  DA</B></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <table class="table table-striped table-dark">
                          <thead>
                            <tr>
                              <th scope="col"><B>Code_Produit</B></th>
                              <th scope="col"><B>Description</B></th>
                              <th scope="col"><B>Prix_Vente</B></th>
                              <th scope="col"><B>Quantité</B></th>
                              
                            </tr>
                          </thead>
                          <tbody>

                            @foreach($produit_article as $prod)

                            @if( $prod->id_article == $article->id )
                            <tr>
                                <td scope="row"><B>{{$prod->code_produit}}</B></td>
                                <td>{{$prod->description}}</td>
                                <td>{{$prod->prix}}</td>
                                <td>{{$prod->quantite}}</td>


                            </tr>
                            @endif
                           @endforeach

                          </tbody>
                         </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              
                           
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFarticle{{$article->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFarticle{{$article->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ModifProduit/{{$produit->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                           <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Code Produit</B></label>
                                  <input type="text"  name="code" class="form-control" placeholder="A001" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Description</B></label>
                                  <input type="text" name="description"class="form-control"  placeholder="EL HAMIZ" required>
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
                 <td><button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERarticle{{$article->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERarticle{{$article->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/SupprimerProduit/{{$produit->id}}" method="POST">
                        {{ csrf_field()}}
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-danger">Supprimer</button>
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