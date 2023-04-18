<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email'
    ];

    protected $hidden = [
        'password'
    ];
}
