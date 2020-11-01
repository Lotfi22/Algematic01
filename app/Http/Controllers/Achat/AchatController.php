<?php

namespace App\Http\Controllers\Achat;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;

class AchatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
     {

    	$presachats=DB::select("select * from pre_achat where achat_done=0 ");
        $nature_doc_payments=DB::select("select * from nature_doc_payment");

    	
    	return view('Achat\preachat',compact('presachats','nature_doc_payments'));
     }



     public function AddAchat(Request $request,$idPreAchat)
     {
         $this->validate($request,[
            'bl' => 'required|max:100',
            'facture' => 'required|max:100',
            'decharge' => 'required|max:100',
            'attachement' => 'required|max:100'
            ]);

        $facture=$request->input('facture');
        $info=DB::select("select * from bl_achat where facture='$facture'");
       
        

         if (count($info)>0) 
               {
                   
                session()->flash('notif' , ' Erreur Oupss Cette Facture  existe déja  !!! ');

                return redirect()->back(); 
               }
        else
               {
                    $file_extension= $request->photofacture->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photofacture->move($path,$file_name);
                    $photofacture=$file_name;

                    $file_extension= $request->photobl->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photobl->move($path,$file_name);
                    $photobl=$file_name;

                    $file_extension= $request->photoattachement->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photoattachement->move($path,$file_name);
                    $photoattachement=$file_name;

                    $file_extension= $request->photodecharge->getClientOriginalExtension();
                    $file_name=time().'.'.$file_extension;
                    $path='images/achat';
                    $request->photodecharge->move($path,$file_name);
                    $photodecharge=$file_name;

                    $numbl=$request->input('bl');
                    $attachement=$request->input('attachement');
                    $decharge=$request->input('decharge');
                    $facture=$request->input('facture');
                    $date=$request->input('date');
                    $nature_doc=$request->input('doc');

                    $now = Carbon::now()->format('d/m/Y');


                    DB::insert("insert into bl_achat (num_bl,photo_bl,  num_decharge,photo_decharge,num_attachement,photo_attachement,facture,photo_facture) 
                        values('$numbl','$photobl','$decharge','$photodecharge','$attachement','$photoattachement','$facture','$photofacture') ");

                    $id_bl_achat=DB::select("select id from bl_achat where num_bl='$numbl' ");

                    $id_bl_achat=$id_bl_achat[0]->id;

                    DB::insert("insert into achat (id_pre_achat,id_nature_doc,id_bl_achat) 
                        values('$idPreAchat','$nature_doc','$id_bl_achat') ");
                    
                    DB::update("update pre_achat p set achat_done=1 where p.id='$idPreAchat' ");
                    
                    return redirect('/preachat')->with('success','Achat enregistré avec succée');

                }
       



     }
}
