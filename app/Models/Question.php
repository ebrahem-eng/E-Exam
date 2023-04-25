<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'answer',
        'true_answer',
        'description',
        'mark',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class , 'subject__questions' ,  'question_id' ,'subject_id' );
    }
}
