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


    <div class="container">

        @if(session()->has('notif'))
            
            <div class="row">
                
                <div class="alert alert-danger">
                    
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
                    
                    <strong>Notification</strong>{{session()->get('notif') }}
                </div>
            </div>
        @endif
      
        <h1 style=" text-align: center;"><B id="demandedevente">Effectuer une Vente</B></h1>     

        <hr>

        <form class="needs-validation" id="ventes_produits" action="/home/vente/VenteConfirmed/AddVente" method="POST" enctype="multipart/form-data">

            {{ csrf_field()}}

            <div class="form-group">
                
                <h4 for="doc">Choisir les Pré Ventes associées à cette Vente</h4>

                <div class="form-group items" id="dynamic_form2">
                    
                    <div class="row">
                    
                        <div class="button-group" style="padding: 27px;">
                            
                            <a href="javascript:void(0)" class="btn btn-primary" id="plus55"><i class="fa fa-plus"></i>
                            </a>

                            <a href="javascript:void(0)" class="btn btn-danger" id="minus55"><i class="fa fa-minus"></i>
                            </a>
                        </div>

                        <div class="col-md-8">
                            <label class="small mb-1" for="Prevente">Prevente </label>
                    
                            <select onchange="get_preventes(this);" class="form-control Preventes" name="Prevente" id="Prevente" >
                    
                                <option value=""></option>
                        
                                @foreach($ventes as $vente)

                                    <option value="{{$vente->preVente}}" style="font-size: 1.3em;" {{-- class="{{$vente->type}}" --}}>
                                        
                                        Pré Vente N° : {!! $vente->preVente !!} || {!! $vente->date_demande !!} 

                                        {{--  --}}
                                    </option>
                                @endforeach 
                            </select>   
                        </div>

                        <div class="col-md-2" >
                            
                            <input type="text" class="form-control la_prevente" style="display: none;" name="la_prevente" id="la_prevente">

                            {{--  --}}
                        </div>
                    </div>
                </div>

                {{--  --}}
            </div>

            <hr>

                <div class="row form-group">

                    <div class="col-md-6">

                        <label class="small mb-1" for="avance">Avance </label>
                
                        <input type="number" value="0" min="0" class="form-control" onkeyup="fit_reste(this);" onchange="fit_reste(this);" id="avance" name="avance">
                    </div>

                    <div class="col-md-6">

                        <label class="small mb-1" for="reste">Reste </label>
                
                        <input type="number" readonly min="0" class="form-control" id="reste" name="reste">
                    </div>

                </div>
                
                <div class="row form-group">

                    <h4 class="col-md-12"> Ya t-il une Retenue de Garantie ? </h4> 
                    <br><br>
                    
                    <div onclick="affiche_RDG();" class="form-check form-check-inline col-md-5">
                        
                        <input type="radio" class="form-check-input" value="OUI" id="OUI" name="RDG">

                        <label class="form-check-label" for="OUI"> OUI </label>
                    </div>
            
                    <!-- Material inline 2 -->
                    <div onclick="hide_RDG();" class="form-check form-check-inline col-md-5">
                        
                        <input type="radio" class="form-check-input" value="NON" id="NON" name="RDG">

                        <label class="form-check-label" for="NON"> NON </label>
                    </div>
        
                    <br><br>
                    <div class="RDG form-check form-check-inline col-md-5">

                        <label class="small mb-1" for="Pourcentage"> Pourcentage %</label>
                        
                        <input type="number" min="0" max="99" id="Pourcentage" name="Pourcentage" class="form-control" onkeyup="fit_rdg(this);" onchange="fit_rdg(this);">
                    </div>

                    <div class="RDG form-check form-check-inline col-md-2">

                        <label class="small mb-1" for="RDG"> RDG </label>
                        
                        <input type="number" min="0" max="99" name="la_rdg" readonly id="RDG" class="form-control">
                    </div>


                    <div class="RDG form-check form-check-inline col-md-2">

                        <label class="small mb-1" for="mois"> Mois </label>
                        
                        <input type="number" min="0" max="99" value="12" name="mois" id="mois" class="form-control">
                    </div>

                    <div class="RDG form-check form-check-inline col-md-2">

                        <label class="small mb-1" for="jours"> jours </label>
                        
                        <input type="number" value="0" min="0" max="99" name="jours" id="jours" class="form-control">
                    </div>


                    {{--  --}}
                </div>

            <hr>

            <div class="form-group">
                <label for="doc">Attacher des documents ?</label>
                <select class="form-control" name="existe_doc" onchange="show_d_f2(this)" id="oui_ou_non">
                    <option value="NON">NON</option>
                    <option value="OUI">OUI</option>
              </select>
            </div>

            <div id="les_docccs">


                <div class="form-group items" id="dynamic_form3">
                    
                    <div class="row">
                    
                        <div class="button-group" style="padding: 27px;">
                            
                            <a href="javascript:void(0)" class="btn btn-primary" id="plus555"><i class="fa fa-plus"></i>
                            </a>

                            <a href="javascript:void(0)" class="btn btn-danger" id="minus555"><i class="fa fa-minus"></i>
                            </a>
                        </div>

                        <div class="col-md-5">
                            <label class="small mb-1" for="type_doc">document </label>
                    
                            <select class="form-control type_doc" name="type_doc" id="type_doc" >
                    
                                <option value=""></option>
                        
                                @foreach($type_pieces as $type_piece)

                                    <option value="{{$type_piece->id}}" class="{{$type_piece->type}}">
                                        
                                        {{$type_piece->type}} 

                                        {{--  --}}
                                    </option>
                                @endforeach 
                            </select>   


                        </div>

                        <div class="col-md-5">
                            <label class="small mb-1" for="document">Document </label>
                            <input type="file" class="form-control document" name="document" id="document">
                        </div>

                    </div>
                </div>

            </div>



            <div class="modal-footer">
                
                <input type="submit" class="btn btn-outline-primary col-md-6" value="Valider La Demande" name="Valider La Demande">

                 {{--<button type="submit" class="btn btn-outline-primary col-md-6">Valider La Demande</button>--}}
                <a class="btn btn-outline-danger col-md-6" href="" aria-expanded="false">
                    Refaire La Demmande
                </a>
            </div>
        </form>


        {{--  --}}
    </div>    

    <script src="{{ asset('../js/confirmedvente1.js') }}" ></script>



    {{--  --}}
@endsection