<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionRequest extends Model
{
    use HasFactory;

    
    protected $table = "question_request";
    public $timestamps = false;
    // primary key config
    protected $primaryKey = ['question_request_id', 'teacher_id'];
    protected $keyType = 'integer';
    public $incrementing = false;

    protected $fillable = [
        'question_request_id',
        'teacher_id',
        'acceptor',
        'about'
    ];

    public $rules = [
        'question_request_id' => [
            "required",
        ]
        ,'teacher_id' => [
            "required",
        ], 'acceptor' => [
            'ing'
        ], 'about' => [
            'string'
        ]
    ];

}
