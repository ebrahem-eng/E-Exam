<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    //علاقة المادة بالصف

    public function subjects()
    {
        return $this->belongsToMany(Subject::class , 'classe_subjects' , 'class_id' , 'subject_id');
    }

    //علاقة الصف بالمدرس

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class__teachers' , 'class_id' , 'teacher_id');
    }

    //علاقة الصف والطالب
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student__classes' , 'class_id' , 'student_id');
    }
}
