<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'slug', 'path_trailer', 'about', 'thumbnail', 'category_id', 'teacher_id',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_students');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courseVideos()
    {
        return $this->hasMany(CourseVideo::class);
    }

    public function courseKeypoint()
    {
        return $this->hasMany(CourseKeypoint::class);
    }
}
