<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $fillable = [
            'nombre'
    ];

    public function productos()
    {
        return $this->belongsToMany('shcart\Product');
    }

     public function categoria()
    {
        return $this->belongsToMany('shcart\Categories');
    }
}
