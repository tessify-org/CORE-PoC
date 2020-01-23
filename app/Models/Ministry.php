<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $table = "ministries";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "name",
        "abbreviation",
        "description",
    ];
    
    //
    // Relationships
    //

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }
}