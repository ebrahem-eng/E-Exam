<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title',
        'time',
        'number_question',
        'mark',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'subject_id',
        'teacher_id'
    ];

     //علاقة السؤال بالامتحان 

     public function questions()
     {
         return $this->belongsToMany(Question::class , 'exam__questions' , 'exam_id' , 'question_id');
     }

     //علاقة الامتحان بالمادة

     public function subject()
     {
        return $this->belongsTo(Subject::class , 'subject_id' , 'id');
     }

     //علاقة الامتحان بالمدرس

     public function teacher()
     {
        return $this->belongsTo(Teacher::class , 'teacher_id' , 'id');
     }

     //علاقة الامتحان بالطالب 

     public function students()
     {
        return $this->belongsToMany(Student::class , 'student_exams' , 'exam_id' , 'student_id');
     }

 
}
