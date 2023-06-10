<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestions extends Model
{
    use HasFactory;
    
    protected $table = "exam_questions";
    protected $primaryKey = ['exam_id', 'questions_id'];
    protected $keyType = 'integer';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'question_id'
    ];

    public $rules = [
        'exam_id' => [
            // "required",
        ]
        ,'question_id' => [
            // "required",
        ]
    ];

    // get all questions for a specific exam
    public function scopeExam($query, $exam_id){
        return $query->where("exam_id", $exam_id);
    }
}
