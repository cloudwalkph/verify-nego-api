<?php

namespace App;

use App\Models\ProjectUser;
use App\Models\UserGroup;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at'
    ];

    public function group()
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function events()
    {
        return $this->hasMany(ProjectUser::class);
    }
}
