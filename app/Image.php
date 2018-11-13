<?php

namespace shcart;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
     protected $fillable = [
            'product_id','rutaimagen'
        ];

    public function producto()
    {
        return $this->belongsTo('shcart\Product');
    }
}
