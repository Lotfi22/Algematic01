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
@endsection