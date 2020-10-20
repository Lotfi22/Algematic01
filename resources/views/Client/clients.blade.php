@extends('../layouts.admin')


@section('content')         

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
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
                        <textarea type="text" autofocus id="codeduclient" rows="1" cols="50" required name="code" class="form-control" id="code"> {{ old('code') }} </textarea>

                        @if ($errors->has('code'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>

                    <div class="form-group col-md-6 col-sm-12">

                        <label for="tel">Téléphone </label>

                        <textarea type="tel" required id="tel" rows="1" cols="50" required name="tel" class="form-control" id="tel"> {{ old('tel') }} </textarea>

                        @if ($errors->has('tel'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('tel') }}</strong>
                            </span>
                        @endif


                    </div>

                    <div class="form-group col-md-6 col-sm-12">

                        <label for="fax">Fax </label>

                        <textarea type="fax" id="fax" name="fax" rows="1" cols="50" class="form-control" id="fax"> {{ old('fax') }} </textarea>

                        @if ($errors->has('fax'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('fax') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>


                    <div class="form-group col-md-6 col-sm-12">

                        <label for="mobile">Mobile </label>

                        <textarea type="mobile" id="mobile" name="mobile" rows="1" cols="50" class="form-control" id="mobile"> {{ old('mobile') }} </textarea>

                        @if ($errors->has('mobile'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>
                    
                    
                    <div class="form-group col-md-6 col-sm-12">

                        <label for="email">email </label>

                        <textarea type="email" id="email" name="email" rows="1" cols="50" class="form-control" id="email"> {{ old('email') }} </textarea>

                        @if ($errors->has('email'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif


                        {{--  --}}
                    </div>
                    
                    <div class="form-group col-md-6 col-sm-12">

                        <label for="nis">NIS</label>

                        <textarea type="nis" id="nis" name="nis" rows="1" cols="50" class="form-control" id="nis"> {{ old('nis') }} </textarea>

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
                        
                        <textarea  type="text" required rows="1" cols="50" class="form-control" name="nif" id="nif"> {{ old('nif') }} </textarea>

                        @if ($errors->has('nif'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('nif') }}</strong>
                            </span>
                        @endif

                    </div>

                    <br>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="rc">N° Registre de commerce </label>
                        
                        <textarea type="text" required rows="1" cols="50" class="form-control" name="rc" id="rc"> {{ old('rc') }} </textarea>

                        @if ($errors->has('rc'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('rc') }}</strong>
                            </span>
                        @endif


                    </div>
                    
                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="n_art_imp">N° Article d'Imposition</label>
                        
                        <textarea type="text" required rows="1" cols="50" class="form-control" name="n_art_imp" id="n_art_imp"> {{ old('n_art_imp') }} </textarea>

                        @if ($errors->has('n_art_imp'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('n_art_imp') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="taux_remise_spec">Taux d'réduction : </label>
                        
                        <textarea type="number" value="0" required rows="1" cols="50" class="form-control" name="taux_remise_spec" id="taux_remise_spec"> {{ old('taux_remise_spec') }} </textarea>

                        @if ($errors->has('taux_remise_spec'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('taux_remise_spec') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6 col-sm-12">
                        
                        <label for="plafond_credit">Plafond Crédit </label>
                        
                        <textarea type="number" value="0" rows="1" cols="50" class="form-control" name="plafond_credit" id="plafond_credit"> {{ old('plafond_credit') }} </textarea>

                        @if ($errors->has('plafond_credit'))
                            <span style="color: red;" class="help-block">
                                <strong>{{ $errors->first('plafond_credit') }}</strong>
                            </span>
                        @endif

                    </div>


                    <div class="form-group col-md-6 col-sm-12" style="margin: 2% 0%; ">

                        <div class="custom-control custom-radio" style="margin-right: 20%;">
                            <input type="radio" class="custom-control-input" id="client" value="client"  name="type">
                            <label class="custom-control-label" for="client">Client</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="prospect" value="prospect" checked name="type">
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

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Photo</th>

                                    <th>Titre</th>

                                    <th style="visibility: hidden;">gggggg</th>

                                    <th style="visibility: hidden;">gggggg</th>

                                    <th>Description</th>

                                    <th style="visibility: hidden;">ggggggg</th>

                                    <th>Portions</th>

                                    <th>Préparation</th>

                                    <th>Cuisson</th>

                                    <th style="visibility: hidden;">ggggggg</th>

                                    <th>Repos</th>

                                    <th style="visibility: hidden;">ggggggg</th>
                                    
                                    <th>Conservation</th>
                                    
                                    <th style="visibility: hidden;">ggggggg</th>

                                    <th>Ingrédients</th>
                                    
                                    <th style="visibility: hidden;">ggggggg</th>
                                    
                                    <th>Etapes</th>
                                    
                                    <th style="visibility: hidden;">ggggggg</th>

                                    <th>Catégories</th>

                                    <th style="visibility: hidden;">ggggggg</th>

                                    <th>Particularités</th>

                                    <th style="visibility: hidden;">ggggggg</th>

                                </tr>

                            </thead>



                            <tbody id="all_the_clients">

                                @for($i=0 ; $i < count($clients) ; $i++)

                                    <tr id="client{{$clients[$i]->id}}">

                                        <form class="iciic">

                                            {{ csrf_field() }}  

                                            <td>

                                                <img src="{{asset('../'.$clients[$i]->photo)}}" width="100%" height="10%">                                                
                                            </td>

                                            <td colspan="3"> 

                                                <p id="nomclient{{$clients[$i]->id}}" value="{!! $clients[$i]->nom !!}">{!! $clients[$i]->nom !!}</p>
                                                
                                                {{--  --}}
                                            </td>

                                            <td colspan="2"> 

                                                <p id="description{{$clients[$i]->id}}" value="{!! ($clients[$i]->description) !!}">{!! nl2br($clients[$i]->description) !!}</p> 

                                                {{--  --}}
                                            </td>

                                            <td colspan="1"> 

                                                <p id="portions{{$clients[$i]->id}}" value="{!! ($clients[$i]->portions) !!}">{{$clients[$i]->portions}}</p> 

                                                {{--  --}}
                                            </td>


                                            <td colspan="1"> 

                                                <p  style="height: 20em;" id="preparation{{$clients[$i]->id}}" value="{!! ($clients[$i]->preparation) !!}">{!! ($clients[$i]->preparation) !!} Minutes</p> 

                                                {{--  --}}
                                            </td>

                                            <td colspan="2"> 

                                                <p value="{{ substr($clients[$i]->dureecuisson,0,2) }}" id="dureecuissonh{{$clients[$i]->id}}">{!! substr($clients[$i]->dureecuisson,3,2) !!} Minutes</p>
                                                

                                                {{--  --}}
                                            </td>


                                            <td colspan="2"> 

                                                <p  value="{{ substr($clients[$i]->duree,0,2) }}"  
                                                id="dureeh{{$clients[$i]->id}}">{{ substr($clients[$i]->duree,3,2) }} Minutes</p>
                                                
                                                {{--  --}}
                                            </td>


                                            <td colspan="2"> 

                                                <p cols="100" style="height: 20em; color: #000000;" id="conservation{{$clients[$i]->id}}" value="{!! ($clients[$i]->conservation) !!}">{{$clients[$i]->conservation}}</p> 

                                                {{--  --}}
                                            </td>


                                            <td colspan="2"> 

                                                <textarea class="form-control" readonly cols="100" style="height: 20em; color: #000000;" id="ingredients{{$clients[$i]->id}}" value="{!! ($clients[$i]->ingredients) !!}">{{$clients[$i]->ingredients}}</textarea> 

                                                {{--  --}}
                                            </td>


                                            <td colspan="2"> 

                                                <textarea class="form-control" readonly cols="100" style="height: 20em; color: #000000;" id="etapes{{$clients[$i]->id}}" value="{!! ($clients[$i]->etapes) !!}">{{$clients[$i]->etapes}}</textarea> 

                                                {{--  --}}
                                            </td>


                                            <td colspan="2">
                                                

                                                @for ($k=0; $k< sizeof($clients_cat) ; $k++)
                                                    
                                                    @if ($clients_cat[$k]->client_id==$clients[$i]->id)
                                                        
                                                        <p value="rec{{$clients[$i]->id}}cat{{$clients_cat[$k]->categorie_id}}" id="cat{{$i}}{{$clients_cat[$k]->categorie_id}}{{$clients[$i]->id}}">{!! $clients_cat[$k]->categorie_nom !!}</p>                                           

                                                        {{-- expr --}}
                                                    @endif
                                                        
                                                    {{--  --}}
                                                @endfor 


                                                {{--  --}}
                                            </td>

                                            <td colspan="2"> 

                                                <p id="etapes{{$clients[$i]->id}}" value="{!! ($clients[$i]->etapes) !!}">{!! nl2br($clients[$i]->Particularites) !!}</p> 

                                                {{--  --}}
                                            </td>


{{--                                             <td> 

                                                <button class="btn btn-success btn-sm" id="{{$clients[$i]->id}}" onclick="modifierclient(event,this)"> Enregistrer</button> 
                                            </td>
 --}}
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
    <script src="{{ asset('../js/jquery-3.2.1.min.js') }}"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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