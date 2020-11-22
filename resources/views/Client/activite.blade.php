@extends('../layouts.admin')

@section('content')         

    <div class="row" id="hnaya">

        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Table des activités</h4>

                    <h6 class="card-subtitle">activites disponibles</code></h6>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Ajouter une Activite </button>

                    <div id="myModal" class="modal fade" role="dialog">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                               <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    <h4 class="modal-title">Nouvelle activité</h4>
                                </div>

                                <div class="modal-body">

                                    <form class="form-inline">

                                        {{ csrf_field() }}  

                                        <div class="form-group col-md-6">

                                            <label for="nom">Nom </label>

                                            <textarea type="text" id="nomduactivite" cols="50" required name="nom" class="form-control" id="nom"></textarea>

                                            {{--  --}}
                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="num">Numéro</label>

                                            <textarea type="text" id="numduactivite" cols="50" required name="num" class="form-control" id="num"></textarea>

                                            {{--  --}}
                                        </div>

                                        <br><br>

                                        <div class="form-group col-md-12" style="margin-top: 2%;">

                                            <label for="description">description </label>

                                            <textarea type="text" id="descduactivite" rows="5" cols="2000" required name="description" class="form-control" id="description"></textarea>
                                        </div>


{{--                                         <div class="form-group col-md-12" style="margin-top: 2%;">

                                            <label for="description" style="margin-right: 3%;">description </label>

                                            <select class="form-control" id="description" name="visible">
                                                
                                                <option value="visible"> Visible </option>

                                                <option value="invisible"> Invisible </option>

                                            </select>

                                        </div>
 --}}


                                      <button style="margin-top: 5%;" id="ajout{{ $last_id }}" data-dismiss="modal" onclick="ajouteractivite(event,this)" class="btn btn-success col-md-6">Ajouter</button>
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

                        <table id="table_id" class="table display">

                            <thead>

                                <tr>

                                    <th>numéro</th>

                                    <th>nom</th>

                                    <th>description</th>

                                    <th>Action</th>
                                </tr>

                            </thead>



                            <tbody id="all_the_activites">

                                @for($i=0 ; $i < count($activites) ; $i++)

                                    <tr id="activite{{$activites[$i]->id}}">

                                        <form>

                                            {{ csrf_field() }}  

                                            <td>

                                                {{ $activites[$i]->num }}                                                
                                            </td>

                                            <td> 

                                                <div class="form-group col-md-12 col-sm-12">

                                                    <label>
                                                        <textarea type="text" rows="4" name="nom" class=" form-control" id="nomactivite{{$activites[$i]->id}}" value="{!! $activites[$i]->nom !!}">{!! $activites[$i]->nom !!}</textarea>
                                                    </label>

                                                    {{--  --}}
                                                </div>                                                    

                                                {{--  --}}
                                            </td>

                                            <td> 

                                                <textarea type="text" rows="5" class="form-control" name="description" id="description{{$activites[$i]->id}}" value="{!! ($activites[$i]->description) !!}">{!! ($activites[$i]->description) !!}</textarea> 

                                                {{--  --}}
                                            </td>

                                            <td> 

                                                <button class="btn btn-success btn-sm" id="{{$activites[$i]->id}}" onclick="modifieractivite(event,this)"> Enregistrer</button> 

                                                @if ($activites[$i]->id!=0)

    

                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-{{$activites[$i]->id}}" style="color: #fff;"> supprimer</a>

                                                    <div id="myModalsup-{{$activites[$i]->id}}" class="modal fade" role="dialog">

                                                      <div class="modal-dialog modal-lg">

                                                            <!-- Modal content-->

                                                            <div class="modal-content">

                                                               <div class="modal-header">

                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                                    <h4 class="modal-title">Voulez-vous vraiment supprimer ce activite</h4>
                                                              </div>

                                                              <div class="modal-body">

                                                                    <button class="col-md-5 btn btn-danger" onclick="supprimeractivite(event,this)" data-dismiss="modal" id="mod{{$activites[$i]->id}}">OUI,je supprime</button>

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

    <script src="{{ asset('js/modifierlesactivites.js') }}"></script>
 {{--  --}}   
@endsection