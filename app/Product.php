<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Product extends Model
{
    //
    use Searchable;
    
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
