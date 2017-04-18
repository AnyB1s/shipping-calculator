<?php

namespace AnyB1s\ShippingCalculator\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $table = 'companies';

    protected $fillable = [
        'name',
        'website',
        'currency',
    ];

    public function offices()
    {
        return $this->hasMany(Office::class, 'id', 'company_id');
    }

    public function shipsTo()
    {

    }

    public function shipsFrom()
    {

    }
}