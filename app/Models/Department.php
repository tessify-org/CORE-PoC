<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = [
        "organization_id",
        "name",
    ];

    //
    // Relationships
    // 

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}