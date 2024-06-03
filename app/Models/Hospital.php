<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Hospital extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'email', 'phone_number', 'password', 'hospital_name', 'hospital_type', 'address',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
