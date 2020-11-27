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
                
            </tr>
      </thead>
          <tbody>
            @foreach($presachats as $preachat)
            
            <tr>

              <td scope="row"><B>{{$preachat->typeachat}}</B></td>

              <td scope="row"><B>{{$preachat->date_achat}}</B></td>

              <td>

                <div class="dropdown">

                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu{{$preachat->idpreachat}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Infos
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu{{$preachat->idpreachat}}">

                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#Fournisseur{{$preachat->idpreachat}}">
                       Fournisseur
                    </button>

                    

                    

                
                </div>

              </div>


               <!-- Infos Fournis -->
                    <div class="modal fade bd-example-modal-xl" id="Fournisseur{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="FournisseurmyHugeModalLabel{{$preachat->idpreachat}}" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <div class="modal-header">
                            <h5 class="modal-title" id="FournisseurmyHugeModalLabel{{$preachat->idpreachat}}">Informations du Fournisseur</h5>
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

                       <br>     
                   <B><hr></B>
                   

                          <!-- pieces jointes-->

                   <div class="modal-body">


                        <h3 style="text-align: center;"  ><B>Liste des Pièces Jointes</B></h3>

                                   <table   style="width:100%">
                                      <thead>
                                        <tr>
                                          <th scope="col"><B>Pièce</B></th>
                                          <th scope="col"><B>Détail</B></th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        @foreach($pieces as $piece)
                                        @if($piece->id_pre_achat== $preachat->idpreachat)

                                          <tr>
                                             <td scope="row"><B>{{$piece->type}}</B></td>
                                             
                                             <td scope="row"><a class="btn btn-primary" href="/home/achats/TelechargerPiece/{{$piece->IdPiece}}" role="button">Télécharger</a>
                                             </td>
                                          </tr>

                     
                                        @endif
                                        @endforeach
                              </tbody>
                            </table>

                    </div>


                          <!-- Fin pieces jointes-->

                                <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Fermer</
                          </div>


                        </div>
                      </div>
                    </div>

                    <!--Fin  Liste des produits 1er buttom -->
            


              </td>



          </tr>

            @endforeach

          </tbody>
        </table>





@endsection




