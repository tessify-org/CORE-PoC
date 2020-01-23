<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $table = "job_titles";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "name",
    ];

    //
    // Relationships
    // 

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class);
    }
}