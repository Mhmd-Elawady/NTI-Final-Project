<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'users'; 

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }
}
