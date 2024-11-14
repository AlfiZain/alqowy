<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseKeypoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id', 'name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
