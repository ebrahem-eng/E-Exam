<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];


    //علاقة الصف بالمادة
    public function classes()
    {
        return $this->belongsToMany(Classe::class , 'classe_subjects' , 'subject_id' , 'class_id');
    }

    //علاقة السؤال بالمادة 

    public function questions()
    {
        return $this->belongsToMany(Question::class , 'subject__questions' , 'subject_id' , 'question_id');
    }


    //علاقة المدرس بالمادة

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject__teachers' , 'subject_id','teacher_id'  );
    }

}
