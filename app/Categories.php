<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $fillable = [
            'nombre'
    ];

    public function marcas()
    {
        return $this->belongsToMany('shcart\Brand');
    }
}
