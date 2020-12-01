<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function ajuster_produits($array)
    {

        foreach ($array as $value) 
        {
            
            $value->nom = "produit_".$value->nom;
            
            # code...
        }  

        return $array;

        # code...
    }

    public static function ajuster_articles($array)
    {

        foreach ($array as $value) 
        {
            
            $value->nom = "article_".$value->nom;
            
            # code...
        }  

        return $array;

        # code...
    }

    public static function ajuster_prestations($array)
    {

        foreach ($array as $value) 
        {
            
            $value->nom = "prestat_".$value->nom;
            
            # code...
        }  

        return $array;

        # code...
    }




    public static function asLetters($number,$separateur=",") {
    
    $convert = explode($separateur, $number);

    $mine = explode($separateur, $number)[0];

    $digit = ($mine[0]);
    $six = (strlen($mine));


    $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
                     'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');
                      
    $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
                      60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');
                                      
    if (isset($convert[1]) && $convert[1] != '') {
      return User::asLetters($convert[0]).' virgule '.User::asLetters($convert[1]);
    }
    if ($number < 0) return 'moins '.User::asLetters(-$number);
    if ($number < 17) {
      return $num[17][$number];
    }
    elseif ($number < 20) {
      return 'dix-'.User::asLetters($number-10);
    }
    elseif ($number < 100) {
      if ($number%10 == 0) {
        return $num[100][$number];
      }
      elseif (substr($number, -1) == 1) {
        if( ((int)($number/10)*10)<70 ){
          return User::asLetters((int)($number/10)*10).'-et-un';
        }
        elseif ($number == 71) {
          return 'soixante-et-onze';
        }
        elseif ($number == 81) {
          return 'quatre-vingt-un';
        }
        elseif ($number == 91) {
          return 'quatre-vingt-onze';
        }
      }
      elseif ($number < 70) {
        return User::asLetters($number-$number%10).'-'.User::asLetters($number%10);
      }
      elseif ($number < 80) {
        return User::asLetters(60).'-'.User::asLetters($number%20);
      }
      else {
        return User::asLetters(80).'-'.User::asLetters($number%20);
      }
    }
    elseif ($number == 100) {
      return 'cent';
    }
    elseif ($number < 200) {
      return User::asLetters(100).' '.User::asLetters($number%100);
    }
    elseif ($number < 1000) {
      return User::asLetters((int)($number/100)).' '.User::asLetters(100).($number%100 > 0 ? ' '.User::asLetters($number%100): '');
    }
    elseif ($number == 1000){
      return 'mille';
    }
    elseif ($number < 2000) {
      return User::asLetters(1000).' '.User::asLetters($number%1000).' ';
    }
    elseif ($number < 1000000) {
      return User::asLetters((int)($number/1000)).' '.User::asLetters(1000).($number%1000 > 0 ? ' '.User::asLetters($number%1000): '');
    }
    elseif ($number == 1000000) 
    {
        
        if ($digit == 1 && $six == 7) 
        {
        
            return 'Un million';            

            # code...
        }

        return 'millions';
    }
    elseif ($number < 2000000) {
      return User::asLetters(1000000).' '.User::asLetters($number%1000000);
    }
    elseif ($number < 1000000000) {
      return User::asLetters((int)($number/1000000)).' '.User::asLetters(1000000).($number%1000000 > 0 ? ' '.User::asLetters($number%1000000): '');
    }
  }



    //
}
