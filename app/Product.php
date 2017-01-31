<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['rutaimagen','titulo','descripcion','precio'];
}
