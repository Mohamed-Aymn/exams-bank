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
    protected $primaryKey = ['questions_request_id', 'teacher_id'];
    protected $keyType = 'integer';
    public $incrementing = false;

    protected $fillable = [
        'questions_request_id',
        'teacher_id'
    ];

    public $rules = [
        'questions_request_id' => [
            "required",
        ]
        ,'teacher_id' => [
            "required",
        ], 'acceptro' => [
            'ing'
        ], 'about' => [
            'string'
        ]
    ];

}
