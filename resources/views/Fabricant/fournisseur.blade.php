@extends('../layouts.admin')
@section('content')         
    
     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
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
    <div>
         <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalFOURNISSEUR">
                      Ajouter Un Fournisseur
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalFOURNISSEUR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations du Nouveau Fournisseur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>


       <form class="needs-validation" novalidate action="/home/fournisseurs/AddFournisseur" method="POST">
          {{ csrf_field()}}

            <div class="modal-body">

  

              <div id="anonyme">

                      <div class="form-row" >

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip01"><B>Nom</B></label>
                          <input type="text"  name="nom" class="form-control" placeholder="COMPILS" required>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip02"><B>Adresse</B></label>
                          <input type="text" name="adresse"class="form-control"  placeholder="EL HAMIZ" required>
                        </div>

                      </div>

                       <div class="form-row" >

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip01"><B>Activité</B></label>
                          <input type="text"  name="activite" class="form-control" placeholder="CAMERA ET CABLES" required>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip02"><B>Téléphone</B></label>
                          <input type="number" minlength="10" maxlength="10" name="tele"class="form-control"  placeholder="0550725743" required>
                        </div>
                        
                      </div>

              </div>

              <hr>

              <div id="nonanonyme">

                      <div class="form-row">

                      <h4 ><B>Fabricant ?</B></h4>

                          <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="FabricantOui" name="FabricantYN" value="yes" checked  onclick="yesnoCheckFabricant()" >
                          <label class="custom-control-label" for="FabricantOui">Oui</label>
                        </div>

                        <!-- Default checked -->
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="FabricantNon" name="FabricantYN" value="non" onclick="yesnoCheckFabricant()">
                          <label class="custom-control-label" for="FabricantNon">Non</label>
                        </div>
                    </div>

                    <br>

                      <div class="form-row" id="JeSuisFabricat">

                        <div class="col-md-12 mb-6">
                          <label for="validationTooltip01"><B>Marque</B></label>
                          <input type="text"  name="marque" class="form-control" placeholder="marque" >
                        </div>

                      </div>
