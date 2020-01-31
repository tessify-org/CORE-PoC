<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "job_id",
        "task_status_id",
        "title",
        "description",
    ];

    //
    // Relationships
    //

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    
    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, "commentable");
    }
}