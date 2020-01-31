<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamRole extends Model
{
    protected $table = "team_roles";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "job_id",
        "name",
        "description",
    ];

    //
    // Relationships
    //

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class);
    }

    public function teamMemberApplications()
    {
        return $this->hasMany(TeamMemberApplication::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}