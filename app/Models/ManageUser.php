<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'f_name',
        'email',
        'phone_no',
        'image',
        'password',
        'c_password',
        'user_role',
    ];
    protected $table = 'manage_users';
}
