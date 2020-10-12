@extends('../layouts.admin')


@section('content')         

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <div class="row" id="hnaya">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Table des clients</h4>

                    <h6 class="card-subtitle">clients disponibles</code></h6>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Ajouter une clients </button>

                    <div id="myModal" class="modal fade" role="dialog">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                               <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    <h4 class="modal-title">Nouvelle client</h4>
                              </div>

                                <div class="modal-body">

                                    <form class="form-inline" method="post" enctype="multipart/form-data" action="/home/clients/ajouter/ajax">

                                        {{ csrf_field() }}  


                                        <div class="form-group col-md-12">

                                            <label for="la_photo">Choisir la photo 1 </label>

                                            <input type="file" required name="la_photo1" id="la_photo1" class="form-control" >

                                            {{--  --}}
                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="nom">Titre </label>

                                            <textarea type="text" rows="10" cols="2000" autofocus id="nomduclient" required name="nom" class="form-control" id="nom"></textarea>

                                            {{--  --}}
                                        </div>

                                        <div class="form-group col-md-6">

                                            <label for="descduclient">description </label>

                                            <textarea type="text" required id="descduclient" rows="10" cols="2000" required name="description" class="form-control" id="description"></textarea>
                                        </div>

                                        <div class="form-group col-md-6">

                                            <label for="portduclient">portions </label>

                                            <input type="number" required id="portduclient" name="portions" class="form-control" id="portions">

                                            {{--  --}}
                                        </div>


                                        <div class="form-group col-md-6">    

                                            <label for="Préparation">Préparation </label>

                                            <input type="number" min="1" required id="Préparation" class="form-control col-md-5" name="preparation"> &nbsp Minutes 
                                        </div>    

                                        <br><br><br>
                                        
                                        <label> Durée de cuisson </label>
                                        
                                        <label for="dureecuissmin" class="col-md-10"> Minutes <input type="number" min="0" name="dureecuissmin" class="form-control" required max="59" placeholder="10"
                                        id="dureecuissmin"></label>
                                      
                                        <br><br>

                                        <label> Durée de Repos : </label>     
                                        
                                        <label for="dureemin" class="col-md-10"> Minutes <input type="number" min="0" name="dureemin" class="form-control" required max="59" placeholder="10"
                                        id="dureemin"></label>

                                        <br><br><br><br>                                    

                                        <div class="form-group col-md-12">
                                            
                                            <label for="">Conservation </label>
                                            
                                            <textarea type="text" required rows="2" cols="70" class="form-control" name="conservation" id="conservation"></textarea></textarea> 
                                        </div>

                                        <br><br><br><br>

                                        <div class="form-group col-md-6">
                                            
                                            <label for="">Ingredients </label>
                                            
                                            <textarea type="text" required rows="10" cols="2000" class="form-control" name="ingredients" id="ingredients"></textarea></textarea> 
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            
                                            <label for="">etapes </label>
                                            
                                            <textarea type="text" required rows="10" cols="2000" class="form-control" name="etapes" id="etapes"></textarea></textarea> 
                                        </div>

                                        <div class="form-group col-md-6">
                                            
                                            <label for="">Particularités : </label>
                                            
                                            <textarea type="text" required rows="10" cols="2000" class="form-control" name="Particularites" id="Particularites"></textarea></textarea> 
                                        </div>


                                        <label style="visibility: hidden;"> Categories </label>
                                        <label style="visibility: hidden;"> Categories </label>

                                        <label style="visibility: hidden;"> Categories </label>
                                        <label style="visibility: hidden;"> Categories </label>
                                        <h3 style="visibility: visible;"> Categories : </h3>

                                        @for ($e = 0; $e < 5 ; $e++)
                                            
                                            <select class="col-md-12 form-control"  data-live-search="true"  name="categorie{{$e}}" id="le_select{{$e}}" onchange="f_affich(event,this);">

                                                <option value="------">----------------</option>

                                                @foreach ($categories as $categorie)
                                                    

                                                    <option value="{{$categorie->id}}">{!! $categorie->nom !!}</option>

                                                    {{--  --}}                                              
                                                @endforeach                                             
                                                {{--  --}}
                                            </select>
                                            {{-- expr --}}
                                        @endfor


                                        <button style="margin-top: 5%;" id="ajout{{ $last_id }}" {{-- data-dismiss="modal" onclick="ajouterclient(event,this)" --}} type="submit" class="btn btn-success col-md-6">Ajouter</button>
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

 {{--  --}}   
@endsection