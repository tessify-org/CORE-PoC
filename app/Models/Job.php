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
        "job_status_id",
        "author_id",
        "title",
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

    public function author()
    {
        return $this->belongsTo(User::class, "author_id", "id");
    }
    
    public function status()
    {
        return $this->belongsTo(JobStatus::class, "job_status_id", "id");
    }
}