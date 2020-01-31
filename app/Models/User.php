<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable, Sluggable;

    protected $fillable = [
        'annotation',
        'first_name',
        'last_name', 
        'slug',
        'email', 
        'email_verified_at',
        'password',
        'avatar_url',
        'phone',
    ];
    protected $hidden = [
        'password', 
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //
    // Slug configuration
    //

    public function sluggable()
    {
        return [
            "slug" => [
                "source" => 'formatted_name',
            ]
        ];
    }

    //
    // Relationships
    //

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function createdJobs()
    {
        return $this->hasMany(Job::class, "id", "author_id");
    }

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }
    
    //
    // Accessors
    //

    public function getFormattedNameAttribute()
    {
        return $this->annotation." ".$this->first_name." ".$this->last_name;
    }

    public function getCombinedNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function getCurrentAssignmentAttribute()
    {
        foreach ($this->assignments as $assignment)
        {
            if (is_null($assignment->stopped_at))
            {
                return $assignment;
            }
        }
        
        return false;
    }

    public function getPreviousAssignmentsAttribute()
    {
        $out = [];

        foreach ($this->assignments as $assignment)
        {
            if (!is_null($assignment->stopped_at))
            {
                $out[] = $assignment;
            }
        }

        return collect($out);
    }
}
