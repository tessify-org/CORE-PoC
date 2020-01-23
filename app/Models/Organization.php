<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = "organizations";
    protected $guarded = ["id", "created_at", "updated_at"];
    protected $fillable = ["name"];

    //
    // Relationships
    //

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}