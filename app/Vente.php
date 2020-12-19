<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;
use App\User;
use Auth;
use Storage;


class Vente extends Model
{

	public static function PDF_BL($ligne_ventes,$client,$now,$year,$NbNumF,$numf,$en_lettre,$ma_vente)
	{	

        $dompdf = new Dompdf();

        $les_produits = '';
        
        $k = 1;
        
        foreach ($ligne_ventes as $ligne) 
        {

            $les_produits = $les_produits .
            '<tr class="item">
                
                <td class="td" style="text-align: center;" >
                    '.$k.'
                </td>
                <td class="td" style="text-align: center;" >
                    '.$ligne->nom.'
                </td>                    
                <td class="td" style="text-align: center;" >
                    '.$ligne->description.'
                </td>
                <td class="td" style="text-align: center;" >
                    U
                </td>
                <td class="td" style="text-align: center;" >
                    '.$ligne->quantite.'
                </td>
            </tr>';

            $k++;
            # code...
        }

        if ($client[0]->taux_remise_spec != 0) 
        {
        
            $total =  '<table border="1" style="float: right; width: 34%;" >
        
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant Total HT  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total).' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Remise </b> </td>
                    <td align="center"> '. number_format(($ma_vente[0]->montant_total)*($client[0]->taux_remise_spec/100)) .' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b>Montant aprés Remise   </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*(1-($client[0]->taux_remise_spec/100))).' </td>
                </tr>            
                
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant TVA 19%  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*0.19).' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Total TTC </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*1.19).' </td>
                </tr>
        
            </table>';

            # code...
        }
        else
        {

            $total =  '<table border="1" style="float: right; width: 34%;" >
        
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant Total HT  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total).' </td>
                </tr>
                
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant TVA 19%  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*0.19).' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Total TTC </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*1.19).' </td>
                </tr>
        
            </table>';

            #..
        }

        $html = '<!doctype html>

        <html lang="en">

            <head>

                <meta charset="UTF-8">
                
                <title>Bon de livraison </title>

                <style type="text/css">
                *{
                    font-family: Verdana, Arial, sans-serif;
                }

                .les_prod, .th, .td 
                {
                    border: 1px solid black;
                    border-collapse: collapse;
                }
                
                </style>
            </head>

            <body style="font-size : 12px;" > 
                
                <table id="tabla" width="100%">
                    <tr>
                        <td>
                            
                            <img src="'.public_path("algematic.png").'">
                            
                            <h4 style="text-align: left;">Bon de livraison N° : '.$numf.' <span style="float:right; margin-right:4%;"> Alger, le '.$now.' </span></h4>
                            
                            <div style="padding: 4px; border: solid; border-radius: 5%; width: 48%; float: right;" > 
                                
                                <b>Client: </b> 001 <br> 
                                <b>Adresse :</b> Adresse: '.$client[0]->adresse.' <br>  
                                <b>RC :</b> '.$client[0]->RC.' <br>  
                                <b>NIF :</b> '.$client[0]->RC.' <br>  
                                <b>AI :</b> '.$client[0]->n_art_imp.' <br>  
                            </div>

                            <div style="padding: 4px; border: solid; border-radius: 5%; width: 48%; float: left;" >   
                                <b>Raison :</b>  SARL ALGEMARTIC <br>
                                <b>Adresse :</b> Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger. 16120<br>  
                                <b>RC :</b> 16/00-0984669 B 12 <br>  
                                <b>AI :</b> 16390745693 <br>  
                                <b>NIF :</b> 00 1216098466902 <br>  

                            </div>
                        </td>
                    </tr>
                </table>
                
                <br/><br/><br/><br/><br/><br/><br/><br/> Relatif au bon de commande N°'.$ma_vente[0]->num_bc.' <br/><br/>
                
                <table class="les_prod" width="100%" >
                
                    <thead>
                        <tr>
                            <th class="th" > N° </th>
                            <th class="th" > Référance </th>
                            <th class="th" > Désignation </th>
                            <th class="th" > Unité </th>
                            <th class="th" > Quantité </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        '.$les_produits.'
                    </tbody>

                </table>

                /*.$total.*/

                <br><br><br><br><br><br><br><br>
                
                <div style="margin-left: 3%;">
                    
                    <h5 style="float: right; margin-right: 10%;">P/SARL ALGEMARTIC Cachet et signature</h5>
                    <h5 style="float: left;" >Approbation de la commande par le client</h5>
                </div>
                
                <br><br><br>
                
                <hr style="border: solid 2px;">

                <h5><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
                <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>
            </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $content = $dompdf->output();
        $file = $content;
        Storage::put('BL/file_'.'BL'.$NbNumF.'_'.$year.'.pdf',$file);
        $dompdf->stream('BL'.$NbNumF.'_'.$year.'.pdf', array('Attachment'=>1));

		# code...
	}


























	
	public static function PDF_DECHARGE($ligne_ventes,$client,$now,$year,$NbNumF,$numf,$en_lettre,$ma_vente)
	{	

        $dompdf = new Dompdf();

        $les_produits = '';
        
        $k = 1;
        
        foreach ($ligne_ventes as $ligne) 
        {

            $les_produits = $les_produits .
            '<tr class="item">
                
                <td class="td" style="text-align: center;" >
                    '.$k.'
                </td>
                <td class="td" style="text-align: center;" >
                    '.$ligne->nom.'
                </td>                    
                <td class="td" style="text-align: center;" >
                    '.$ligne->description.'
                </td>
                <td class="td" style="text-align: center;" >
                    U
                </td>
                <td class="td" style="text-align: center;" >
                    '.$ligne->quantite.'
                </td>
            </tr>';

            $k++;
            # code...
        }

        if ($client[0]->taux_remise_spec != 0) 
        {
        
            $total =  '<table border="1" style="float: right; width: 34%;" >
        
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant Total HT  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total).' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Remise </b> </td>
                    <td align="center"> '. number_format(($ma_vente[0]->montant_total)*($client[0]->taux_remise_spec/100)) .' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b>Montant aprés Remise   </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*(1-($client[0]->taux_remise_spec/100))).' </td>
                </tr>            
                
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant TVA 19%  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*0.19).' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Total TTC </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*1.19).' </td>
                </tr>
        
            </table>';

            # code...
        }
        else
        {

            $total =  '<table border="1" style="float: right; width: 34%;" >
        
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant Total HT  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total).' </td>
                </tr>
                
                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Montant TVA 19%  </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*0.19).' </td>
                </tr>

                <tr>
                    
                    <td align="left" style="width: 45%;"><b> Total TTC </b> </td>
                    <td align="center"> '.number_format($ma_vente[0]->montant_total*1.19).' </td>
                </tr>
        
            </table>';

            #..
        }

        $html = '<!doctype html>

        <html lang="en">

            <head>

                <meta charset="UTF-8">
                
                <title>Décharge </title>

                <style type="text/css">
                *{
                    font-family: Verdana, Arial, sans-serif;
                }

                .les_prod, .th, .td 
                {
                    border: 1px solid black;
                    border-collapse: collapse;
                }
                
                </style>
            </head>

            <body style="font-size : 12px;" > 
                
                <table id="tabla" width="100%">
                    <tr>
                        <td>
                            
                            <img src="'.public_path("algematic.png").'">
                            
                            <h4 style="text-align: left;">Décharge N° : '.$numf.' <span style="float:right; margin-right:4%;"> Alger, le '.$now.' </span></h4>
                            
                            <div style="padding: 4px; border: solid; border-radius: 5%; width: 48%; float: right;" > 
                                
                                <b>Client: </b> 001 <br> 
                                <b>Adresse :</b> Adresse: '.$client[0]->adresse.' <br>  
                                <b>RC :</b> '.$client[0]->RC.' <br>  
                                <b>NIF :</b> '.$client[0]->RC.' <br>  
                                <b>AI :</b> '.$client[0]->n_art_imp.' <br>  
                            </div>

                            <div style="padding: 4px; border: solid; border-radius: 5%; width: 48%; float: left;" >   
                                <b>Raison :</b>  SARL ALGEMARTIC <br>
                                <b>Adresse :</b> Adresse: Ali Sadek Route National N° 145 local N°01 Hamiz Bordj El Kiffan Alger. 16120<br>  
                                <b>RC :</b> 16/00-0984669 B 12 <br>  
                                <b>AI :</b> 16390745693 <br>  
                                <b>NIF :</b> 00 1216098466902 <br>  

                            </div>
                        </td>
                    </tr>
                </table>
                                
                <table class="les_prod" width="100%" >
                
                    <thead>
                        <tr>
                            <th class="th" > N° </th>
                            <th class="th" > Référance </th>
                            <th class="th" > Désignation </th>
                            <th class="th" > Unité </th>
                            <th class="th" > Quantité </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        '.$les_produits.'
                    </tbody>

                </table>

                '.$total.'

                <br><br><br><br><br><br><br><br>
                
                <div style="margin-left: 3%;">
                    
                    <h5 style="float: right; margin-right: 10%;">P/SARL ALGEMARTIC Cachet et signature</h5>
                    <h5 style="float: left;" >Approbation de la commande par le client</h5>
                </div>
                
                <br><br><br>
                
                <hr style="border: solid 2px;">

                <h5><B>Adresse: Ali Sadek R N° 145 Local N° 01 Hamiz Bordj EL Kiffan Alger, Algérie.</B>  SARL Capital: 30.000.000,00 DA </h5>
                <h5><B>Télé: 0550 81 48 41 </B>                                    RC N°: 16/00-0984669B12</h5>
            </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();
        $content = $dompdf->output();
        $file = $content;
        Storage::put('ATTACHEMENT/file_'.'ATTACHEMENT'.$NbNumF.'_'.$year.'.pdf',$file);
        $dompdf->stream('ATTACHEMENT'.$NbNumF.'_'.$year.'.pdf', array('Attachment'=>1));

		# code...
	}






    //
}
