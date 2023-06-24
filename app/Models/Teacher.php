<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    protected $fillable = [
        'teacher_id',
        'title',
        'bio',
        'permission'
    ];
    public $timestamps = false;

    public $rules = [
        'title' => [
            'string',
            "max:150"
        ],'bio' => [
            'string',
            'max:500'
        ],
        'permission'=>[
            'bool'
        ]
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
