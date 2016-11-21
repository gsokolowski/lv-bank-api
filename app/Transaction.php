<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'name',
        'cnp'
    ];

    /**
     * To allow a transaction to access its parent customer.
     */

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
