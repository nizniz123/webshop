<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commandearticle extends Model
{
    protected $table=['commandearticle'];
    public $timestamps = false;
    protected $fillable = array('ArticleID','CommandeID');

    public function article(){
        return $this->belongsTo('App\Article','ArticleID');
    }
    public function commande(){
        return $this->belongsTo('App\Commande','CommandeID');
    }
}