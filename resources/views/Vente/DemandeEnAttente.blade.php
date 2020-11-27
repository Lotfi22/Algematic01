@extends('../layouts.admin')
@section('content')         
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p style="text-align: center;">{{ \Session::get('success') }}</p>
        </div>
    @endif

    @if (count($errors)>0)
        <ul>
          @foreach($errors->all() as $error)
          <li class="alert alert-danger">{{$error}}</li>
          @endforeach
        </ul>
    @endif


    <div>
        <h1 style="text-align: center;">Liste Des Demandes de Vente</h1>
    </div>
    
    <br>

    <div>
        
        <table id="table_id" class="table-responsive table-striped table-dark display">
          
            <thead>
            
                <tr>
                      
                    <th scope="col"><B>Client</B></th>
                    <th scope="col"><B>Date</B></th>
                    <th scope="col"><B>Infos Client</B></th>
                    <th scope="col"><B>Infos Demande</B></th>
                    <th scope="col"><B>Statut</B></th>
                  
                    @if($privilege ?? '' == 1)
                        <th scope="col" style="text-align: center;"><B>Action</B></th>
                    @endif

                    {{--  --}}
                </tr>

                {{--  --}}
            </thead>

            <tbody>
            
                @foreach($ventes as $vente)

                    <tr>

                        <td scope="row"><B>{{$vente->code_client}}</B></td>
                        
                        <td scope="row"><B>{{$vente->date_demande}}</B></td>
                        
                        <td>

                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#infosClient{{$vente->preVente}}">
                                Infos  
                            </button>
                        </td>
                        
                        <td>
                            
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#InfosDemande{{$vente->preVente}}">
                               Infos
                            </button>

                        </td>

                        
                        <td>
                            @if($vente->statut_validation == 0)
                            	
                            	<p style="text-align: center;" class="encours alert alert-primary">En Cours . . . . .</p>
                            
                             @elseif($vente->statut_validation == 1)
                            		                                    
                                <p style="text-align: center;" class="alert alert-danger">Refusée</p>
                             
                             @else

                                <p style="text-align: center;" class="alert alert-success" data-toggle="modal" data-target="#Commentaire{{$vente->preVente}}">Approuvée</p>

                                <!-- -->    
                            @endif
                            
                            <!-- -->
                        </td>
                        
                        @if($privilege ?? '' == 1)

                            <td>
                                
                                @if( ($privilege ?? '' == 1) && ($vente->statut_validation == 0 ) )
                                
                                                                                                                             
                                    <button type="button" class="{{-- btn-sm --}} col-md-3 btn btn-outline-success" data-toggle="modal" data-target="#valider{{$vente->preVente}}">
                                        Valider
                                    </button>

                                    <button type="button" class="{{-- btn-sm --}} col-md-3 btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERvente{{$vente->preVente}}">
                                       Refuser
                                    </button>
                                                                    

                                 @elseif(  ($vente->statut_validation == 2 ) )
                                    <button type="button" class="{{-- btn-sm --}} col-md-7 btn btn-outline-info" data-toggle="modal" data-target="#FP{{$vente->preVente}}">
                                      Editer FP
                                    </button>

                                    <!--  -->
                                 @else   

                                    <button type="button" class="{{-- btn-sm --}} col-md-7 btn btn-outline-warning" data-toggle="modal" data-target="#Commentaire{{$vente->preVente}}">
                                       
                                       Voir détails
                                    </button>

                                    <!--  -->
                                @endif


                                <!--  -->
                            </td>
                                
                            <!--  -->                            
                        @endif
                        
                        <!--  -->
                    </tr>

                    <!--  -->
                @endforeach
                    
                <!--  -->    
            </tbody>

            <!--  -->
        </table>

        <!--  -->
    </div>















































    {{-- Les modals --}}

    @foreach($ventes as $vente)

        <div class="modal fade" role="dialog"  id="FP{{$vente->preVente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
            <div class="modal-dialog modal-lg">
                
                <div class="modal-content">

                    <div style="padding-top: 3%;">
                        
                        <h4 class="text-center">Voulez vous télécharger Facture Proformat ?</h4>
                    </div>

                    <form class="needs-validation" novalidate action="/VenteFactureProformat/{{$vente->preVente}}" method="POST">
                        
                        {{ csrf_field()}}
                        
                        <div class="modal-body">
                                                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger col-md-6" data-dismiss="modal">Plus tard
                                </button>
                                <button type="submit" class="btn btn-outline-success col-md-6">Oui, Tétécharger maintenant</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @foreach($ventes as $vente)

        <div class="modal fade" role="dialog" id="valider{{$vente->preVente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
            <div class="modal-dialog modal-lg">
                
                <div class="modal-content">

                    <div style="padding-top: 3%;">
                        
                        <h4 class="text-center">Voulez vous vraiment Valider la vente ?</h4>
                        
                    </div>

                    <form class="needs-validation" novalidate action="/ValiderDemandeVente/{{$vente->preVente}}" method="POST">
                        
                        {{ csrf_field()}}
                        
                        <div class="modal-body">
                                                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-warning col-md-6" data-dismiss="modal">Plus tard</button>
                                <button type="submit" class="btn btn-outline-success col-md-6">Oui, je Valide</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach

    @foreach($ventes as $vente)

        <div class="modal fade" role="dialog" id="Commentaire{{$vente->preVente}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <div style="padding-top: 3%;">

                        <h4 style="text-align: center; " class="modal-title" id="staticBackdropLabel">Motif du Refus</h4>
                        <hr>
                    </div>

                    <div class="modal-body">
                        
                        <div class="form-row">
                        
                            <div class="col-md-12 mb-6">
                                
                                <div class="form-group">    

                                    @if($vente->commentaire == "")
                                        <h5 style="text-align: center;"><B> Pas de motif pour ce refus </B> </h5>
                                     @else   
                                        <h5 style="text-align: center;"> Motif refus : <B> {{$vente->commentaire}} </B> </h5>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    @foreach($ventes as $vente)


        <div class="modal fade" role="dialog" id="infosClient{{$vente->preVente}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            
            <div class="modal-dialog modal-lg">
                
                <div class="modal-content">
                    
                    <div style="padding-top: 3%;">
                        
                        <h4 class="text-center">Informations du Client</h4>
                        
                        <hr>
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
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($ventes as $vente)

        <div class="modal fade" role="dialog" id="InfosDemande{{$vente->preVente}}" tabindex="-1" aria-labelledby="InfosDemande{{$vente->preVente}}" aria-hidden="true">

            <div class="modal-dialog modal-lg col-md-12">

                <div class="modal-content">

                    <div style="padding-top: 2%;">
                        
                        <h4 class="text-center" id="InfosDemande{{$vente->preVente}}">Informations sur la Vente Demandée </h5>
                    </div>
                    <div class="modal-body">
                        <hr>
                        <ul>
                            <li><B>Client :  </B>  {{$vente->code_client}}</li>
                            <li><B>Mobile :  </B>  {{$vente->mobile}}</li>
                            <li><B>Email :  </B>  {{$vente->email}}</li>
                        </ul>

                        @if($vente->taux_remise_spec!=0)

                            <p style="text-align: center;" class="alert alert-success"> Le client a une remise spésifique de  : <b> {!! $vente->taux_remise_spec !!} % </b> </p>

                            {{--  --}}
                        @endif
                    </div>
                    
                    
                    <table class="table table-striped table-dark display">

                        <thead>
        
                            <tr>    
                                <th scope="col"><B>Référance</B></th>
                                <th scope="col"><B>Description</B></th>
                                <th scope="col"><B>Prix d'achat</B></th>
                                <th scope="col"><B>Prix U.HT</B></th>
                                <th scope="col"><B>Quantité</B></th>
                                <th scope="col"><B>Montant HT</B></th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            @foreach($ligne_ventes as $ligne)
                                
                                @if( $ligne->id_pre_vente == $vente->preVente)
                                    
                                    <tr>
                                        <td scope="row"> {!! $ligne->nom !!} </td>
                                        <td scope="row"> {!! $ligne->description !!} </td>
                                        <td scope="row"> {!! number_format((float)$ligne->PrixArticleAchat) !!} </td>
                                        <td scope="row"> {!! number_format((float)$ligne->prix_u) !!} </td>
                                        <td scope="row"> {!! $ligne->quantite !!} </td>
                                        <td scope="row"> {!! number_format((float)$ligne->total) !!} </td>
                                    </tr>
                                @endif

                                {{----}}
                            @endforeach

                            {{----}}
                        </tbody>
                    </table>

                    <div style="margin-left: 60%;">

                        <p style="font-weight: bold;">
                            <b> Montant Total HT : <B style="float: right; margin-right: 2%" >{!! number_format($vente->montant) !!}</B></b>
                        </p>                            
                        
                        @if($vente->taux_remise_spec != 0)

                            <p style="font-weight: bold;"><b> Remise ({!! $vente->taux_remise_spec !!}%) : <B style="float: right; margin-right: 2%" >{!! number_format($vente->montant*$vente->taux_remise_spec/100) !!}</B>
                            </b></p>

                            <p style="font-weight: bold;"><b> Montant aprés Remise : <B style="float: right; margin-right: 2%" >{!! number_format($vente->montant*(1-($vente->taux_remise_spec/100))) !!}</B>
                            </b></p>

                            <p style="font-weight: bold;">
                                <b> Montant TVA 19% : <B style="float: right; margin-right: 2%" >{!! number_format($vente->montant*(1-($vente->taux_remise_spec/100))*0.19) !!}</B>
                                </b>
                            </p>                            

                         @else

                            <p style="font-weight: bold;">
                                <b> Montant TVA 19% : <B style="float: right; margin-right: 2%" >{!! number_format($vente->montant*0.19) !!}</B>
                                </b>
                            </p>                            

                            {{--  --}}
                        @endif

                        
                        <p style="font-weight: bold;">
                            <b> Total TTC : <B style="float: right; margin-right: 2%" >{!! number_format($vente->montant*1.19) !!}</B>
                            </b>
                        </p>    

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
                    </div>

                    {{--  --}}
                </div>

                {{--  --}}
            </div>

            {{--  --}}
        </div>

        {{--  --}}
    @endforeach

    
    @foreach($ventes as $vente)
        
        <div class="modal fade" role="dialog" id="exampleModalSUPPRIMERvente{{$vente->preVente}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
            <div class="modal-dialog modal-lg">
                
                <div class="modal-content">
                    
                    <div style="padding-top: 3%;">
                        
                        <h4 style="text-align: center;">Voulez vous vraiment Refuser ? </h4>

                        <hr>

                        <!--  -->
                    </div>

                    <form class="needs-validation" novalidate action="/RefuserDemandeVente/{{$vente->preVente}}" method="POST">
                        
                        {{ csrf_field()}}

                        <div class="modal-body">

                            <div class="form-row">

                                <div class="row col-md-12">
                                    
                                    <label class="col-md-4" for="{{ $vente->id }}">Commentaire sur le Refus </label>
                                    
                                    <input type="text" id="{{ $vente->id }}" name="commentaire" class="form-control col-md-6">
                                    {{--  --}}
                                </div>      

                                {{--  --}}
                            </div>
              
                            <div class="modal-footer">
                            
                                <button type="button" class="btn btn-outline-warning col-md-6" data-dismiss="modal">Plus tard</button>
                                <button type="submit" class="btn btn-outline-danger col-md-6">Refuser</button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    @endforeach


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


    {{--  --}}
@endsection
