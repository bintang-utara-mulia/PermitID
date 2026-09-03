<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nis_nip',
        'name',
        'role',
        'class_name',
        'major',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_id');
    }
}
