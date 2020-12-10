@extends('../layouts.admin')
@section('content')         
    
     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p style=" text-align : center; ">{{ \Session::get('success') }}</p>
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
                        <h1 style="text-align: center;  " >Liste Des Produits</h1>
                      </div>
                      <br>

    <div>
        <table  class="table table-striped table-dark"  id="table_id" class="display">
          <thead>
            <tr>
              <th scope="col"><B>Code_Produit</B></th>
              <th scope="col"><B>Description</B></th>
              <th scope="col"><B>Fiche</B></th>
              <th scope="col"><B>Quantité</B></th>
              <th scope="col"><B>Prix</B></th>
              <th scope="col"><B>Date_Stock</B></th>
              <th scope="col"><B>Modifier</B></th>
              
            </tr>
          </thead>
          <tbody>
            @foreach($stocks as $stock)
            <tr>
              <td scope="row"><B>{{$stock->code_produit}}</B></td>

              <td>{{$stock->description}}</td>

                <td><!-- Button trigger modal -->

                  @if($stock->ficheYN =='non')
                  <p><B>Rien</B></p>
                  @endif
                  @if($stock->ficheYN =='yes')
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#staticBackdrop{{$stock->IdStock}}">
                    Document
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop{{$stock->IdStock}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Document Joints</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            
                            <table>
                              <thead>
                                  
                                  <tr>
                                    <th>Type Document</th>
                                    <th>Joint</th>
                                  </tr>

                              </thead>

                              <tbody>

                               @foreach($pieces as $piece) 

                                @if($piece->id_produit==$stock->id_produit)
                                <tr>

                                    <td>{{$piece->type}}</td>

                                    <td>
                                          <a class="btn btn-primary" href="/home/achats/TelechargerProduitFiche/{{$piece->IdPiece}}" role="button">Télécharger</a>
                                    </td>

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
                  @endif

                </td>
               
              <td>{{$stock->quantite}}</td>
              <td>{{$stock->prix}}</td>
              <td>{{$stock->date_arrivage}}</td>
              <td><button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$stock->IdStock}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModal{{$stock->IdStock}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelle Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/stocks/Modifstock/{{$stock->IdStock}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Nouveau Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="CAMERA ET CABLES" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>Nouvelle Adresse</B></label>
                                  <input type="text" name="adresse"class="form-control"  placeholder="EL HAMIZ" required>
                                </div>
                              </div>

                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Nouvelle Supérficie</B></label>
                                  <input type="text" name="superficie"class="form-control" placeholder="30 m2" required>
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