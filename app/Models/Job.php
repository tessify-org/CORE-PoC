<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Job extends Model
{
    use Sluggable;

    protected $table = "jobs";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "job_category_id",
        "job_status_id",
        "author_id",
        "work_method_id",
        "title",
        "slogan",
        "problem",
        "description",
        "header_image_url",
        "starts_at",
        "ends_at",
    ];
    protected $dates = [
        "starts_at", 
        "ends_at",
    ];

    //
    // Slug configuration
    //

    public function sluggable()
    {
        return [
            "slug" => [
                "source" => 'title',
            ]
        ];
    }

    //
    // Relationships
    //

    public function category()
    {
        return $this->belongsTo(JobCategory::class, "job_category_id", "id");
    }

    public function author()
    {
        return $this->belongsTo(User::class, "author_id", "id");
    }
    
    public function status()
    {
        return $this->belongsTo(JobStatus::class, "job_status_id", "id");
    }

    public function workMethod()
    {
        return $this->belongsTo(WorkMethod::class);
    }

    public function resources()
    {
        return $this->hasMany(JobResource::class);
    }

    public function teamRoles()
    {
        return $this->hasMany(TeamRole::class);
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }
    
    public function teamMemberApplications()
    {
        return $this->hasMany(TeamMemberApplication::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, "commentable");
    }
}