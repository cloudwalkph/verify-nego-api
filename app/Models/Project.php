<?php

namespace App\Models;

use App\ProjectShare;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project_user()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function hits()
    {
        return $this->hasMany(Hit::class);
    }
}
