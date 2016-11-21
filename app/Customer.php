<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = [
        'name',
        'cnp'
    ];

    /**
     * To Get the transactions for Customer.
     */

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
