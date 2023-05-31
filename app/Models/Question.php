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

    //علاقة جدول الاسئلة مع جدول المواد 

    public function subjects()
    {
        return $this->belongsToMany(Subject::class , 'subject__questions' ,  'question_id' ,'subject_id' );
    }

    //علاقة جدول الاسئلة مع جدول الامتحانات

    public function exams()
    {
        return $this->belongsToMany(Exam::class , 'exam__questions' ,  'question_id' ,'exam_id' );
    }

}
