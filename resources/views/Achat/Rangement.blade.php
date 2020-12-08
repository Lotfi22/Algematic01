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
                        <h1 style="text-align: center;  " >Liste Des Achats/Arrivages</h1>
                      </div>
                      <br>


      <table class="table table-striped table-dark"  id="table_id" class="display">
      <thead>
            <tr>
                <th scope="col"><B>Type</B></th>
                <th scope="col"><B>Date</B></th>
                <th scope="col"><B>Informations</B></th>
                <th scope="col"><B>Achat</B></th>
                
            </tr>
      </thead>
          <tbody>
            @foreach($presachats as $preachat)
            
            <tr>

              <td scope="row"><B>{{$preachat->typeachat}}</B></td>

              <td scope="row"><B>{{$preachat->date_achat}}</B></td>

             


              
               <td>

                <button type="button"  class="btn-sm btn btn-primary" data-toggle="modal" data-target="#InfosDemande{{$preachat->idpreachat}}">
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

                                     <br>
                                    <B><hr></B>

                                     @if( $preachat->pieces_jointes == 'yes')

                                      <h2 style="text-align: center;"><B>* Documents Joints pre_Achat *</B></h2>

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

                               







                                    <!--   Pièces jointes ACHAT BL ...FP ...-->




                                     @if( $preachat->pieces_jointes == 'yes')

                                      <h2 style="text-align: center;"><B>* Documents Joints Achat *</B></h2>

                                      <table>
                                      <thead>
                                        <tr>
                                          <th><B>Document</B></th>
                                          <th><B>PièceJointe</B></th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        @foreach($PieceAchat as $piece)
                                        @if($piece->id_pre_achat == $preachat->idpreachat)

                                          <tr>
                                             <td><B>{{$piece->type}}</B></td>
                                             
                                             <td><a class="btn btn-primary" href="/home/achats/TelechargerPieceAchat/{{$piece->IdPiece}}" role="button">Télécharger</a>
                                             </td>
                                          </tr>

                     
                                        @endif
                                        @endforeach
                                      </tbody>
                                    </table>


                                    @endif
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
                             <h4 style="text-align: center;" ><B>Montant HT: {{$preachat->montant}}</B></h4>
                             @if($preachat->remiseradio =='oui')
                             <h4 style="text-align: center;" ><B>Remise: {{$preachat->remise}} %</B></h4>
                             <h4 style="text-align: center;" ><B>Montant Avec remise: {{$preachat->montant - ($preachat->montant * $preachat->remise / 100)}}</B></h4>
                             @endif
                             <!--   Information des produits-->

                       <br>
                  
                  <div class="modal-footer">

                    

                      @if( ($preachat->demande_valide==1)  )

                        <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#TelechargerBC{{$preachat->idpreachat}}">Télecharger BC
                        </button>
                      @endif
        

                    
                    <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</
                  </div>


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


               <!--Td d'Achat + statut-->
               
               <td>

                   @if(   $preachat->ranger==1)
                        
                   
                        <button type="button" class="btn-sm btn btn-success">Stockage éffectué</button>

                      @endif

                     
        

                  @if(   $preachat->ranger==0)

                 <a class="btn btn-warning" href="/home/achats/RangerPreAchat/{{$preachat->idpreachat}}" role="button">Ranger</a>

                  @endif

                  


               </td>
           

          </tr>

            @endforeach

          </tbody>
        </table>



<script src="{{ asset('../js/prevente.js') }}"></script>


@endsection





