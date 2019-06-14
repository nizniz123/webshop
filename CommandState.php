<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommandState extends Model
{
    protected $table = 'etatdecommande';
    public $timestamps = false;
    protected $guarded = ['EtatDeCommandeID'];
    protected $fillable = array('Lib_etatcom','Date_etat');

    public function commande()
    {
        return $this->belongsTo('App\Commande');
    }
}
