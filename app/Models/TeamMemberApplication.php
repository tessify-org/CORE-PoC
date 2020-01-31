<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMemberApplication extends Model
{
    protected $table = "team_member_applications";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "job_id",
        "user_id",
        "team_role_id",
        "motivation",
        "processed",
        "accepted",
    ];
    protected $casts = [
        "processed" => "boolean",
        "accepted" => "boolean",
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

    public function teamRole()
    {
        return $this->belongsTo(TeamRole::class);
    }
}