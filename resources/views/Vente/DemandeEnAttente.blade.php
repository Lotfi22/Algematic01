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
                        <h1 style="text-align: center;  " >Liste Des Demandes de Vente</h1>
                      </div>
                      <br>
   

    <div>
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>Client</B></th>
              <th scope="col"><B>Infos Client</B></th>
              <th scope="col"><B>Infos Demande</B></th>
              <th scope="col"><B>Statut</B></th>
              @if($privilege ?? '' == 1)
              <th scope="col"><B>Valider</B></th>
              @endif
               @if($privilege ?? '' == 1)
              <th scope="col"><B>Refuser</B></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($ventes as $vente)
            <tr>
              <td scope="row"><B>{{$vente->code_client}}</B></td>
               <td><!-- Button Infos Client -->
                  <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#infosClient{{$vente->preVente}}">
                    Informations
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="infosClient{{$vente->preVente}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Informations du Client</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <ul>
                            <li><B>Téléphone :  </B>  {{$vente->tel}}</li>
                            <li><B>Fax :  </B>  {{$vente->fax}}</li>
                            <li><B>Mobile :  </B>  {{$vente->mobile}}</li>
                            <li><B>Email :  </B>  {{$vente->email}}</li>
                            <li><B>NIS :  </B>  {{$vente->NIS}}</li>
                            <li><B>NIF :  </B>  {{$vente->NIF}}</li>
                            <li><B>RC :  </B>  {{$vente->RC}}</li>
                            <li><B>N°_art_imp :  </B>  {{$vente->n_art_imp}}</li>
                            <li><B>Taux_remise_spec :  </B>  {{$vente->taux_remise_spec}}</li>
                            <li><B>Client_inter_fact :  </B>  {{$vente->client_inter_fact}}</li>
                            <li><B>Motif_interd :  </B>  {{$vente->motif_interd}}</li>
                            <li><B>Plafond_credit :  </B>  {{$vente->plafond_credit}}</li>
                            <li><B>Categorie_nom :  </B>  {{$vente->categorie_nom}}</li>
                            <li><B>Activite_nom :  </B>  {{$vente->activite_nom}}</li>
                            <li><B>Ajouter le :  </B>  {{$vente->created_at}}</li>
                          </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              <td>
                    <button type="button" class="btn-sm btn btn-warning" data-toggle="modal" data-target="#InfosDemande{{$vente->preVente}}">
                       Infos
                    </button>

                    <!-- Infos Demande Achat -->
                    <div class="modal fade" id="InfosDemande{{$vente->preVente}}" tabindex="-1" aria-labelledby="InfosDemande{{$vente->preVente}}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="InfosDemande{{$vente->preVente}}">Informations de la Vente  Demandée // Montant Total = <B>{{$vente->montant}}</B></h5>
                            <br>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <ul>
                            <li><B>Téléphone :  </B>  {{$vente->tel}}</li>
                            <li><B>Fax :  </B>  {{$vente->fax}}</li>
                            <li><B>Mobile :  </B>  {{$vente->mobile}}</li>
                            <li><B>Email :  </B>  {{$vente->email}}</li>
                            <li><B>NIS :  </B>  {{$vente->NIS}}</li>
                            <li><B>NIF :  </B>  {{$vente->NIF}}</li>
                            <li><B>RC :  </B>  {{$vente->RC}}</li>
                            <li><B>N°_art_imp :  </B>  {{$vente->n_art_imp}}</li>
                            <li><B>Taux_remise_spec :  </B>  {{$vente->taux_remise_spec}}</li>
                            <li><B>Client_inter_fact :  </B>  {{$vente->client_inter_fact}}</li>
                            <li><B>Motif_interd :  </B>  {{$vente->motif_interd}}</li>
                            <li><B>Plafond_credit :  </B>  {{$vente->plafond_credit}}</li>
                            <li><B>Categorie_nom :  </B>  {{$vente->categorie_nom}}</li>
                            <li><B>Activite_nom :  </B>  {{$vente->activite_nom}}</li>
                            <li><B>Ajouter le :  </B>  {{$vente->created_at}}</li>
                          </ul>
                        </div>
                                
                                
                                   <table class="table table-striped table-dark">
                                      <thead>
                                        <tr>	
                                          <th scope="col"><B>Article</B></th>
                                          <th scope="col"><B>Description</B></th>
                                          <th scope="col"><B>Prix_D'achat</B></th>
                                          <th scope="col"><B>Prix_u</B></th>
                                          <th scope="col"><B>Quantité</B></th>
                                          <th scope="col"><B>Total</B></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($ligne_ventes as $ligne)
                                        @if( $ligne->id_pre_vente == $vente->preVente)
                                        <tr>
                                           <td scope="row"> {{$ligne->nom}}</td>
                                           <td scope="row">  {{$ligne->description}}</td>
                                           <td scope="row"> {{$ligne->PrixArticleAchat}}</td>
                                        	<td scope="row"> {{$ligne->prix_u}}</td>
                                        	<td scope="row">  {{$ligne->quantite}}</td>
                                        	<td scope="row">{{$ligne->total}}</td>
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

                
                	@if($vente->statut_validation == 0)
                		<td>
                			<button type="button" class="btn-sm btn btn-success" >En Cours</button>
                		</td>
                     
                	@endif

                	@if($vente->statut_validation == 1)
                		
                		<td><!-- Button Infos Client -->
                  <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#Commentaire{{$vente->preVente}}">
                    Demanade Refusée
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="Commentaire{{$vente->preVente}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Motif de Refus</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        	<div class="form-row">
                        		<div class="col-md-12 mb-6">
                                  <div class="form-group">
                       			 <p><B>Refusée a cause de : {{$vente->commentaire}} </B></p>
                       			</div>
                       		</div>
                   			 </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>


                	@endif
                </td>

                           @if( ($privilege ?? '' == 1) && ($vente->statut_validation == 0 ) )
              <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#valider{{$vente->preVente}}">
                      Valider
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="valider{{$vente->preVente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez Vous Vraiment Valider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/ValiderDemandeVente/{{$vente->preVente}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary"  >Valider</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>
                @endif

 			@if(  ($vente->statut_validation == 2 ) )
              <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#FP{{$vente->preVente}}">
                      Editer FP
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="FP{{$vente->preVente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Télécharger Facture Proformat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/VenteFactureProformat/{{$vente->preVente}}" method="POST">
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

                
                @if( ($privilege ?? '' == 1) && ($vente->statut_validation == 0) )
                 <td>
                    <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERvente{{$vente->preVente}}">
                       Refuser
                    </button>

                    <!-- Boutom dAjouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERvente{{$vente->preVente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Refuser</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/RefuserDemandeVente/{{$vente->preVente}}" method="POST">
                        {{ csrf_field()}}

                        <div class="modal-body">

                            <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>Commentaire de Refus</B></label>
                                  <input type="text"  name="commentaire" class="form-control" placeholder="Le prix de l'article 01 est invalide" required>
                                </div>

                                
                              

                              
                </div>
                          
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

                @if(  $vente->statut_validation == 1 )
                 <td>
                 	<button type="button" class="btn-sm btn btn-dark" >Invalide</button>
                 </td>
                 		
                 @endif

            </tr>
            @endforeach
          </tbody>
        </table>
    </div>




@endsection
