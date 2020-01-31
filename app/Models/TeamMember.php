<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = "team_members";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "job_id",
        "user_id",
        "title",
    ];

    //
    // Relationships
    //

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamRoles()
    {
        return $this->belongsToMany(TeamRole::class);
    }
}