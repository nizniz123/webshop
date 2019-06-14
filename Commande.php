<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commande';
    public $timestamps = false;
    protected $guarded = ['CommandeID'];
    protected $fillable = array('Date_com','ClientID','EtatDeCommandeID','FactureID');

    public function user()
    {
        return $this->belongsTo('App\User','ClientID');
    }
    public function commandState()
    {
        return $this->hasOne('App\CommandState','EtatDeCommandeID');
    }
    public function facture(){

        return $this->hasOne('App\Facture','FactureID');
    }
}
