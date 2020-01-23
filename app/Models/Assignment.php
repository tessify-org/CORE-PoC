<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = "assignments";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "user_id",
        "ministry_id",
        "organization_id",
        "department_id",
        "job_title_id",
        "order",
        "started_at",
        "stopped_at",
    ];

    //
    // Relationships
    // 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }    

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
}