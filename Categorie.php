<?php

namespace App;
use App\Article;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model 
{

    protected $table = 'categorie';
    public $timestamps = false;
    protected $fillable = array('category');

    public function articles()
    {
        return $this->hasMany('Article');
    }

}