<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'max_students',
        'instructor_id',
    ];

   
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

   
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
