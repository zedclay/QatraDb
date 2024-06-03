<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class Donor extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'email', 'phone_number', 'password', 'name', 'blood_group', 'date_of_birth', 'gender', 'address',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
