<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'student_id',
        'fav_questions'
    ];
    public $timestamps = false;

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'student_id');
    // }
}
