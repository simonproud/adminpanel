<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class MenuItem extends Model
{
    //
    use NodeTrait;

    public function permissions()
    {
        return $this->belongsToMany('Spatie\Permission\Models\Permission', 'menu_items_by_permissions', 'menuitem_id', 'permission_id');
    }

}
