<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    use HasFactory;

    protected $table = "mcq";
    protected $primaryKey = 'question_id';
    protected $keyType = 'integer';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'choice2',
        'choice3',
        'choice4'
    ];

    public $rules = [
        // 'question_id' => [
        //     // "required",
        // ],
        'choice2' => [
            "required",
            'max:500'
        ]
        ,'choice3' => [
            "required",
            'max:500'
        ]
        ,'choice4' => [
            "required",
            'max:500'
        ]
    ];


    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
