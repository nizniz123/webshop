<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = 'facture';
    public $timestamps = false;
    protected $guarded = ['FactureID'];
    protected $fillable = array('Date_fac','Remise','TVA','prix');

    public function commande(){

        return $this->belongsTo('App\Commande');
    }
}
