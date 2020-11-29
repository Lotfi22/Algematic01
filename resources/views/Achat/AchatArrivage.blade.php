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
                <th scope="col"><B>Fournisseur</B></th>
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
                                          <th scope="col"><B>Photo</B></th>
                                          <th scope="col"><B>Fiche</B></th>
                                          <th scope="col"><B>Caractéristiques</B></th>

                                         
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

                                          @if($prod2->photoYN =='yes')
                                            <td scope="row"><a class="btn btn-primary" href="/home/achats/TelechargerProduitPhoto/{{$prod2->id_produit}}" role="button">Télécharger</a>
                                             </td>
                                          @endif
                                           @if($prod2->photoYN =='non')
                                            <td scope="row">Rien</td>
                                          @endif

                                          @if($prod2->pieceYN =='yes')
                                            <td scope="row"><a class="btn btn-primary" href="/home/achats/TelechargerProduitFiche/{{$prod2->id_produit}}" role="button">Télécharger</a>
                                             </td>
                                          @endif
                                           @if($prod2->pieceYN =='non')
                                            <td scope="row">Rien</td>
                                          @endif

                                          @if($prod2->ficheYN =='yes')
                                            <td scope="row"><a class="btn btn-primary" href="/home/achats/TelechargerProduitCaracteristique/{{$prod2->id_produit}}" role="button">Télécharger</a>
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


               <!--Td d'approbation -->
               
               <td>

          <div class="dropdown">

            @if($preachat->achat_done==0)
          <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Plus 
          </button>
          @endif
          @if($preachat->achat_done==1)
          <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            effectué 
          </button>
          @endif
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

            @if( $preachat->achat_done==0)

            

             <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#ACHAT{{$preachat->idpreachat}}">
                       Achat
                    </button>

            @endif
           
            

            

              <button type="button" class="dropdown-item" data-toggle="modal" data-target="#TelechargerBC{{$preachat->idpreachat}}">Télecharger BC
                      
              </button>

            

            

           

          </div>
         
               

        </div>


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
      <form class="needs-validation" novalidate action="/home/achats/AddAchat/{{$preachat->id}}" method="POST" enctype="multipart/form-data">
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
                <input type="radio" class="custom-control-input" id="NonJoint{{$preachat->idpreachat}}" name="joint{{$preachat->idpreachat}}" value="non" onclick="yesnoCheckJoint()">
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

                      <div class="col-md-3">
                          <label class="small mb-1" for="inputFirstName">Type Pièce: </label>
                          <select class='form-control produits' class="js-example-basic-single" name='typepiece{{$preachat->idpreachat}}' id="typepiece{{$preachat->idpreachat}}" >
                              <option value=""></option>
                              @foreach($types as $type)
                              <option id="{{$type->type}}{{$preachat->idpreachat}}"  value="{{$type->id}}">
                                  <B>{{$type->type}} </B>
                              </option>
                              @endforeach 
                          </select>   
                      </div>

                          <div class="col-md-3">
                              <label class="small mb-1" for="inputEmailAddress">Numéro/Dénomination</label>
                              <input type="text" class="form-control quantites" name="facture{{$preachat->idpreachat}}" id="facture{{$preachat->idpreachat}}" placeholder="FP001/2020, Contrat 001, BL001 ....";>
                          </div>
                    

                    

                  </div>


                  

                  <div class="form-row" style="margin-left: 100px">

                       <div class="col-md-3">
                        <label class="small mb-1" for="inputEmailAddress">Date pièce </label>
                        <input type="date" class="form-control quantites" name="date{{$preachat->idpreachat}}" id="date{{$preachat->idpreachat}}" placeholder="02/05/2018";>
                    </div>

                     
                    <div class="col-md-3">
                        <label class="small mb-1" for="inputEmailAddress">Pièce Jointe </label>
                        <input type="file"  class="form-control-file" name="photo{{$preachat->idpreachat}}" id="photo{{$preachat->idpreachat}}" >
                    </div>

                  
                </div>

              </div>

        </div>

                       
                        </div>
                        

                         
                        <div class="form-row">
                         <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1"><B>Nature Doc_Payement</B></label>
                              <select name="doc{{$preachat->idpreachat}}" class="form-control">
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





@endsection


<script type="text/javascript">
        
        function clin() 
        {
            
            $(".encours")./*parent().parent().*/fadeToggle('slow');

            clin();
            // 
        }

        clin();

        {{----}}
    </script>


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