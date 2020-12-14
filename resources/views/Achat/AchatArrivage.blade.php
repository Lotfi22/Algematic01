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
                        <h1 style="text-align: center;  " ><B>Liste Des Arrivages</B></h1>
                      </div>
                      <br>


      <table  id="table_id" class="display">
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
                             <h4 style="text-align: center;" ><B>Montant HT: {{$preachat->montant}}</B></h4>
                             @if($preachat->remiseradio =='oui')
                             <h4 style="text-align: center;" ><B>Remise: {{$preachat->remise}} %</B></h4>
                             <h4 style="text-align: center;" ><B>Montant Avec remise: {{$preachat->montant - ($preachat->montant * $preachat->remise / 100)}}</B></h4>
                             @endif
                             <!--   Information des produits-->

                       <br>
                  
                  <div class="modal-footer">

                    

                      @if( ($preachat->demande_valide==1) && ($preachat->anonyme=='non') )

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

                   @if( ($preachat->achat_done==1) )
                        
                   
                        <button type="button" class="btn-sm btn btn-success">Achat Effectué</button>

                      @endif

                     
        

                  @if( ($preachat->achat_done==0) && ($preachat->ranger==0))

                   <button type="button" class="btn-sm btn btn-secondary"  data-toggle="modal" data-target="#ACHAT{{$preachat->idpreachat}}">
                             Arrivage  en Attente...
                          </button>

                  @endif

                  



                                            <!-- Modal d'Achat -->

          <div class="modal fade bd-example-modal-lg" id="ACHAT{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Achat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
      <form class="needs-validation" novalidate action="/home/achats/AddAchat/{{$preachat->idpreachat}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field()}}
        
          
        <div class="modal-body">
                    

                       <h4 ><B>Ajouter des pièces jointes</B></h4>

            <div class="form-row">
            
                <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="Joint{{$preachat->idpreachat}}" name="joint{{$preachat->idpreachat}}" value="yes" checked  onclick="yesnoCheckJoint{{ $preachat->idpreachat }}()" >
                <label class="custom-control-label" for="Joint{{$preachat->idpreachat}}">Oui</label>
              </div>

              <!-- Default checked -->
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="NonJoint{{$preachat->idpreachat}}" name="joint{{$preachat->idpreachat}}" value="non" onclick="yesnoCheckJoint{{ $preachat->idpreachat }}()">
                <label class="custom-control-label" for="NonJoint{{$preachat->idpreachat}}">Non</label>
            
              </div>

          </div>
          <br> 
      
       
      <br> 

                           
      <div class="form-row" id="Monjoint{{$preachat->idpreachat}}">


          <div class="form-group items" id="dynamic_form{{$preachat->idpreachat}}">

                  <div class="row">
                  <div class="button-group" style="padding: 27px;">
                          <a href="javascript:void(0)" class="btn btn-primary" id="plus{{$preachat->idpreachat}}"><i class="fa fa-plus"></i></a>
                          <a href="javascript:void(0)" class="btn btn-danger" id="minus{{$preachat->idpreachat}}"><i class="fa fa-minus"></i></a>
                      </div>

                  <div class="form-row">

                      <div class="col-md-6 mb-3">
                          <label class="small mb-1" for="inputFirstName">Type Pièce: </label>
                          <select class='form-control produits' class="js-example-basic-single" name='typepiece' id="typepiece" >
                              <option value=""></option>
                              @foreach($types as $type)
                              <option id="{{$type->type}}"  value="{{$type->id}}">
                                  <B>{{$type->type}} </B>
                              </option>
                              @endforeach 
                          </select>   
                      </div>

                          <div class="col-md-6 mb-3">
                              <label class="small mb-1" for="inputEmailAddress">Numéro/Dénomination</label>
                              <input type="text" class="form-control quantites" name="facture" id="facture" placeholder="FP001/2020, Contrat 001, BL001 ....";>
                          </div>
                    

                    

                  </div>


                  

                  <div class="form-row" style="margin-left: 100px">

                       <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Date pièce </label>
                        <input type="date" class="form-control quantites" name="date" id="date" placeholder="02/05/2018";>
                    </div>

                     
                    <div class="col-md-6 mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Pièce Jointe </label>
                        <input type="file"  class="form-control-file" name="photo" id="photo" >
                    </div>

                  
                </div>

              </div>

        </div>

                       
                        </div>
                        

                         <hr>
                        <div class="form-row">
                         <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1"><h4><B>Nature de Payement</B></h4></label>
                              <select name="doc" class="form-control">
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

<!-- FIN Modal d'Achat -->



              <!-- Modal de telechargement du BC -->

              <div class="modal fade" id="TelechargerBC{{$preachat->idpreachat}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Telecharger</h5>
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
           

          </tr>

            @endforeach

          </tbody>
        </table>



<script src="{{ asset('../js/prevente.js') }}"></script>

@foreach($presachats as $preachat)



    <script type="text/javascript">

      $(document).ready(function() {
                var dynamic_form{{ $preachat->idpreachat }} =  $("#dynamic_form{{ $preachat->idpreachat }}").dynamicForm("#dynamic_form{{ $preachat->idpreachat }}","#plus{{ $preachat->idpreachat }}", "#minus{{ $preachat->idpreachat }}", {
                    limit:10,
                    formPrefix : "dynamic_form{{ $preachat->idpreachat }}",
                    normalizeFullForm : false
                });

                dynamic_form{{ $preachat->idpreachat }}.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

                $("#dynamic_form{{ $preachat->idpreachat }} #minus{{ $preachat->idpreachat }}").on('click', function(){
                    var initDynamicId = $(this).closest('#dynamic_form{{ $preachat->idpreachat }}').parent().find("[id^='dynamic_form{{ $preachat->idpreachat }}']").length;
                    if (initDynamicId === 2) {
                        $(this).closest('#dynamic_form{{ $preachat->idpreachat }}').next().find('#minus{{ $preachat->idpreachat }}').hide();
                    }
                    $(this).closest('#dynamic_form{{ $preachat->idpreachat }}').remove();
                });

                $('form').on('submit', function(event){
                    var values = {};
                    $.each($('form').serializeArray(), function(i, field) {
                        values[field.name] = field.value;
                    });
                    console.log(values)
                    event.preventDefault();
                })
            });

    </script>


@endforeach

  @foreach($presachats as $preachat)

  <script type="text/javascript">

              document.getElementById('Monjoint{{ $preachat->idpreachat }}').style.display = 'block';
         function yesnoCheckJoint{{$preachat->idpreachat }}() {
              if (document.getElementById('Joint{{ $preachat->idpreachat }}').checked) {
                  document.getElementById('Monjoint{{ $preachat->idpreachat }}').style.display = 'block';
              } 
              else if(document.getElementById('NonJoint{{ $preachat->idpreachat }}').checked) {
                  document.getElementById('Monjoint{{ $preachat->idpreachat }}').style.display = 'none';
             }
          }

          //
  </script>

  @endforeach

@endsection





