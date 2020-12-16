@extends('../layouts.admin')
@section('content')         

    <div>
        <h1 style="text-align: center;">Détails de la Vente N°{!! $ma_vente[0]->id !!}</h1>
    </div>
    
    <br>

    <div class="row">

    	<div class="col-md-5" style="border: dashed black 2px; border-radius: 5%;" >
    		
    		<h4>Date de la demmande : {!! $dates_dem !!}</h4> 

    		<h4>Date d'échue : {!! substr($dates_fin,0,10) !!}</h4> 

    		{{--  --}}
    	</div>
    
    	<div class="col-md-5" style="margin-left: 15%; border: dashed black 2px; border-radius: 5%;">
    		
    		<h4>Client : {!! $client->code_client !!}</h4> 

    		<h4>Email : {!! $client->email !!}</h4> 

    		{{--  --}}
    	</div>


        <table class="table col-md-12 table-striped display table-dark" id="tables_id" style="margin: 3% 0%;">
          
            <thead>
            
                <tr>
                      
                    <th scope="col"><B>Réference</B></th>
                    <th scope="col"><B>Description</B></th>
                    <th scope="col"><B>Prix U.HT</B></th>
                    <th scope="col"><B>Quantité</B></th>
                    <th scope="col"><B>Montant</B></th>

                    {{--  --}}
                </tr>

                {{--  --}}
            </thead>

            <tbody>
            
                @foreach($ligne_ventes as $ligne)

                    <tr style="cursor: pointer;" id="info_demande{{$ligne->id}}">

                    	<td scope="col"> {!! $ligne->nom !!} </td>
                    	<td scope="col"> {!! $ligne->description !!} </td>        
                    	<td scope="col"> {!! $ligne->prix_u !!} </td>    
                    	<td scope="col"> {!! $ligne->quantite !!} </td>    
                    	<td scope="col"> {!! $ligne->total !!} </td>                            
                                               
                        <!--  -->
                    </tr>

                    <!--  -->
                @endforeach
                    
                <!--  -->    
            </tbody>

            <!--  -->
        </table>

        <div class="col-md-4" style="margin-left: 65%;">

            <p style="font-weight: bold;">
                <b> Montant Total HT : <B style="float: right; margin-right: 2%" >{!! number_format((float)$le_montant->montant_total/1.19) !!}</B></b>
            </p>                            
            
            @if($client->taux_remise_spec != 0)

                <p style="font-weight: bold;"><b> Remise ({!! $client->taux_remise_spec !!}%) : <B style="float: right; margin-right: 2%" >{!! number_format(($le_montant->montant_total/1.19)*$client->taux_remise_spec/100) !!}</B>
                </b></p>

                <p style="font-weight: bold;"><b> Montant aprés Remise : <B style="float: right; margin-right: 2%" >{!! number_format(($le_montant->montant_total/1.19)*(1-($client->taux_remise_spec/100))) !!}</B>
                </b></p>

                <p style="font-weight: bold;">
                    <b> Montant TVA 19% : <B style="float: right; margin-right: 2%" >{!! number_format(($le_montant->montant_total/1.19)*(1-($client->taux_remise_spec/100))*0.19) !!}</B>
                    </b>
                </p>                            

             @else

                <p style="font-weight: bold;">
                    <b> Montant TVA 19% : <B style="float: right; margin-right: 2%" >{!! number_format($le_montant->montant_total/0.81) !!}</B>
                    </b>
                </p>                            

                {{--  --}}
            @endif

            <p style="font-weight: bold;">
                <b> Total TTC : <B style="float: right; margin-right: 2%" >{!! number_format($le_montant->montant_total) !!}</B>
                </b>
            </p>    


            @if($tout['avance'] != 0)

                <p style="font-weight: bold;">
                    
                    <b> Avance : <B style="float: right; margin-right: 2%" >{!! number_format($tout['avance']) !!}</B>
                    </b>
                </p>                                        	

                <p style="font-weight: bold;">
                    
                    <b> Reste : <B style="float: right; margin-right: 2%" >{!! number_format($tout['reste']) !!}</B>
                    </b>
                </p>                                        	

            	{{--  --}}
            @endif

            @if($tout['RDG'] == "OUI")

                <p style="font-weight: bold;">
                    
                    <b> RDG : <B style="float: right; margin-right: 2%" >{!! $tout['Pourcentage'] !!}%</B>
                    </b>
                </p>                                        	

                <p style="font-weight: bold;">
                    
                    <b> RDG M : <B style="float: right; margin-right: 2%" >{!! number_format($tout['la_rdg']) !!}</B>
                    </b>
                </p>                                        	

                <p style="font-weight: bold;">
                    
                    <b> Mois : <B style="float: right; margin-right: 2%" >{!! $tout['mois'] !!}</B> </b>
                </p>                                        	

            	{{--  --}}
            @endif

            {{--  --}}
        </div>

        <!--  -->
    </div>


    {{--  --}}
@endsection