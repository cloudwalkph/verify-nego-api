<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'deleted_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }


}
