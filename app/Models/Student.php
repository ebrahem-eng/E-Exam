<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'student';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'gender',
        'birthday',
        'phone',
        'image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      //علاقة الطالب بالصفوف 

      public function classes()
      {
          return $this->belongsToMany(Classe::class, 'student__classes', 'student_id', 'class_id');
      }

        //علاقة الطالب بالمادة  

        public function subjects()
        {
            return $this->belongsToMany(Subject::class, 'student_subjects', 'student_id', 'subject_id');
        }

       //علاقة الطالب بالامتحان  

       public function exams()
       {
           return $this->belongsToMany(Exam::class, 'student_exams', 'student_id', 'exam_id');
       }

}