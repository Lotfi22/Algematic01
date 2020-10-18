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
   
              <h1 style=" text-align: center; " ><B>Bon de Commande</B></h1>     <br>
              <h2 style=" text-align: center; "><B>Fournisseur : {{$nomFournisseur}}</B></h2>  
     <br>
     <br>

    <div>
        <form class="needs-validation" novalidate action="/PDF/{{$idFournisseur}}/{{$nomFournisseur}}" method="POST">
                        {{ csrf_field()}}

         <div class="modal-body">

              <div class="form-row">

                <div class="col-md-12 mb-3">
                  <label for="validationTooltip01"><B>N° Facture ProFormat</B></label>
                  <input type="text"  name="facture" class="form-control" placeholder="FP20600" required>
                </div>

              </div>

              <div class="form-row">
                 <div class="form-group">
                  <label for="exampleFormControlFile1"><B>Photo Facture Proformat</B></label>
                  <input type="file" name="photo"  class="form-control-file" id="exampleFormControlFile1">
                </div>
              </div>
        </div>

        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col"><B>Code_Produit</B></th>
              <th scope="col"><B>Quantité</B></th>
            </tr>
          </thead>
          <tbody>

            @foreach($produits as $produit)
                <tr>
                  <td scope="row"><B>{{$produit}}</B> </td>

                  <td>
                       <div class="form-row">

                                    <div class="col-md-12 mb-3">
                                      <label for="validationTooltip01"><B>Quantité</B></label>
                                      <input type="number"  name="{{$produit}}" min="0" max="20" class="form-control" placeholder="2" required>
                                    </div>

                        </div>

                  </td>
            @endforeach
            </tr>
          </tbody>
        </table>
        <div class="modal-footer">
                            <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn-sm btn btn-primary">PDF</button>
                          </div>
    </form>
    </div>




@endsection