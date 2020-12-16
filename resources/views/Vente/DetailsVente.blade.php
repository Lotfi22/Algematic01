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
    		
    		<h4>Date de la demmande : {!! $dates_dem !!}</h4> 

    		<h4>Date d'échue : {!! substr($dates_fin,0,10) !!}</h4> 

    		{{--  --}}
    	</div>


        <table class="table table-striped display table-dark" id="tables_id" style="margin: 3% 0%;">
          
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

                        {{--  
                        

                        <td>{!! $client->tel !!}  {!! $client->email !!}</td>
                        <td scope="row"><B>{{$client->code_client}}</B></td>
                        <td scope="row"><B>{{$client->code_client}}</B></td>
                        --}}
                        
                                               
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


    {{--  --}}
@endsection