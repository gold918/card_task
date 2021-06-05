<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title'];

    public function users () {
        return $this->belongsToMany(User::class);
    }

    public function tasks () {
        return $this->hasMany(Task::class);
    }
}
