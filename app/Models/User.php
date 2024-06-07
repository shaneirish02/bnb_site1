<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    protected $fillable = [
        'user_id', 'name', 'password', 'email', 'created_at', 'updated_at'
    ];

    protected $primaryKey = 'user_id';
}