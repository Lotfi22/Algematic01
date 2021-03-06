@extends('../layouts.admin')

@section('content')         

    
    <div class="row" id="hnaya">

        <div class="col-lg-12 col-md-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Table des clients</h4>

                    <h6 class="card-subtitle">clients disponibles</code></h6>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Ajouter un client </button>


{{-- hada houwwa l model --}}


<div id="myModal" class="modal fade col-md-12" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

           <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Nouveau client</h4>
          </div>

            <div class="modal-body">

                <form class="form-inline" method="post" enctype="multipart/form-data" action="/home/clients/ajouter/ajax">

                    {{ csrf_field() }}  


                    <div class="form-group col-md-12">

                        <label for="la_photo">Choisir la photo </label>

                        <input type="file" required name="la_photo1" value="{{ old('la_photo1') }}" id="la_photo1" class="form-control" >

                        @if ($errors->has('la_photo1'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('la_photo1') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>


                    <div class="form-group col-md-6 col-sm-12">

                        <label for="code">Code Client</label>
                        <br>
                        <textarea type="text" autofocus id="codeduclient" rows="1" cols="50" required name="code" class="form-control" id="code"> {{ old('code') }}</textarea>

                        @if ($errors->has('code'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>

                    <div class="form-group col-md-6 col-sm-12">

                        <label for="tel">Téléphone </label>

                        <textarea type="tel" required id="tel" rows="1" cols="50" required name="tel" class="form-control" id="tel"> {{ old('tel') }}</textarea>

                        @if ($errors->has('tel'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('tel') }}</strong>
                            </span>
                        @endif


                    </div>

                    <div class="form-group col-md-6 col-sm-12">

                        <label for="fax">Fax </label>

                        <textarea type="fax" id="fax" name="fax" rows="1" cols="50" class="form-control" id="fax"> {{ old('fax') }}</textarea>

                        @if ($errors->has('fax'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('fax') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>


                    <div class="form-group col-md-6 col-sm-12">

                        <label for="mobile">Mobile </label>

                        <textarea type="mobile" id="mobile" name="mobile" rows="1" cols="50" class="form-control" id="mobile"> {{ old('mobile') }}</textarea>

                        @if ($errors->has('mobile'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>
                    
                    
                    <div class="form-group col-md-6 col-sm-12">

                        <label for="email">email </label>

                        <textarea type="email" id="email" name="email" rows="1" cols="50" class="form-control" id="email"> {{ old('email') }}</textarea>

                        @if ($errors->has('email'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>
                    
                    <div class="form-group col-md-6 col-sm-12">

                        <label for="nis">NIS</label>

                        <textarea type="nis" id="nis" name="nis" rows="1" cols="50" class="form-control" id="nis"> {{ old('nis') }}</textarea>

                        @if ($errors->has('nis'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('nis') }}</strong>
                            </span>
                        @endif

                        {{--  --}}
                    </div>

                    <br>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="nif">NIF </label>
                        
                        <textarea  type="text" required rows="1" cols="50" class="form-control" name="nif" id="nif"> {{ old('nif') }}</textarea>

                        @if ($errors->has('nif'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('nif') }}</strong>
                            </span>
                        @endif

                    </div>

                    <br>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="rc">N° Registre de commerce </label>
                        
                        <textarea type="text" required rows="1" cols="50" class="form-control" name="rc" id="rc"> {{ old('rc') }}</textarea>

                        @if ($errors->has('rc'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('rc') }}</strong>
                            </span>
                        @endif


                    </div>
                    
                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="n_art_imp">N° Article d'Imposition</label>
                        
                        <textarea type="text" required rows="1" cols="50" class="form-control" name="n_art_imp" id="n_art_imp"> {{ old('n_art_imp') }}</textarea>

                        @if ($errors->has('n_art_imp'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('n_art_imp') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="taux_remise_spec">Taux d'réduction : </label>
                        
                        <textarea type="number" value="0" required rows="1" cols="50" class="form-control" name="taux_remise_spec" id="taux_remise_spec"> {{ old('taux_remise_spec') }}</textarea>

                        @if ($errors->has('taux_remise_spec'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('taux_remise_spec') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="plafond_credit">Plafond Crédit </label>
                        
                        <textarea type="number" value="0" rows="1" cols="50" class="form-control" name="plafond_credit" id="plafond_credit"> {{ old('plafond_credit') }}</textarea>

                        @if ($errors->has('plafond_credit'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('plafond_credit') }}</strong>
                            </span>
                        @endif

                    </div>


                    <div class="form-group col-md-6 col-sm-12" style="margin: 2% 0%; ">

                        <div class="custom-control custom-radio" style="margin-right: 20%;">
                            <input type="radio" class="custom-control-input" id="client" value="0"  name="type">
                            <label class="custom-control-label" for="client">Client</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="prospect" value="1" checked name="type">
                            <label class="custom-control-label" for="prospect">Prospect</label>
                        </div>

                        {{--  --}}
                    </div>

                    <div class="form-group col-md-6 col-sm-12" style="margin: 2% 0%; ">
                        
                        <label for="client_inter_fact">Client Inter de Facturation</label>
    
                        <select class="form-control" name="client_inter_fact" id="client_inter_fact" >
                            
                            <option value="NON"> NON </option>
                            <option value="OUI"> OUI </option>
                        </select>
                    </div>

                    <div class="form-group col-md-12" style="margin: 2% 0%; ">
                        
                        <label for="motif_interd" id="motif_interd_label" style="margin-right: 3%;">Motif interdiction de Facturation</label>
    
                        <select class="form-control" name="motif_interd" id="motif_interd" >
                            
                            <option value="Motif N°1"> Motif N°1 </option>
                            <option value="Motif N°2 ........."> Motif N°2 ......... </option>
                        </select>
                    </div>


                    <h5 style="visibility: hidden;"> Categorie : </h5>
                    <h5 style="visibility: hidden;"> Categorie : </h5>
                    <h5 style="visibility: hidden;"> Categorie : </h5>

                    <h5 style="visibility: visible;"> Categorie : </h5>
                        
                    <select class="col-md-12 form-control"  data-live-search="true"  name="categorie" id="le_select0">

                        <option value="------">----------------</option>

                        @foreach ($categories as $categorie)
                            

                            <option value="{{$categorie->id}}">{!! $categorie->nom !!}</option>

                            {{--  --}}                                              
                        @endforeach                                             

                        {{--  --}}
                    </select>

                    <h5 style="visibility: hidden;"> Categorie : </h5>
                    <h5 style="visibility: hidden;"> Categorie : </h5>
                    <h5 style="visibility: hidden;"> Categorie : </h5>
                    <h5 style="visibility: visible;"> Activité : </h5>
                        
                    <select class="col-md-12 form-control"  data-live-search="true"  name="activite" id="le_select0">

                        <option value="------">----------------</option>

                        @foreach ($activites as $activite)
                            

                            <option value="{{$activite->id}}">{!! $activite->nom !!}</option>

                            {{--  --}}                                              
                        @endforeach                                             

                        {{--  --}}
                    </select>


                    <button style="margin-top: 5%;" id="ajout{{ $last_id }}" {{-- data-dismiss="modal" onclick="ajouterclient(event,this)" --}} type="submit" onclick="verif(event);" class="btn btn-success col-md-6">Ajouter</button>
                </form>

                {{--  --}}
          </div>

          

          <div class="modal-footer">

                <button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button>

          </div>

        </div>



        {{--  --}}

  </div>

</div>                    



                    <hr>

                    <div class="table-responsive">

                        <table class="table display" id="table_id">

                            <thead>

                                <tr>

                                    <th>code_client</th>

                                    <th>tel</th>

                                    <th>mobile</th>

                                    <th>NIS</th>
                                    
                                    <th>NIF</th>

                                    <th>N° RC</th>
                                    
                                    <th>Catégorie</th>
                                    

                                    <th>Activité</th>
                                    

                                    <th>Plus</th>

                                </tr>

                            </thead>



                            <tbody id="all_the_clients">

                                @for($i=0 ; $i < count($clients) ; $i++)

                                    <tr id="client{{$clients[$i]->id}}">
                                        <form class="iciic">

                                            {{ csrf_field() }}  

                                            <td> 
                                                <a href="/home/clients/{{$clients[$i]->id}}">
                                                    <p id="codeclient{{$clients[$i]->id}}" value="{!! $clients[$i]->code_client !!}">{!! $clients[$i]->code_client !!}</p>
                                                </a>
                                                {{--  --}}
                                            </td>

                                            <td> 

                                                <p id="tel{{$clients[$i]->id}}" value="{!! ($clients[$i]->tel) !!}">{!! nl2br($clients[$i]->tel) !!}</p> 

                                                {{--  --}}
                                            </td>

                                            <td> 

                                                <p id="mobile{{$clients[$i]->id}}" value="{!! ($clients[$i]->mobile) !!}">{!! ($clients[$i]->mobile) !!}</p>                                                 
                                            </td>

                                            <td> 

                                                <p  value="{{ $clients[$i]->NIS }}"  
                                                id="NIS{{$clients[$i]->id}}">{{ $clients[$i]->NIS }}</p>
                                                
                                                {{--  --}}
                                            </td>


                                            <td> 

                                                <p id="NIF{{$clients[$i]->id}}" value="{!! ($clients[$i]->NIF) !!}">{{$clients[$i]->NIF}}</p> 

                                                {{--  --}}
                                            </td>


                                            <td> 

                                                <p readonly id="RC{{$clients[$i]->id}}" value="{!! ($clients[$i]->RC) !!}">{{$clients[$i]->RC}}</p> 

                                                {{--  --}}
                                            </td>

                                            <td colspan="1">
                                                                                                        
                                                <p value="rec{{$clients[$i]->id}}cat" id="cat{{$i}}
                                                    {{$clients[$i]->id}}">{!! $clients[$i]->categorie_nom !!}
                                                </p>                                           

                                                {{--  --}}
                                            </td>


                                            <td colspan="1">
                                                                                                        
                                                <p value="act{{$clients[$i]->id}}cat" id="act{{$i}}
                                                    {{$clients[$i]->id}}">{!! $clients[$i]->activite_nom !!}
                                                </p>                                           

                                                {{--  --}}
                                            </td>


                                            <td> 

                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-{{$clients[$i]->id}}" style="color: #fff;"> supprimer</a>

                                                <div id="myModalsup-{{$clients[$i]->id}}" class="modal fade" role="dialog">

                                                  <div class="modal-dialog modal-lg">

                                                        <!-- Modal content-->

                                                        <div class="modal-content">

                                                           <div class="modal-header">

                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                                <h4 class="modal-title">Voulez-vous vraiment supprimer ce client</h4>
                                                          </div>

                                                          <div class="modal-body">

                                                                <button class="col-md-5 btn btn-danger" onclick="supprimerclient(event,this)" data-dismiss="modal" id="mod{{$clients[$i]->id}}">OUI,je supprime</button>

                                                                <a style="color: #ffffff;" data-dismiss="modal" class="col-md-6 btn btn-success" style="color: #ffffff;">NON,je ne veux pas supprimer</a>
                                                                {{--  --}}
                                                          </div>

                                                          <div class="modal-footer">

                                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button>
                                                          </div>
                                                        </div>
                                                        {{--  --}}
                                                  </div>
                                                </div>                    
                                                {{-- expr --}}
                                            </td>
                                        </form>
                                        {{--  --}}
                                    </tr>
                                    {{-- expr --}}
                                @endfor
                                {{--  --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
    </div>

    <script src="{{ asset('js/modifierlesclients.js') }}"></script>
    <script src="{{ asset('../js/lmodifierlesclientss.js') }}"></script>

    <script>
        
        $("#motif_interd").hide(0);
        $("#motif_interd_label").hide(0);

        
        $("#client_inter_fact").change(function(event) {

            event.preventDefault();
            
            if ($("#client_inter_fact").val() == "OUI") 
            {
                
                $("#motif_interd_label").show('slow');    
                
                $("#motif_interd").show('slow');

                //
            }
            else
            {

                $("#motif_interd_label").hide('slow');    
                
                $("#motif_interd").hide('slow');
                //
            }

            //
        });
            
        function verif(e)
        {
            /*e.preventDefault();*/



            //
        }
        
        

        //
    </script>




 {{--  --}}   
@endsection