<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hit extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeLastUpdated()
    {
        return $this->orderBy('created_at', 'DESC')
            ->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
