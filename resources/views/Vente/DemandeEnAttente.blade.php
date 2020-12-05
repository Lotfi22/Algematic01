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
    
        <table class="table table-striped display table-dark" id="table_id">
          
            <thead>
            
                <tr>
                      
                    <th>Numéro</th>
                    <th scope="col"><B>Date Demande</B></th>
                    <th scope="col" style="display: none;"><B>Infos Client</B></th>
                    <th scope="col" style="display: none;"><B>Infos Demande</B></th>
                    <th scope="col"><B>Date D'échue</B></th>
                    <th scope="col"><B>Employé Demande</B></th>
                    <th scope="col"><B>Client</B></th>
                    <th scope="col"><B>Statut</B></th>
                    {{--  --}}
                </tr>

                {{--  --}}
            </thead>

            <tbody>
            
                @foreach($ventes as $vente)

                    <tr style="cursor: pointer;" id="info_demande{{$vente->preVente}}" data-toggle="modal" data-target="#InfosDemande{{$vente->preVente}}" {{-- id="row{{$vente->preVente}}" --}} {{-- onclick="simulate_click(this);" --}}>

                        <td scope="row"><B>{{$vente->preVente}}</B></td>
                        
                        <td scope="row"><B>{{$vente->date_demande}}</B></td>
                        
                        <td style="display: none;">

                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#infosClient{{$vente->preVente}}">
                                Infos  
                            </button>
                        </td>
                        
                        <td style="display: none;">
                            
                            <button class="btn btn-outline-secondary" type="button" id="info_demande{{$vente->preVente}}" data-toggle="modal" data-target="#InfosDemande{{$vente->preVente}}">
                               Infos
                            </button>

                        </td>

                        <td>{!! substr($vente->date_echue,0,10) !!}</td>
                        <td>{!! $vente->name !!}  {!! $vente->prenom !!}</td>
                        <td scope="row"><B>{{$vente->code_client}}</B></td>

                        
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














































    <?php 
        $i = 0;
    ?>

    @foreach($ventes as $vente)


        <div style="width: 100%; height: 100%; overflow: scroll;" class="modal fade" role="dialog" id="InfosDemande{{$vente->preVente}}" tabindex="-1" aria-labelledby="InfosDemande{{$vente->preVente}}" aria-hidden="false">
    
            <div class="modal-dialog modal-lg col-md-12">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div style="padding-top: 2%;">
                        
                        <h4 class="text-center" id="InfosDemande{{$vente->preVente}}">Informations sur la Vente Demandée </h5>
                    </div>
                    <div class="modal-body">
                        <hr>

                        <h3>Récap : </h3>
                        <p id="recap_achat{{ $i }}"></p>
                        <p id="recap_vente{{ $i }}"></p>
                        <p id="recap_benifice{{ $i }}"></p>
                        <hr>
                        
                        <h3>Fichiers joints</h3>
                        <?php $kk=0; ?>                        
                        @foreach($pieces as $piece)

                            @if($vente->preVente == $piece->id_prevente)
                                <h4> Le {!! $piece->type !!} inclut dans la demande de vente  : <a href="{!! asset($piece->chemin_piece) !!}" download><B>{!! $piece->type !!}</B> </a> </h4>
                                <br><br>

                                <?php $kk++; ?>

                                {{--  --}}
                            @endif

                            {{--  --}}
                        @endforeach
                        
                        @if($kk == 0)                    
                            <h5>Pas de fichiers joints</h5>
                        @endif

                        <hr>

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
                            
                            <?php
                                $cout = 0; 
                            ?> 

                            @foreach($ligne_ventes as $ligne)
                                
                                @if( $ligne->id_pre_vente == $vente->preVente)
                                    
                                    <tr>
                                        <td scope="row"> {!! $ligne->nom !!} </td>
                                        <td scope="row"> {!! $ligne->description !!} </td>
                                        <td scope="row"> {!! number_format((float)$ligne->PrixArticleAchat) !!} </td>

                                        <?php $cout = $cout+((float)$ligne->PrixArticleAchat)*$ligne->quantite; ?>

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

                    <p style="display: none;" id="cout_achat{{ $i }}" name="{{  number_format((float)$cout)}}"> Le cout d'acht : {!! number_format((float)$cout) !!} </p>

                    <p style="display: none;" id="montant_vente{{ $i }}" name="{{  number_format((float)$vente->montant*1.19) }}"> Le Montant de vente : {!! number_format((float)$vente->montant*1.19) !!}</p>

                    <p style="display: none;" id="montant_benifice{{ $i }}" name="{{ number_format((float)$vente->montant-$cout) }}"> Le Bénifice : {!! number_format((float)$vente->montant-$cout) !!}</p>

                    <?php $couts[$i] = $cout; $i++; ?>

                    <div style="margin-left: 60%; float: right;">

                        <p style="font-weight: bold;">
                            <b> Montant Total HT : <B style="float: right; margin-right: 2%" >{!! number_format((float)$vente->montant) !!}</B></b>
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

                    @if( ($privilege ?? '' == 1) && ($vente->statut_validation == 0 ) )
    
                        <div class="form-row">

                            <div class="row col-md-12" style="margin-bottom: 2%;">
                                
                                <label class="col-md-4" for="commentaire{{ $vente->preVente }}">Commentaire sur la Vente </label>
                                
                                <input type="text" onkeydown="remplir_comment(this);" id="commentaire{{ $vente->preVente }}" name="commentaire" class="form-control col-md-6">

                            </div>      

                            {{--  --}}
                        </div>


                        <div class="row" style="margin-bottom: 2%;">
                            
                            <form class="needs-validation col-md-6" novalidate action="/ValiderDemandeVente/{{$vente->preVente}}" method="POST">
                                
                                {{ csrf_field()}}
                                
                                <input style="visibility: hidden;" type="text" id="commentaire_accept{{ $vente->preVente }}" name="commentaire_accept">

                                <button type="submit" class="col-md-12 btn btn-outline-success">Approuver</button>
                                    
                            </form>


                            <form class="needs-validation col-md-6" novalidate action="/RefuserDemandeVente/{{$vente->preVente}}" method="POST">
                                
                                {{ csrf_field()}}

                                <input style="visibility: hidden;" type="text" id="commentaire_refus{{ $vente->preVente }}" name="commentaire_refus">

                                <button type="submit" class="col-md-12 btn btn-outline-danger col-md-6">Refuser</button>
                            </form>
                        </div>



                     @elseif($vente->statut_validation == 1)                     
                                                                
                        <p style="text-align: center;" class="alert alert-danger">Refusée</p>

                        @if($vente->commentaire == "")
                            <h5 style="text-align: center;"><B> Pas de commentaire pour cette Vente </B> </h5>
                         @else   
                            <h5 style="text-align: center;"> Commentaire : <B> {{$vente->commentaire}} </B> </h5>
                        @endif

                     
                     @elseif($vente->statut_validation == 2)

                        <p style="text-align: center;" class="alert alert-success">Approuvée</p>

                        @if($vente->commentaire == "")
                            <h5 style="text-align: center;"><B> Pas de motif pour cette Vente </B> </h5>
                         @else   
                            <h5 style="text-align: center;"> Commentaire : <B> {{$vente->commentaire}} </B> </h5>
                        @endif


                        <form class="needs-validation" novalidate action="/VenteFactureProformat/{{$vente->preVente}}" method="POST">
                            
                            {{ csrf_field()}}
                            
                            <button style="margin: 5%;" type="submit" class="btn btn-outline-success col-md-11">Tétécharger Facture Proformat</button>
                        </form>



                        <!-- -->    
                    @endif
                        
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

    {{-- {{ dd($couts) }} --}}
    
    <script type="text/javascript">
        
        var nb_vente = {!! count($ventes) !!}        

        nb_vente = parseInt(nb_vente);

        {{----}}
    </script>

    <script src="{{ asset('../js/prevente.js') }}"></script>



    {{--  --}}
@endsection
