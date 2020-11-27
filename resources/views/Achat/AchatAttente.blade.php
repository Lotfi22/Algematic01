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
   


  <table class="table table-striped table-dark"  id="table_id" class="display">
      <thead>
            <tr>
                <th scope="col"><B>Type</B></th>
                <th scope="col"><B>Date</B></th>
                <th scope="col"><B>Fournisseur</B></th>
                <th scope="col"><B>Informations</B></th>
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

              <td scope="row"><B>{{$preachat->typeachat}}</B></td>

              <td scope="row"><B>{{$preachat->date_achat}}</B></td>

              <td scope="row">
                  
                  <button type="button" class="btn-sm btn btn-warning" data-toggle="modal" data-target="#Fournisseur{{$preachat->id}}">
                       Fournisseur
                    </button>

                    <!-- Infos Fournis -->
                    <div class="modal fade bd-example-modal-xl" id="Fournisseur{{$preachat->id}}" tabindex="-1" aria-labelledby="FournisseurmyHugeModalLabel{{$preachat->id}}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="FournisseurmyHugeModalLabel{{$preachat->id}}">Informations du Fournisseur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                                
                                  
                             <table  id="table_id" class="display" style="width:100%">

                                <thead>
                                  <tr>
                                    <th scope="col"><B>Nom</B></th>
                                    <th scope="col"><B>Adresse</B></th>
                                    <th scope="col"><B>Activite</B></th>
                                    <th scope="col"><B>Tele</B></th>
                                    <th scope="col"><B>Fax</B></th>
                                    <th scope="col"><B>Email</B></th>
                                    <th scope="col"><B>Fabricant</B></th>
                                    <th scope="col"><B>Anonyme</B></th>
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  <tr>
                                     <td scope="row"><B>{{$preachat->nom}}</B></td>
                                     <td scope="row"><B>{{$preachat->adresse}}</B></td>
                                     <td scope="row"><B>{{$preachat->activite}}</B></td>
                                     <td scope="row"><B>{{$preachat->tele}}</B></td>
                                     <td scope="row"><B>{{$preachat->fax}}</B></td>
                                     <td scope="row"><B>{{$preachat->email}}</B></td>
                                     <td scope="row"><B>{{$preachat->fabricant}}</B></td>
                                     <td scope="row"><B>{{$preachat->anonyme}}</B></td>
                                  </tr>

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
                    <button type="button"  class="btn-sm btn btn-warning"  data-toggle="modal" data-target="#InfosDemande{{$preachat->id}}">
                       Infos Demande
                    </button>

                    <!-- Liste des produits 1er buttom -->
                    <div class="modal fade" id="InfosDemande{{$preachat->id}}" tabindex="-1" aria-labelledby="InfosDemandeexampleModalLabel{{$preachat->id}}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="InfosDemandeexampleModalLabel{{$preachat->id}}">Informations sur la Demande</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                                
                                  <h3 style="text-align: center;"  ><B>Liste des Produits demandés</B></h3>
                                   <table   style="width:100%">
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
                                        @foreach($produits2 as $prod2)
                                        @if($prod2->id_pre_achat== $preachat->id)
                                        <tr>
                                           <td scope="row"><B>{{$prod2->code_produit}}</B></td>
                                           <td scope="row">
                                              @foreach($produits as $prod)
                                                 @if($prod->id_produit == $prod2->id_produit)
                                                  <B>{{$prod->quantite}}</B>
                                                 @endif
                                               @endforeach
                                           </td>
                                           <td scope="row"><B>{{$prod2->qte_demande}}</B></td>
                                           <td scope="row">
                                              @foreach($produits as $prod)
                                                 @if($prod->id_produit == $prod2->id_produit)
                                                  <B>{{$prod->prix}}</B>
                                                 @endif
                                               @endforeach
                                           </td>
                                           <td scope="row"><B>{{$prod2->nv_prix}}</B></td>
                                        </tr>
                                        @endif
                                        @endforeach
                              </tbody>
                            </table>
                             <h3 style="text-align: center;" ><B>Montant HT: {{$preachat->montant}}</B></h3>
                             @if($preachat->remiseradio =='oui')
                             <h3 style="text-align: center;" ><B>Remise: {{$preachat->remise}} %</B></h3>
                             <h3 style="text-align: center;" ><B>Montant Avec remise: {{$preachat->montant - ($preachat->montant * $preachat->remise / 100)}}</B></h3>
                             @endif
                             <hr>
                                <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</
                          </div>


                        </div>
                      </div>
                    </div>

                    <!--Fin  Liste des produits 1er buttom -->

                   

                </td>

             

              

              <td>

                @if( ($preachat->demande_valide == 0) && ($preachat->refuser ==0) )
                  <button  class="btn-sm btn btn-dark">En_Attente</button>
                @endif

                @if($preachat->refuser == 1)
                  <button  class="btn-sm btn btn-danger">Refusée</button>
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
                     <form class="needs-validation" novalidate action="/home/achats/Ranger/{{$preachat->id}}" method="POST" enctype="multipart/form-data">
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
                     <form class="needs-validation" novalidate action="/home/achats/AddAchat/{{$preachat->id}}" method="POST" enctype="multipart/form-data">
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
              @if( ($privilege ?? '' == 1) )
              <td>
                    
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Validation
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @if( ($privilege ?? '' == 1) && ($preachat->demande_valide==0))
            <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#valider{{$preachat->id}}">
                      Valider
            </button>
            @endif
            @if( ($privilege ?? '' == 1) && ($preachat->demande_valide==0) )
             <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#exampleModalSUPPRIMERpreachat{{$preachat->id}}">
                       Refuser
            </button>
            @endif

          </div>
          <!-- Modal de validation -->
                    <div class="modal fade" id="valider{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez Vous Vraiment Valider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/ValiderPreAchat/{{$preachat->id}}/{{$preachat->num_facture_proformat}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Valider</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

               

        </div>
          <!-- Modal de refus -->

                    <div class="modal fade" id="exampleModalSUPPRIMERpreachat{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Refuser</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/RefuserDemande/{{$preachat->id}}" method="POST">
                        {{ csrf_field()}}

                            <div class="modal-body">
                    
                              <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Motif refus</B></label>
                                  <input type="text" name="commentaire"class="form-control" placeholder="Prix Invalide" required>
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

                @if($preachat->demande_valide==1 )
    
                             <td>
                    <button type="button" class="btn-sm btn btn-warning" data-toggle="modal" data-target="#valider{{$preachat->id}}">
                      Télecharger BC
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="valider{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Telecharger</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/ValiderPreAchat/{{$preachat->id}}/{{$preachat->num_facture_proformat}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Telecharger</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>

                @endif
                
                @if($preachat->demande_valide==1 )
    
                    <td>
                      <p class="alert alert-secondary" style="text-align: center; height: 40px;"> <i class="mdi mdi-check"></i> {{-- Demande Validée --}}</p>
                    </td>

                @endif




            </tr>
            @endforeach
          </tbody>
        </table>





@endsection