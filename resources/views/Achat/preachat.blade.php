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
                        <h1 style="text-align: center;  " >Liste Des Pré_Achats</h1>
                      </div>
                      <br>
   

    <div>
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>N° FP</B></th>
              <th scope="col"><B>Photo FP</B></th>
              <th scope="col"><B>N° BC</B></th>
              <th scope="col"><B>Achat</B></th>
              <th scope="col"><B>Modifier</B></th>
              <th scope="col"><B>Supprimer</B></th>
            </tr>
          </thead>
          <tbody>
            @foreach($presachats as $preachat)
            <tr>
              <td scope="row"><B>{{$preachat->num_facture_proformat}}</B></td>
              <td><!-- Photo Facture proformat -->
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#staticBackdrop{{$preachat->num_facture_proformat}}">
                    Photo FP
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop{{$preachat->num_facture_proformat}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Photo_FP</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img src="{{asset('images/factureproforma/'.$preachat->facture_proformat_photo ?? "nimi")}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              <td>{{$preachat->num_bc}}</td>
              <td>
                  
                  <button type="button" class="btn-sm btn btn-success" data-toggle="modal" data-target="#exampleModalBC{{$preachat->id}}">
                       Achat
                    </button>

                    <!-- Boutom d'achat -->
                    <div class="modal fade" id="exampleModalBC{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"  id="exampleModalLabel">Informations de l'Achat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/AddAchat/{{$preachat->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        
                          
                          <div class="modal-body">
              
                              

                               <div class="form-row">
                                  <div class="col-md-6 mb-3">
                                    <label for="validationTooltip03"><B>N° BL </B></label>
                                    <input type="text" name="bl"class="form-control" placeholder="BL0600" required>
                                 </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="validationTooltip03"><B>N° Attachement </B></label>
                                    <input type="text" name="attachement"class="form-control" placeholder="AT0600" required>
                                 </div>
                                </div>

                                <div class="form-row">
                                 <div class="col-md-6 mb-3">
                                    <label for="validationTooltip03"><B>N° Décharge </B></label>
                                    <input type="text" name="decharge"class="form-control" placeholder="BL0600" required>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                  <label for="validationTooltip03"><B>N° Facture </B></label>
                                  <input type="text" name="facture"class="form-control" placeholder="F20600" required>
                                </div>
                                </div>

                                <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo Facture</B></label>
                                  <input type="file" name="photofacture"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>

                                <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo BL</B></label>
                                  <input type="file" name="photobl"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>

                               

                                <div class="form-row">

                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo Attachement</B></label>
                                  <input type="file" name="photoattachement"  class="form-control-file" id="exampleFormControlFile1">
                                </div>

                              </div>


                                <div class="form-row">
                                 <div class="form-group" >
                                  <label for="exampleFormControlFile1"><B>Photo Décharge</B></label>
                                  <input type="file" name="photodecharge"  class="form-control-file" id="exampleFormControlFile1">
                                </div>
                              </div>
                              <div class="form-row">
                               <div class="col-md-12 mb-6">
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1"><B>Nature Doc_Payement</B></label>
                                    <select name="doc" class="form-control" id="exampleFormControlSelect1">
                                     @foreach($nature_doc_payments as $doc)
                                     <option value="{{$doc->id}}"> {{  $doc->nom  }} </option>
                                      @endforeach
                                     
                                    </select>
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

             
              
              <td>
                    <button type="button" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#exampleModalMODIFpreachat{{$preachat->id}}">
                      Modifier
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalMODIFpreachat{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouvelles Infos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Modifpreachat/{{$preachat->id}}" method="POST">
                        {{ csrf_field()}}
                          <div class="modal-body">
                              <div class="form-row">

                             

                              -->
                              
                            
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
                    <button type="button" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#exampleModalSUPPRIMERpreachat{{$preachat->id}}">
                       Supprimer
                    </button>

                    <!-- Boutom d'Ajouter une Maman -->
                    <div class="modal fade" id="exampleModalSUPPRIMERpreachat{{$preachat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                     <form class="needs-validation" novalidate action="/Supprimerpreachat/{{$preachat->id}}" method="POST">
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