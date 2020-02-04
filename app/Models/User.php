<?php

namespace App\Models;

use Users;
use Avatar;
use Uploader;
use Assignments;
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
    
    public function teamMemberApplications()
    {
        return $this->hasMany(TeamMemberApplication::class);
    }

    public function placedComments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function receivedComments()
    {
        return $this->morphMany(Comment::class, "commentable");
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

    public function getAvatarUrlAttribute($value)
    {
        if (is_null($value))
        {
            $filename = Uploader::generateFileName("jpg");
            $filepath = "storage/images/avatars/".$filename;
            $avatar = Avatar::create($this->combinedName)->save($filepath, 100);

            Users::saveAvatar($this->id, $filepath);

            return asset($filepath);
        }

        return asset($value);
    }
}
