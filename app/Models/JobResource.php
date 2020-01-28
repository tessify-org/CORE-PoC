<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobResource extends Model
{
    protected $table = "job_resources";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "job_id",
        "user_id",
        "title",
        "description",
        "file_url",
        "file_size",
    ];

    //
    // Relationships
    //

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}