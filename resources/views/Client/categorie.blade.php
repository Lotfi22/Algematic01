@extends('../layouts.admin')

@section('content')         

    <div class="row" id="hnaya">

        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Table des categories</h4>

                    <h6 class="card-subtitle">categories disponibles</code></h6>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Ajouter une categorie </button>

                    <div id="myModal" class="modal fade" role="dialog">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                               <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    <h4 class="modal-title">Nouvelle categorie</h4>
                              </div>

                                <div class="modal-body">

                                    <form class="form-inline">

                                        {{ csrf_field() }}  

                                        <div class="form-group col-md-6">

                                            <label for="nom">Nom </label>

                                            <textarea id="nomducategorie" cols="50" required name="nom" class="form-control" id="nom"></textarea>

                                            {{--  --}}
                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="num">Numéro</label>

                                            <textarea id="numducategorie" cols="50" required name="num" class="form-control" id="num"></textarea>

                                            {{--  --}}
                                        </div>

                                        <br><br>

                                        <div class="form-group col-md-12" style="margin-top: 2%;">

                                            <label for="description">description </label>

                                            <textarea id="descducategorie" rows="5" cols="2000" required name="description" class="form-control" id="description"></textarea>
                                        </div>


{{--                                         <div class="form-group col-md-12" style="margin-top: 2%;">

                                            <label for="description" style="margin-right: 3%;">description </label>

                                            <select class="form-control" id="description" name="visible">
                                                
                                                <option value="visible"> Visible </option>

                                                <option value="invisible"> Invisible </option>

                                            </select>

                                        </div>
 --}}


                                      <button style="margin-top: 5%;" id="ajout{{ $last_id }}" data-dismiss="modal" onclick="ajoutercategorie(event,this)" class="btn btn-success col-md-6">Ajouter</button>
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

                        <table class="table table-striped display" id="table_id">

                            <thead>

                                <tr>

                                    <th>Numéro</th>

                                    <th>Nom</th>
                                    
                                    <th>Description</th>

                                    <th>Action</th>

                                </tr>

                            </thead>



                            <tbody id="all_the_categories">

                                @for($i=0 ; $i < count($categories) ; $i++)

                                    <tr id="categorie{{$categories[$i]->id}}">

                                        <form>

                                            {{ csrf_field() }}  

                                            <td>

                                                {{ $categories[$i]->num }}                                                
                                            </td>

                                            <td> 

                                                <div class="form-group col-md-12 col-sm-12">

                                                    <p style="text-align: center;" id="parag{{$categories[$i]->id}}">{!! $categories[$i]->nom !!}</p>
                                                    
                                                    <textarea type="text" rows="4" name="nom" class=" form-control" id="nomcategorie{{$categories[$i]->id}}" value="{!! $categories[$i]->nom !!}">{!! $categories[$i]->nom !!}</textarea>
                                                    

                                                    {{--  --}}
                                                </div>                                                    

                                                {{--  --}}
                                            </td>

                                            <td> 

                                                <p style="text-align: center;" id="paragdesc{{$categories[$i]->id}}">{!! ($categories[$i]->description) !!}</p>

                                                <textarea type="text" rows="5" class="form-control" name="description" id="description{{$categories[$i]->id}}" value="{!! ($categories[$i]->description) !!}">{!! ($categories[$i]->description) !!}</textarea> 

                                                {{--  --}}
                                            </td>

                                            <td> 

                                                <button class="btn btn-success btn-sm" id="modiff{{$categories[$i]->id}}" onclick="lancer_modif(event,this)"> Modifier</button> 
                                                <button class="btn btn-success btn-sm eng" id="{{$categories[$i]->id}}" onclick="modifiercategorie(event,this)"> Enregistrer</button> 

                                                @if ($categories[$i]->id!=0)

    

                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-{{$categories[$i]->id}}" style="color: #fff;"> supprimer</a>

                                                    <div id="myModalsup-{{$categories[$i]->id}}" class="modal fade" role="dialog">

                                                      <div class="modal-dialog modal-lg">

                                                            <!-- Modal content-->

                                                            <div class="modal-content">

                                                               <div class="modal-header">

                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                                    <h4 class="modal-title">Voulez-vous vraiment supprimer ce categorie</h4>
                                                              </div>

                                                              <div class="modal-body">

                                                                    <button class="col-md-5 btn btn-danger" onclick="supprimercategorie(event,this)" data-dismiss="modal" id="mod{{$categories[$i]->id}}">OUI,je supprime</button>

                                                                    <a data-dismiss="modal" class="col-md-6  btn btn-success" style="color: #ffffff;" >NON,je ne veux pas supprimer</a>
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
                                                @endif
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

    <script src="{{ asset('js/modifierlescategories.js') }}"></script>
 {{--  --}}   
@endsection