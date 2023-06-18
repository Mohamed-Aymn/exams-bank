<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = "questions";
    public $timestamps = false;
    // PK key confib
    protected $primaryKey = 'question_id';
    protected $keyType = 'integer';
    public $incrementing = false;

    protected $fillable = [
        'question_id',
        'subject',
        'question',
        'answer',
        'is_draft',
        'creator',
        "type",
        "level"
    ];

    public $rules = [
        'answer' => [
            'required',
            'string',
            "max:500"
        ],'question' => [
            'required',
            'string',
        ],'subject' => [
            'required',
            'string',
            "max:200"
        ],'creator' => [
            // 'required', 
        ],'is_accepted' => [
            'required',
        ], 'is_draft' => [
            // 'required',
            "boolean",
        ], 'type' => [
            'required',
            "int",
            "in:1,2,3"
        ],'level' => [
            'required',
            "int",
            "in:1,2,3"
        ],
    ];

    // public function mcq()
    // {
    //     return $this->hasOne(Mcq::class, 'question_id');
    // }

    // public function trueOrFalse()
    // {
    //     return $this->hasOne(trueOrFalse::class, 'question_id');
    // }

    
    public function scopeSubject($query, $subject){
        return $query->where('subject', $subject);
    }

    public function scopeRandomQuestions($query, $subject, $type, $level, $limit){
        return $query->select('question_id')
        ->where('subject', $subject)
        ->where('type', $type)
        ->where('level', $level)
        ->inRandomOrder()
        ->limit($limit);
    }
}
