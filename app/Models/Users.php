<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Users extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name', 
        'email', 
        'role', 
        'phone', 
        'status', 
        'book_id', 
        'password', 
        'username', 
    ];
}
