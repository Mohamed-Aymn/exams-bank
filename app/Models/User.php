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

    protected $primaryKey = 'user_id';
    protected $keyType = 'int';
    
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    // protected $incrementing = false;


    protected $guarded = ['user_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "photo",
        "type"
    ];

    public $timestamps = false;

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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
