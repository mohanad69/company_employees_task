<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'image'
    ];

    
    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id');
    }
}
