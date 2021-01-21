<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = 'login_log';
    protected $guarded = ['id'];
    protected $appends = ['user_name'];

    public function getUserNameAttribute()
    {
        if (isset($this->attributes['user_id'])) {
            return User::query()->where('id', $this->attributes['user_id'])->value('name');
        }
        return $this->attributes['user_id'];
    }
}
