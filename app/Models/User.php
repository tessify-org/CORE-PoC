<?php

namespace App\Models;

use Users;
use Avatar;
use Uploader;

use Tessify\Core\Traits\Searchable;
use Overtrue\LaravelFollow\Followable;
use Cviebrock\EloquentSluggable\Sluggable;
use Overtrue\LaravelSubscribe\Traits\Subscriber;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Sluggable;
    use Notifiable;
    use Searchable;
    use Subscriber;
    use Followable;

    protected $fillable = [
        'annotation',
        'first_name',
        'last_name', 
        'slug',
        'email', 
        'email_verified_at',
        'password',
        'avatar_url',
        'header_bg_url',
        'phone',
        'headline',
        'interests',
        'reputation_points',
        'is_admin',
        'recovery_code',
        'has_been_checked',
        'banned_until',
        'permabanned',
        'publicly_display_email',
    ];
    protected $hidden = [
        'password', 
        'remember_token',
    ];
    protected $dates = [
        'email_verified_at',
        'banned_until',
    ];
    protected $casts = [
        'is_admin' => 'boolean',
        'has_been_checked' => 'boolean',
        'permabanned' => 'boolean',
        'publicly_display_email' => 'boolean',
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
        return $this->hasMany(\Tessify\Core\Models\Assignment::class);
    }
    
    public function createdProjects()
    {
        return $this->hasMany(\Tessify\Core\Models\Project::class, "id", "author_id");
    }

    public function createdTasks()
    {
        return $this->hasMany(\Tessify\Core\Models\Task::class, "id", "author_id");
    }

    public function teamMembers()
    {
        return $this->hasMany(\Tessify\Core\Models\TeamMember::class);
    }
    
    public function teamMemberApplications()
    {
        return $this->hasMany(\Tessify\Core\Models\TeamMemberApplication::class);
    }

    public function placedComments()
    {
        return $this->hasMany(\Tessify\Core\Models\Comment::class);
    }
    
    public function receivedComments()
    {
        return $this->morphMany(\Tessify\Core\Models\Comment::class, "commentable");
    }
    
    public function skills()
    {
        return $this->belongsToMany(\Tessify\Core\Models\Skill::class)
                    ->withPivot('mastery', 'description')
                    ->withTimestamps();
    }

    public function notifications()
    {
        return $this->hasMany(\Tessify\Core\Models\Notification::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(\Tessify\Core\Models\Task::class);
    }

    public function reputationTransactions()
    {
        return $this->hasMany(\Tessify\Core\Models\ReputationTransaction::class);
    }

    public function bugReports()
    {
        return $this->hasMany(\Tessify\Core\Models\BugReport::class);
    }

    public function completedTasks()
    {
        return $this->hasMany(\Tessify\Core\Models\CompletedTask::class);
    }

    public function sentViewEmailRequests()
    {
        return $this->hasMany(\Tessify\Core\Models\ViewEmailRequest::class);
    }

    public function receivedViewEmailRequests()
    {
        return $this->hasMany(\Tessify\Core\Models\ViewEmailRequest::class, "id", "target_user_id");
    }

    public function feedActivities()
    {
        return $this->hasMany(\Tessify\Core\Models\FeedActivity::class);
    }

    public function actingFeedActivities()
    {
        return $this->hasMany(\Tessify\Core\Models\FeedActivity::class, "actor_id", "id");
    }
    
    public function reviewRequests()
    {
        return $this->hasMany(\Tessify\Core\Models\ReviewRequest::class);
    }

    public function reviews()
    {
        return $this->hasMany(\Tessify\Core\Models\Review::class);
    }
    
    //
    // Accessors
    //

    public function getFormattedNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function getAvatarUrlAttribute($value)
    {
        return asset($value);
    }

    public function getHeaderBgUrlAttribute($value)
    {
        return asset($value);
    }

    public function getCurrentAssignmentAttribute()
    {
        foreach ($this->assignments as $assignment)
        {
            if ($assignment->current)
            {
                return $assignment;
            }
        }

        return false;
    }

    public function getCurrentAssignmentJobTitleAttribute()
    {
        $out = "";

        if ($this->currentAssignment)
        {
            $out .= $this->currentAssignment->title." bij ".$this->currentAssignment->organization->name;
            if ($this->currentAssignment->organization->ministry)
            {
                $out .= ", ".$this->currentAssignment->organization->ministry->abbreviation;   
            }
        }

        return $out;
    }
}
