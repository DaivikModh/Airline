<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Flights extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'flights';
}