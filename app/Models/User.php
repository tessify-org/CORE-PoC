<?php

namespace App\Models;

use Users;
use Avatar;
use Uploader;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'is_admin',
        'recovery_code',
    ];
    protected $hidden = [
        'password', 
        'remember_token',
    ];
    protected $dates = [
        'email_verified_at',
    ];
    protected $casts = [
        'is_admin' => 'boolean',
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
    
    public function createdProjects()
    {
        return $this->hasMany(Tessify\Core\Models\Project::class, "id", "author_id");
    }

    public function createdTasks()
    {
        return $this->hasMany(Tessify\Core\Models\Task::class, "id", "author_id");
    }

    public function teamMembers()
    {
        return $this->hasMany(Tessify\Core\Models\TeamMember::class);
    }
    
    public function teamMemberApplications()
    {
        return $this->hasMany(Tessify\Core\Models\TeamMemberApplication::class);
    }

    public function placedComments()
    {
        return $this->hasMany(Tessify\Core\Models\Comment::class);
    }
    
    public function receivedComments()
    {
        return $this->morphMany(Tessify\Core\Models\Comment::class, "commentable");
    }
    
    public function skills()
    {
        return $this->belongsToMany(Tessify\Core\Models\Skill::class);
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
