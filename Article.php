<?php

namespace App;
use App\Categorie;

use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{

    protected $table = 'article';
    public $timestamps = false;
    protected $fillable = array('Description', 'Qte_stock', 'Fiche_technique','img','SousCategorieID','prix');

    public function categories()
    {
        return $this->belongsTo('Categorie','SousCategorieID');
    }
/*
    public function image()
    {
        return $this->hasOne('Image');
    }*/

}