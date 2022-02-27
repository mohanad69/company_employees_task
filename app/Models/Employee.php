<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'company_id',
        'password',
        'address',
        'image'
    ];

    protected $hidden = ['password'];

    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
