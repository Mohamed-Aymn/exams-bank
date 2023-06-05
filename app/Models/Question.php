<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = "questions";
    protected $primaryKey = 'question_id';
    protected $keyType = 'int';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'subject',
        'answer',
        'is_draft',
        'author',
        "type",
        "level"
    ];

    public $rules = [
        'answer' => [
            'required',
            'string',
            "max:500"
        ],'subject' => [
            'required',
            'string',
            "max:200"
        ],'creator' => [
            'required', 
            'unique:teachers',
        ],'is_draft' => [
            'required',
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

    public function mcq()
    {
        return $this->hasOne(Mcq::class, 'question_id');
    }

    public function trueOrFalse()
    {
        return $this->hasOne(trueOrFalse::class, 'question_id');
    }

}
