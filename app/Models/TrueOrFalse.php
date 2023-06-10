<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrueOrFalse extends Model
{
    use HasFactory;


    protected $table = "true_or_false";
    protected $primaryKey = 'question_id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'false_ans',
    ];

    public $rules = [
        'false_ans' => [
            'required',
            "max:500"
        ]
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
