<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $appends = ['type_name', 'display_name'];

    static $type_list = [
        1 => 'menu',
        2 => 'button'
    ];

    public function getTypeNameAttribute()
    {
        return $this->attributes['type_name'] = Arr::get(self::$type_list, $this->type);
    }

    public function getDisplayNameAttribute()
    {
        return $this->attributes['display_name'] = __($this->name);
    }

    // Sub-permissions
    public function childs()
    {
        return $this->hasMany('App\Models\Permission', 'parent_id', 'id');
    }

    // All sub-permissions recursively
    public function allChilds()
    {
        return $this->childs()->with('allChilds');
    }
}
