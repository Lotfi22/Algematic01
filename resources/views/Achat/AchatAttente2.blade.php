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
                        <h1 style="text-align: center;  " ><B>Liste Des Demandes d'Achats</B></h1>
                      </div>
                      <br>


      <table   id="table_id" class="display">
      <thead>
            <tr>
                <th scope="col"><B>Type</B></th>
                <th scope="col"><B>Date</B></th>
                <th scope="col"><B>Informations</B></th>
                <th scope="col"><B>Statut</B></th>
               
                
            </tr>

      </thead>
          <tbody>
            @foreach($presachats as $preachat)
            
            <tr>

              <td scope="row"><B>{{$preachat->typeachat}}</B></td>

              <td scope="row"><B>{{$preachat->date_achat}}</B></td>

              

              <td>

                <button type="button" title="Information sur la demande"  class="btn-sm btn btn-info" data-toggle="modal" data-target="#InfosDemande{{$preachat->idpreachat}}">
                       Infos 
                    </button>


                     <!-- Liste des produits 1er buttom -->
                     
                    <div class="modal fade" id="InfosDemande{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="InfosDemandeexampleModalLabel{{$preachat->idpreachat}}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="InfosDemandeexampleModalLabel{{$preachat->idpreachat}}">Informations sur la Demande</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                                
                                  <!--  Information du Fournisseur-->

                                  <h2 style="text-align: center;"><B>* Information du Fournisseur *</B></h2>
                            
                                    <ul>
                                      
                                     <li>Nom:<B>{{$preachat->nom}}</B></li>
                                     <li>Adresse:<B>{{$preachat->adresse}}</B></li>
                                     <li>Activité:<B>{{$preachat->activite}}</B></li>
                                     <li>Télé:<B>{{$preachat->tele}}</B></li>
                                     <li>Email:<B>{{$preachat->email}}</B></li>
                                    </ul>

                                    <!--  Fin Information du Fournisseur-->
                                    <br>
                                    <B><hr></B>

                                    <!--   Pièces jointes FP CONTRAT ...-->

                                    @if( $preachat->pieces_jointes == 'non')

                                      <h4 style="text-align: center;"><B>Aucun Document Ajouté !</B></h4>

                                    @endif

                                     @if( $preachat->pieces_jointes == 'yes')

                                      <h2 style="text-align: center;"><B>* Documents Joints *</B></h2>

                                      <table>
                                      <thead>
                                        <tr>
                                          <th><B>Pièce</B></th>
                                          <th><B>Détail</B></th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        @foreach($pieces as $piece)
                                        @if($piece->id_pre_achat== $preachat->idpreachat)

                                          <tr>
                                             <td><B>{{$piece->type}}</B></td>
                                             
                                             <td><a class="btn btn-primary" href="/home/achats/TelechargerPiece/{{$piece->IdPiece}}" role="button">Télécharger</a>
                                             </td>
                                          </tr>

                     
                                        @endif
                                        @endforeach
                                      </tbody>
                                    </table>


                                    @endif

                                    <!--  FIN  Pièces jointes FP CONTRAT ...-->
                                    <br>
                                    <B><hr></B>
                                    <!--   Information des produits-->

                                     <h2 style="text-align: center;"  ><B>* Liste des Produits demandés *</B></h2>
                                   <table   style="width:100%">
                                      <thead>
                                        <tr>
                                          <th scope="col"><B>Code_Produit</B></th>
                                          <th scope="col"><B>Qte En Stock</B></th>
                                          <th scope="col"><B>Qte Demandée</B></th>
                                          <th scope="col"><B>Ancien_Prix</B></th>
                                          <th scope="col"><B>Nv_Prix</B></th>
                                          <th scope="col"><B>Joint</B></th>
                               

                                         
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($produits2 as $prod2)
                                        @if($prod2->id_pre_achat== $preachat->idpreachat)
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

                                          @if($prod2->ficheYN =='yes')
                                            <td scope="row"><a class="btn btn-primary" href="/home/achats/TelechargerProduitFiche/{{$prod2->id_produit}}" role="button">Télécharger</a>
                                             </td>
                                          @endif
                                           @if($prod2->ficheYN =='non')
                                            <td scope="row">Rien</td>
                                          @endif

                                         
                                        

                                         


                                        </tr>
                                        @endif
                                        @endforeach
                              </tbody>
                            </table>

                             <h4 style="text-align: center;" ><B>Montant HT: {{number_format($preachat->montant)}}</B></h4>

                             @if($preachat->remiseradio =='oui')

                                 @if($preachat->type_remise =='pourcentage')
                                   <h4 style="text-align: center;" ><B>Remise: {{$preachat->remise}} %</B></h4>
                                   <h4 style="text-align: center;" ><B>Montant Avec remise: {{number_format($preachat->montant - ($preachat->montant * $preachat->remise / 100))}}</B></h4>

                                    <h4 style="text-align: center;" ><B>Montant TVA {{number_format($preachat->tva)}} % : {{ number_format(($preachat->montant - ($preachat->montant * $preachat->remise / 100))* $preachat->tva / 100)   }}</B></h4>

                                      <h4 style="text-align: center;" ><B>Total TTC: {{ number_format(($preachat->montant - ($preachat->montant * $preachat->remise / 100)) +  ($preachat->montant - ($preachat->montant * $preachat->remise / 100))* $preachat->tva / 100)   }} </B></h4>

                                 @endif

                                 @if($preachat->type_remise =='montant')
                                 <h4 style="text-align: center;" ><B>Remise: {{number_format($preachat->remise)}} DA</B></h4>
                                 <h4 style="text-align: center;" ><B>Montant Avec remise: {{ number_format($preachat->montant -$preachat->remise) }}</B></h4>

                                 <h4 style="text-align: center;" ><B>Montant TVA {{$preachat->tva}} % : {{ number_format(($preachat->montant - ( $preachat->remise))* $preachat->tva / 100)   }}</B></h4>

                                     <h4 style="text-align: center;" ><B>Total TTC: {{ number_format(($preachat->montant - ( $preachat->remise )) +  ($preachat->montant - ( $preachat->remise))* $preachat->tva / 100 )  }} </B></h4>
                                 @endif
                             @endif

                              
                                    
                                        
                              @if($preachat->remiseradio =='non')

                                 <h4 style="text-align: center;" ><B>Montant TVA {{$preachat->tva}} % : {{ number_format(($preachat->montant * $preachat->tva / 100))   }}</B></h4>

                                     <h4 style="text-align: center;" ><B>Total TTC: {{ number_format(($preachat->montant ) +  (($preachat->montant * $preachat->tva / 100)))  }} </B></h4>

                               @endif
                            

                             

                       <br>
                  
                  <div class="modal-footer">

                     @if( ($privilege ?? '' == 1) && ($preachat->demande_valide==0) && ($preachat->refuser==0))
                      <button type="button"  class="btn-sm btn btn-primary"   data-toggle="modal" data-target="#valider{{$preachat->idpreachat}}">
                                Valider
                      </button>
                      @endif

                      @if( ($privilege ?? '' == 1) && ($preachat->demande_valide==0) && ($preachat->refuser==0))
                       <button type="button" class="btn-sm btn btn-danger"  data-toggle="modal" data-target="#exampleModalSUPPRIMERpreachat{{$preachat->idpreachat}}">
                                 Refuser
                      </button>
                      @endif

                      @if( ($preachat->demande_valide==1) && ($preachat->refuser==0) && ($preachat->anonyme=='non') )

                        <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#TelechargerBC{{$preachat->idpreachat}}">Télecharger BC
                        </button>
                      @endif
        

                    
                    <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</
                  </div>


                        </div>
                      </div>
                    </div>

                     <!-- Modal de validation -->
                    <div class="modal fade" id="valider{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="exampleModalLabelValidation{{$preachat->idpreachat}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelValidation{{$preachat->idpreachat}}">Voulez Vous Vraiment Valider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/ValiderPreAchat/{{$preachat->idpreachat}}" method="POST">
                        {{ csrf_field()}}
                  
                              
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

                    <div class="modal fade" id="exampleModalSUPPRIMERpreachat{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="exampleModalLabelRefuser{{$preachat->idpreachat}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelRefuser{{$preachat->idpreachat}}">Voulez vous vraiment Refuser</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/RefuserDemande/{{$preachat->idpreachat}}" method="POST">
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




                    <!-- Modal de telechargement du BC -->

                    <div class="modal fade" id="TelechargerBC{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="exampleModalLabelTelecharger{{$preachat->idpreachat}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelTelecharger{{$preachat->idpreachat}}">Telecharger</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/ValiderPreAchat/{{$preachat->idpreachat}}/{{$preachat->num_facture_proformat}}" method="POST">
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

                    <!-- Fin Modal de telechargement du BC -->

              </td>

              <!-- TD du STATUT -->
              <td>
                      @if(  ($preachat->demande_valide==0) && ($preachat->refuser==0) )
                        
                   
                        <button  type="button"  class="btn-sm btn btn-secondary" title="Validez ou refusez la demande">En Cours ...</button>

                      @endif

                      @if(  ($preachat->demande_valide==1) && ($preachat->refuser==0))
                        
                        <button type="button" class="btn-sm btn btn-success" title="Demande Validée" >Validée</button>

                      @endif
                      

                      @if( $preachat->refuser==1 )


                        <button type="button" title="Cliquez Pour voir le Motif de refus" class="btn-sm btn btn-danger"   data-toggle="modal" data-target="#MotifRefus{{$preachat->idpreachat}}">
                                Refusée
                      </button>

                         <!-- Modal de refus -->

                    <div class="modal fade" id="MotifRefus{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="exampleModalLabelMotifRefuser{{$preachat->idpreachat}}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelMotifRefuser{{$preachat->idpreachat}}">Motif de Refus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/achats/RefuserDemande/{{$preachat->idpreachat}}" method="POST">
                        {{ csrf_field()}}

                            <div class="modal-body">
                    
                              <p>Motif: <B>{{$preachat->commentaire}}</B></p>

                          </div>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</button>
                           
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>



                      @endif
              </td>

             

          </tr>

            @endforeach

          </tbody>
        </table>




<script src="{{ asset('../js/prevente.js') }}"></script>



@endsection



