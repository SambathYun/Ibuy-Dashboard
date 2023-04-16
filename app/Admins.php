<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
