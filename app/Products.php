<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{



    protected $table = 'tbl_products';

    // protected $fileable = ['title', 'price', 'desctription', 'image', 'discount', 'type', 'status'];

    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
