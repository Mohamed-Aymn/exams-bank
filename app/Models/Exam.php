<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = "exams";
    protected $primaryKey = 'exam_id';
    protected $keyType = 'integer';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'duration',
        'created_at'
    ];

    public $rules = [
        'question_id' => [
            // "required",
        ],'duration' => [
            "required",
            'date_format:H:i:s.u'
        ]
    ];
}
