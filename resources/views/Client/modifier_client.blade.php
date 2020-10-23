@extends('../layouts.app')


@section('content')         


<div class="card">
    <div class="card-header row" style="width: 100%; margin: auto;">
        <p onclick="f_affich1();" class="col-md-5 btn btn-outline-primary" style="margin: 0.1% 4%;" >Informations génerales</p>
        <p onclick="f_affich2();" class="col-md-5 btn btn-outline-primary" style="margin: 0.1% 4%;" >Informations D'Identification + Facturation</p>
    </div>
    
    <div id="info1" class="card-body">
        
        <blockquote class="blockquote mb-0">
            
            <p style="text-align: center;" class="alert">Photo du Client</p>

            <img style="  display: block; margin-left: auto; margin-right: auto; width: 50%;" src="{{ asset($client->photo) }}">

            <form class="form-inline" method="post" enctype="multipart/form-data" action="/home/clients/modifier">

                {{ csrf_field() }}  

                <div style="margin : 3% 0%;" class="form-group col-md-12">

                    <label for="la_photo">Changer la photo </label>

                    <input type="file" name="la_photo1" value="{{ old('la_photo1') }}" id="la_photo1" class="form-control" >

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
                    <textarea type="text" autofocus id="codeduclient" rows="1" cols="50" required name="code" class="form-control" id="code">{{ old('code') ? old('code') : $client->code_client}} </textarea>

                    @if ($errors->has('code'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif


                    {{--  --}}
                </div>

                <div class="form-group col-md-6 col-sm-12">

                    <label for="tel">Téléphone </label>

                    <textarea type="tel" required id="tel" rows="1" cols="50" required name="tel" class="form-control" id="tel">{{ old('tel') ? old('tel') : $client->tel}}</textarea>

                    @if ($errors->has('tel'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('tel') }}</strong>
                        </span>
                    @endif


                </div>

                <div class="form-group col-md-6 col-sm-12">

                    <label for="fax">Fax </label>

                    <textarea type="fax" id="fax" name="fax" rows="1" cols="50" class="form-control" id="fax">{{ old('fax') ? old('fax') : $client->fax}}</textarea>

                    @if ($errors->has('fax'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('fax') }}</strong>
                        </span>
                    @endif


                    {{--  --}}
                </div>


                <div class="form-group col-md-6 col-sm-12">

                    <label for="mobile">Mobile </label>

                    <textarea type="mobile" id="mobile" name="mobile" rows="1" cols="50" class="form-control" id="mobile">{{ old('mobile') ? old('mobile') : $client->mobile}}</textarea>

                    @if ($errors->has('mobile'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif


                    {{--  --}}
                </div>
                
                
                <div class="form-group col-md-6 col-sm-12">

                    <label for="email">email </label>

                    <textarea type="email" id="email" name="email" rows="1" cols="50" class="form-control" id="email">{{ old('email') ? old('email') : $client->email}}</textarea>

                    @if ($errors->has('email'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>                    


                <div class="form-group col-md-6 col-sm-12">
                    <label for="le_select0">Catégorie</label>
                    
                    <select class="col-md-12 form-control mdb-select md-form" data-live-search="true" searchable="Search here.." name="categorie" id="le_select0">

                        <option value="{{ $client->categorie_id }}"> {{ $client->categorie_nom }} </option>

                        @foreach ($categories as $categorie)
                            

                            <option value="{{$categorie->id}}">{!! $categorie->num !!}-{!! $categorie->nom !!}</option>

                            {{--  --}}                                              
                        @endforeach                                             

                        {{--  --}}
                    </select>
                </div>


                <div class="form-group col-md-6 col-sm-12">
                    <label for="le_select1">Activité</label>
                    
                    <select class="col-md-12 form-control mdb-select md-form" data-live-search="true" searchable="Search here.." name="activite" id="le_select1">

                        <option value="{{ $client->activite_id }}"> {{ $client->activite_nom }} </option>

                        @foreach ($activites as $activite)
                            

                            <option value="{{$activite->id}}">{!! $activite->num !!}-{!! $activite->nom !!}</option>

                            {{--  --}}                                              
                        @endforeach                                             

                        {{--  --}}
                    </select>
                </div>

                <div class="form-group col-md-6 col-sm-12" style="display: none;">
                    <textarea name="id_client" class="form-control" >{{ $client->id }}</textarea>
                </div>                    



                <button type="submit" class="btn btn-outline-info btn-block" style="margin: 2% 0%" class="col-md-12"> Valider </button>

                {{--  --}}
            </form>    


            {{--  --}}
        </blockquote>
    </div>


    {{-- HADI Info 2 --}}

    <div id="info2" class="card-body">
        
        <blockquote class="blockquote mb-0">
            
            <form class="form-inline" id="formulaire2" method="post" enctype="multipart/form-data" action="/home/clients/modifier">

                {{ csrf_field() }}  

                <div class="form-group col-md-6 col-sm-12">

                    <label for="NIS">NIS Client</label>
                    <br>
                    <textarea type="text" autofocus id="NISduclient" rows="1" cols="50" required name="NIS" class="form-control" id="NIS">{{ old('NIS') ? old('NIS') : $client->NIS}} </textarea>

                    @if ($errors->has('NIS'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('NIS') }}</strong>
                        </span>
                    @endif


                    {{--  --}}
                </div>

                <div class="form-group col-md-6 col-sm-12">

                    <label for="NIF">NIF Client</label>

                    <textarea type="NIF" required id="NIF" rows="1" cols="50" required name="NIF" class="form-control" id="NIF">{{ old('NIF') ? old('NIF') : $client->NIF}}</textarea>

                    @if ($errors->has('NIF'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('NIF') }}</strong>
                        </span>
                    @endif


                </div>

                <div class="form-group col-md-6 col-sm-12">

                    <label for="RC">RC </label>

                    <textarea type="RC" id="RC" name="RC" rows="1" cols="50" class="form-control" id="RC">{{ old('RC') ? old('RC') : $client->RC}}</textarea>

                    @if ($errors->has('RC'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('RC') }}</strong>
                        </span>
                    @endif


                    {{--  --}}
                </div>


                <div class="form-group col-md-6 col-sm-12">

                    <label for="n_art_imp">N° Article d'imposition </label>

                    <textarea type="n_art_imp" id="n_art_imp" name="n_art_imp" rows="1" cols="50" class="form-control" id="n_art_imp">{{ old('n_art_imp') ? old('n_art_imp') : $client->n_art_imp}}</textarea>

                    @if ($errors->has('n_art_imp'))
                        <span style="color: red;" class="help-block">
                            <strong>{{ $errors->first('n_art_imp') }}</strong>
                        </span>
                    @endif


                    {{--  --}}
                </div>
                
                
                <div class="form-group col-md-6 col-sm-12">

                    <label for="taux_remise_spec">Taux De Remise Spécifique % </label>

                    <textarea id="taux_remise_spec" name="taux_remise_spec" rows="1" cols="50" class="form-control" id="taux_remise_spec">{{ old('taux_remise_spec') ? old('taux_remise_spec') : $client->taux_remise_spec}}</textarea>
                    
                    <span style="color: red;" class="help-block">
                        <strong id="icierreur">   </strong>
                    </span>
                    
                </div>                    


                <div class="form-group col-md-6 col-sm-12">
                    <label for="client_inter_fact">Client inter de Facturation</label>
                    
                    <select class="col-md-12 form-control mdb-select md-form" data-live-search="true" searchable="Search here.." name="categorie" id="client_inter_fact" onchange="changer();">

                        @if($client->client_inter_fact == "NON")

                            <option value="NON"> NON </option>
                            <option value="OUI"> OUI </option>

                         @else       
                            
                            <option value="OUI"> OUI </option>
                            <option value="NON"> NON </option>
                        @endif

                        {{--  --}}
                    </select>
                </div>

                @if($client->client_inter_fact == "OUI")
                
                    <div class="form-group col-md-7" id="to_display" style="margin: 2% 0%; ">
                        
                        <label for="motif_interd" id="motif_interd_label" style="margin-right: 3%;">Motif interdiction de Facturation</label>
    
                        <select class="form-control" name="motif_interd" id="motif_interd" >
                            
                            <option value="{{ $client->motif_interd }}">{!! $client->motif_interd !!}</option>
                            
                            <option value="Motif N°1"> Motif N°1 </option>
                            <option value="Motif N°2 ........."> Motif N°2 ......... </option>
                        </select>
                    </div>
                 @else
                    <div class="form-group col-md-7" id="to_display" style="margin: 2% 0%; display: none;">
                        
                        <label for="motif_interd" id="motif_interd_label" style="margin-right: 3%;">Motif interdiction de Facturation</label>
    
                        <select class="form-control" name="motif_interd" id="motif_interd" >
                            
                            <option value="{{ $client->motif_interd }}">{!! $client->motif_interd !!}</option>
                            
                            <option value="Motif N°1"> Motif N°1 </option>
                            <option value="Motif N°2 ........."> Motif N°2 ......... </option>
                        </select>
                    </div>

                @endif    


                <div class="form-group col-md-5 col-sm-12" style="margin: 2% 0%; ">

                    @if($client->prospect == 1)
    
                        <div class="custom-control custom-radio" style="margin-right: 20%;">
                            <input type="radio" class="custom-control-input" id="client" value="0"  name="type">
                            <label class="custom-control-label" for="client">Client</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="prospect" value="1" checked name="type">
                            <label class="custom-control-label" for="prospect">Prospect</label>
                        </div>

                     @else   

                        <div class="custom-control custom-radio" style="margin-right: 20%;">
                            <input type="radio" class="custom-control-input" id="client" value="0" checked name="type">
                            <label class="custom-control-label" for="client">Client</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="prospect" value="1" name="type">
                            <label class="custom-control-label" for="prospect">Prospect</label>
                        </div>


                        {{--  --}}
                    @endif

                </div>


                <div class="form-group col-md-6 col-sm-12" style="display: none;">
                    <textarea name="id_client" id="id_client" class="form-control" >{{ $client->id }}</textarea>
                </div>                    



                <button type="submit" onclick="Valider_info2(event)" class="btn btn-outline-info btn-block" style="margin: 2% 0%" class="col-md-12"> Valider </button>

                {{--  --}}
            </form>    

            {{--  --}}
        </blockquote>
    </div>




    {{--  --}}
</div>


<script src="{{ asset('../js/jquery-3.2.1.min.js') }}"></script>
<script>
        


    //
</script>

<script src="{{ asset('js/modifier_client1.js') }}"></script>

@endsection