<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $table = "job_categories";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "name",
        "label",
    ];

    //
    // Relationships
    //

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}