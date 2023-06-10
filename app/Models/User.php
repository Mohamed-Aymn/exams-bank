<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";
    public $timestamps = false;
    // primary key config
    protected $primaryKey = 'user_id';
    protected $keyType = 'int';
    public $incrementing = false;


    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        "photo",
        "type"
    ];

    public $rules = [
        'name' => [
            'required',
            'string',
            "max:30"
        ],'email' => [
            'required', 
            'email', 
            'unique:users',
            'max:100'
        ],'password' => [
            'required',
            "max:20",
        ], 'type' => [
            'required',
            "string",
            "in:a,t,s"
        ],'photo' => [
            'image',
            'max:2048'
        ],
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'teacher_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'student_id');
    }
}