<hr>
                      <div class="form-row">

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip01"><B>Fax</B></label>
                          <input type="number"  minlength="9" maxlength="9"  name="fax" class="form-control" placeholder="021889977" required>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip02"><B>Mobile</B></label>
                          <input type="number" minlength="10" maxlength="10" name="mobile"class="form-control"  placeholder="021889977" required>
                        </div>
                        
                      </div>

                      <div class="form-row">

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip01"><B>Email</B></label>
                          <input type="email"  name="email" class="form-control" placeholder="lasnami.walid@outlook.com" required>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip02"><B>NIF</B></label>
                          <input type="number" min="0" name="nif"class="form-control"  placeholder="000448756" required>
                        </div>
                        
                      </div>

                      <div class="form-row">

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip01"><B>NIS</B></label>
                          <input type="number" min="0"  name="nis" class="form-control" placeholder="000448756" required>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip02"><B>RC</B></label>
                          <input type="text" name="rc"class="form-control"  placeholder="0009A69408" required>
                        </div>
                        
                      </div>
                      <div class="form-row">

                        <div class="col-md-6 mb-3">
                          <label for="validationTooltip01"><B>N° Art IMP</B></label>
                          <input type="text"  name="num_art_imp" class="form-control" placeholder="021786" required>
                        </div>
                        
                      </div>
            </div>

                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-sm btn btn-primary">Ajouter</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

    </div>

     <br>
     <br>

    <div>
        <table class="table table-striped table-dark" id="table_id">
          <thead>
            <tr>
              <th scope="col"><B>Numéro</B></th>
              <th scope="col"><B>Nom</B></th>
              <th scope="col"><B>Adresse</B></th>
              <th scope="col"><B>Activité</B></th>
              <th scope="col"><B>+ BC</B></th>
              <th scope="col"><B>Autres Infos</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($fournisseurs as $fournisseur)
            <tr>
              <td scope="row"><B>{{$fournisseur->id}}</B></td>
              <td>{{$fournisseur->nom}}</td>
              <td>{{$fournisseur->adresse}}</td>
              <td>{{$fournisseur->activite}}</td>
              <td>
                  <!--  <a href="/commande/{{$fournisseur->id}}" type="button" class="btn-sm btn btn-success">Ajouter BC</a>-->
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#exampleModalBC{{$fournisseur->id}}">
                       Ajouter BC
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalBC{{$fournisseur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"  id="exampleModalLabel">Ajouter Une Facture PROFORMAT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/commande/{{$fournisseur->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        
                          
                          <div class="modal-body">
                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Numéro Facture ProForma</B></label>
                                  <input type="text" name="facture"class="form-control" placeholder="FP20600" required>
                                </div>

                              </div>

                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Date de La facture</B></label>
                                  <input type="date" name="date"class="form-control" placeholder="02/05/2018" required>
                                </div>

                              </div>
                              <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo</B></label>
                                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>

                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>Remise</B></label>
                                  <input type="text" name="remise"class="form-control" placeholder="3 %" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>TVA</B></label>
                                  <input type="text" name="tva"class="form-control" placeholder="19 %" required>
                                </div>

                              </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Ajouter</button>
                          </div>
                      </form>
                        </div>
                      </div>
                    </div>

              <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#InfosPlus{{$fournisseur->id}}">
                      Plus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="InfosPlus{{$fournisseur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informations Suplémentaires</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p><B>Mobile: </B>{{$fournisseur->mobile}}</p>
                            <p><B>Téléphone: </B>{{$fournisseur->tele}}</p>
                            <p><B>Fax:</B> {{$fournisseur->fax}}</p>
                            <p><B>Email:</B> {{$fournisseur->email}}</p>
                            <p><B>NIS:</B> {{$fournisseur->nis}}</p>
                            <p><B>NIF:</B> {{$fournisseur->nif}}</p>
                            <p><B>RC:</B> {{$fournisseur->rc}}</p>
                            <p><B>Num_Art_Imp:</B> {{$fournisseur->num_art_imp}}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-succes" data-dismiss="modal">Fermer</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
              </td>
              
              <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFfournisseur{{$fournisseur->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFfournisseur{{$fournisseur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/home/fournisseurs/ModifFournisseur/{{$fournisseur->id}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>NV-Nom</B></label>
                                  <input type="text"  name="nom" class="form-control" placeholder="{{$fournisseur->nom}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>NV-Adresse</B></label>
                                  <input type="text" name="adresse"class="form-control"  placeholder="{{$fournisseur->adresse}}" required>
                                </div>

                              </div>

                               <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>NV-Activité</B></label>
                                  <input type="text"  name="activite" class="form-control" placeholder="{{$fournisseur->activite}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>NV-Téléphone</B></label>
                                  <input type="number" minlength="10" maxlength="10" name="tele"class="form-control"  placeholder="{{$fournisseur->tele}}" required>
                                </div>
                                
                              </div>
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>NV-Fax</B></label>
                                  <input type="number"  minlength="9" maxlength="9"  name="fax" class="form-control" placeholder="{{$fournisseur->fax}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>NV-Mobile</B></label>
                                  <input type="number" minlength="10" maxlength="10" name="mobile"class="form-control"  placeholder="{{$fournisseur->mobile}}" required>
                                </div>
                                
                              </div>

                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>NV-Email</B></label>
                                  <input type="email"  name="email" class="form-control" placeholder="{{$fournisseur->email}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>NV-NIF</B></label>
                                  <input type="number" min="0" name="nif"class="form-control"  placeholder="{{$fournisseur->nif}}" required>
                                </div>
                                
                              </div>

                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>NV-NIS</B></label>
                                  <input type="number" min="0"  name="nis" class="form-control" placeholder="{{$fournisseur->nif}}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip02"><B>NV-RC</B></label>
                                  <input type="text" name="rc"class="form-control"  placeholder="{{$fournisseur->rc}}" required>
                                </div>
                                
                              </div>
                              <div class="form-row">

                                <div class="col-md-6 mb-3">
                                  <label for="validationTooltip01"><B>NV-N° Art IMP</B></label>
                                  <input type="text"  name="num_art_imp" class="form-control" placeholder="{{$fournisseur->num_art_imp}}" required>
                                </div>
                                
                              </div>


                              
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Modifier</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>
                
                 <td>
                    <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERfournisseur{{$fournisseur->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERfournisseur{{$fournisseur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/SupprimerFournisseur/{{$fournisseur->id}}" method="POST">
                        {{ csrf_field()}}
                          
                          <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">Supprimer</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>




@endsection

 <script>
            
       function yesnoCheckFabricant() {
            if (document.getElementById('FabricantOui').checked) {
                document.getElementById('JeSuisFabricat').style.display = 'block';
            } 
            else if(document.getElementById('FabricantNon').checked) {
                document.getElementById('JeSuisFabricat').style.display = 'none';
           }
        }

        //
    </script>