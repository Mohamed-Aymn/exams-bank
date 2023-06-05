<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $primaryKey = 'name';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'color'
    ];
    
    public $rules = [
        'name' => [
            'required',
            "string",
            "max:200"
        ], 'description' => [
            'required',
            "string",
            "max:500"
        ],'color' => [
            'required',
            "string",
            "max:6"
        ],
    ];
}
