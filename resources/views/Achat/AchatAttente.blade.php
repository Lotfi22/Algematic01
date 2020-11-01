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
                        <h1 style="text-align: center;  " >Liste Des Demandes d'Achats</h1>
                      </div>
                      <br>
   

    <div>
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>N° FP</B></th>
              <th scope="col"><B>Photo FP</B></th>
              <th scope="col"><B>Infos Demande</B></th>
              <th scope="col"><B>Achat</B></th>
              @if($privilege ?? '' == 1)
              <th scope="col"><B>Valider</B></th>
              @endif
               @if($privilege ?? '' == 1)
              <th scope="col"><B>Refuser</B></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($presachats as $preachat)
            <tr>
              <td scope="row"><B>{{$preachat->num_facture_proformat}}</B></td>
              <td><!-- Photo Facture proformat -->
                  <button type="button" class="btn-sm btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop{{$preachat->num_facture_proformat}}">
                    Photo FP
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop{{$preachat->num_facture_proformat}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo_FP</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img width="100%" src="{{asset('images/DemandeAchat/'.$preachat->facture_proformat_photo ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>

               <td>
                    <button type="button" class="btn-sm btn btn-warning" data-toggle="modal" data-target="#InfosDemande{{$preachat->id}}">
                       Infos
                    </button>

                    <!-- Infos Demande Achat -->
                    <div class="modal fade" id="InfosDemande{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations sur la Demande</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                                
                                
                                   <table class="table table-striped table-dark">
                                      <thead>
                                        <tr>
                                          <th scope="col"><B>Code_Produit</B></th>
                                          <th scope="col"><B>Qte En Stock</B></th>
                                          <th scope="col"><B>Qte Demandée</B></th>
                                          <th scope="col"><B>Ancien_Prix</B></th>
                                          <th scope="col"><B>Nv_Prix</B></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($produits as $prod)
                                        @if($prod->id_pre_achat== $preachat->id)
                                        <tr>
                                           <td scope="row"><B>{{$prod->code_produit}}</B></td>
                                           <td scope="row"><B>{{$prod->quantite}}</B></td>
                                           <td scope="row"><B>{{$prod->qte_demande}}</B></td>
                                           <td scope="row"><B>{{$prod->prix}}</B></td>
                                           <td scope="row"><B>{{$prod->nv_prix}}</B></td>
                                        </tr>
                                        @endif
                                        @endforeach
                              </tbody>
                            </table>
                                <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</
                          </div>


                        </div>
                      </div>
                    </div>
                </td>

              <td>

                @if($preachat->demande_valide == 0)
                  <button  class="btn-sm btn btn-dark">En_Attente</button>
                @endif

                 @if($preachat->ranger ==1)
                  <button  class="btn-sm btn btn-primary">Stockage Effectué</button>
                @endif

                @if( ($preachat->achat_done ==1) && ($preachat->ranger ==0) )
                  <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ranger{{$preachat->id}}">
                       Stocker
                    </button>

                    <!-- Stockage -->
                    <div class="modal fade" id="ranger{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"  id="exampleModalLabel">Informations du Rangement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Ranger/{{$preachat->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        
                          
                         <div class="modal-body">

                    
                              <div class="form-row">
                               <div class="col-md-12 mb-6">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Employe_Range</B></label>
                                    <select name="employe" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($employes as $employe)
                                     <option value="{{$employe->id}}"> {{  $employe->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>

                    @foreach($nvproduits as $prod)

                        @if($prod->id_pre_achat == $preachat->id)
                                  
                            <div class="form-row">

                            
                               <div class="col-md-6 mb-3">
                                  <div class="form-group">
                                    <label for="etagere">Ranger le Produit<B> {{$prod->code_produit}}--{{$prod->description}}</B></label>
                                    <select name="etagere" class="form-control" id="etagere" >
                                     @foreach($etageres as $etagere)
                                     <option value="{{$etagere->id}}"> {{  $etagere->description  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                             </div> 

                          </div>

                        @endif

                    @endforeach

                          
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Ranger</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>

             
              @endif

                  @if( ($preachat->demande_valide == 1) && ( $preachat->achat_done==0))
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#exampleModalBC{{$preachat->id}}">
                       Achat
                    </button>

                    <!-- Boutom d'achat -->
                    <div class="modal fade" id="exampleModalBC{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"  id="exampleModalLabel">Informations de l'Achat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/AddAchat/{{$preachat->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        
                          
                          <div class="modal-body">
              
                              

                               <div class="form-row">
                                  <div class="col-md-6 mb-3">
                                    <label for="validationTooltip03"><B>N° BL </B></label>
                                    <input type="text" name="bl"class="form-control" placeholder="BL0600" required>
                                 </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="validationTooltip03"><B>N° Attachement </B></label>
                                    <input type="text" name="attachement"class="form-control" placeholder="AT0600" required>
                                 </div>
                                </div>

                                <div class="form-row">
                                 <div class="col-md-6 mb-3">
                                    <label for="validationTooltip03"><B>N° Décharge </B></label>
                                    <input type="text" name="decharge"class="form-control" placeholder="BL0600" required>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>N° Facture </B></label>
                                  <input type="text" name="facture"class="form-control" placeholder="F20600" required>
                                </div>
                                </div>

                                <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo Facture</B></label>
                                  <input type="file" name="photofacture"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>

                                <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo BL</B></label>
                                  <input type="file" name="photobl"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>

                               

                                <div class="form-row">

                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo Attachement</B></label>
                                  <input type="file" name="photoattachement"  class="form-control-file" id="exampleFormControlFile1">
                                </div>

                              </div>


                                <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo Décharge</B></label>
                                  <input type="file" name="photodecharge"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>
                              <div class="form-row">
                               <div class="col-md-12 mb-6">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Nature Doc_Payement</B></label>
                                    <select name="doc" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($nature_doc_payments as $doc)
                                     <option value="{{$doc->id}}"> {{  $doc->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
                                  </div>

                            </div> 
                          </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Ajouter</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>

             
              @endif
              @if( ($privilege ?? '' == 1) && ($preachat->demande_valide==0))
              <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#valider{{$preachat->id}}">
                      Valider
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="valider{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez Vous Vraiment Valider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ValiderPreAchat/{{$preachat->id}}/{{$preachat->num_facture_proformat}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">
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
                @endif

                @if($preachat->demande_valide==1)
                <td>
                  <button type="submit" class="btn-sm btn btn-light">Demande Validée</button>
                </td>
                @endif
                @if( ($privilege ?? '' == 1) && ($preachat->demande_valide==0) )
                 <td>
                    <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERpreachat{{$preachat->id}}">
                       Refuser
                    </button>

                    <!-- Boutom dAjouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERpreachat{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Refuser</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/RefuserDemande/{{$preachat->id}}" method="POST">
                        {{ csrf_field()}}
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Refuser</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>




@endsection