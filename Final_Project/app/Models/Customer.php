<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'created_at'
    ];

    public function sales()
    {
        return $this->hasMany(\App\Models\Sale::class);
    }
}
