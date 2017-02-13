<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
            'titulo','descripcion','condicion','precio','oferta'
        ];
    
    public function marca()
    {
        return $this->belongsToMany('shcart\Brand');
    }

    public function imagenes()
    {
        return $this->hasMany('shcart\Image');
    }
}
